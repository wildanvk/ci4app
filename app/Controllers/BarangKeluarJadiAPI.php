<?php

namespace App\Controllers;

use App\Database\Seeds\BarangKeluarJadi;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Header;
use App\Models\BarangKeluarJadiModel;
use App\Models\StokBarangJadiModel;

Header('Access-Control-Allow-Origin: *');
Header('X-Requested-With: XMLHttpRequest');
Header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
Header('Content-Type: application/json');
header('Access-control-allow-headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

class BarangKeluarJadiAPI extends ResourceController
{
    use ResponseTrait;

    public function getAllData()
    {
        $model = new BarangKeluarJadiModel();
        $data['barangkeluarjadi'] = $model->getBarangKeluarJadi();
        foreach ($data['barangkeluarjadi'] as &$item) {
            $item['harga'] = format_rupiah($item['harga']);
        }
        foreach ($data['barangkeluarjadi'] as &$item) {
            $item['tanggal'] = format_tanggal($item['tanggal']);
        }

        return $this->respond($data);
    }

    public function getDataByDate()
    {
        $startDate = $this->request->getVar('startDate');
        $endDate = $this->request->getVar('endDate');

        $model = new BarangKeluarJadiModel();
        $data['barangkeluarjadi'] = $model->getBarangKeluarByDateRange($startDate, $endDate);
        foreach ($data['barangkeluarjadi'] as &$item) {
            $item['harga'] = format_rupiah($item['harga']);
        }
        return $this->respond($data);
    }

    public function newIdTransaksi()
    {
        $model = new BarangKeluarJadiModel();

        // Membuat ID Transaksi otomatis
        $today = date('dmy'); // Mendapatkan tanggal hari ini
        $lastTransaksi = $model->getLastTransaksi($today);

        if (!empty($lastTransaksi)) {
            $lastDate = substr($lastTransaksi['idTransaksi'], 5, 6); // Mendapatkan tanggal dari ID transaksi terakhir
            $lastOrderNumber = (int) substr($lastTransaksi['idTransaksi'], 12); // Mendapatkan angka urutan dari ID transaksi terakhir
            $availableIDs = [];

            if ($lastDate === $today) {
                // Mencari ID Transaksi yang ada
                for ($i = 1; $i <= $lastOrderNumber; $i++) {
                    $checkID = 'TKBJ-' . $today . '-' . str_pad($i, 3, '0', STR_PAD_LEFT);
                    $existingTransaksi = $model->getBarangKeluarJadi($checkID);
                    if ($existingTransaksi) {
                        $availableIDs[] = $i;
                    }
                }

                $missedIDs = array_diff(range(1, $lastOrderNumber), $availableIDs);
                if (count($missedIDs) > 0) {
                    // Jika ada ID yang terlewat, gunakan ID terlewat terkecil sebagai ID Transaksi berikutnya
                    $nextOrderNumber = min($missedIDs);
                } else {
                    // Jika tidak ada ID yang terlewat, gunakan ID Transaksi terakhir + 1
                    $nextOrderNumber = $lastOrderNumber + 1;
                }
            } else {
                $nextOrderNumber = 1; // Jika berbeda tanggal, angka urutan kembali ke 1
            }
        } else {
            $nextOrderNumber = 1; // Jika berbeda tanggal, angka urutan kembali ke 1
        }

        $orderNumber = str_pad($nextOrderNumber, 3, '0', STR_PAD_LEFT); // Format angka urutan menjadi tiga digit dengan awalan nol jika perlu
        $idTransaksi = 'TKBJ-' . $today . '-' . $orderNumber; // Gabungkan semua bagian untuk membentuk ID transaksi akhir

        return $idTransaksi;
    }

    public function getNewIdTransaksi()
    {
        $newId = $this->newIdTransaksi();
        return $this->respond(['idTransaksi' => $newId], 200);
    }

    public function inputData()
    {
        $validation =  \Config\Services::validation();

        $data = $this->request->getJSON(true);

        if ($data['idBarangJadi'] != null) {
            $model = new StokBarangJadiModel();
            $stok = $model->getStokBarangJadiByIdBarangJadi($data['idBarangJadi']);
            $cekStok = $data['jumlah'] > $stok['stok'];
        }


        if ($validation->run($data, 'barangkeluarjadi') == FALSE) {
            // Validasi gagal, tampilkan pesan kesalahan dan status 400 Bad Request
            return $this->failValidationErrors($validation->getErrors());
        } elseif ($cekStok) {
            return $this->failValidationErrors(['jumlah' => 'Jumlah barang keluar melebihi stok yang ada, stok yang tersisa yaitu ' . $stok['stok']], 400);
        } else {
            $model = new BarangKeluarJadiModel();
            $simpan = $model->insertBarangKeluarJadi($data);
            if ($simpan) {
                return $this->respond(['success' => true, 'message' => 'Data transaksi berhasil ditambahkan'], 200);
            } else {
                // Tampilkan pesan gagal dan status 500 Internal Server Error
                return $this->failServerError('Data gagal disimpan', 500);
            }
        }
    }

    public function updateData()
    {
        $validation =  \Config\Services::validation();
        $data = $this->request->getJSON(true);

        if ($validation->run($data, 'barangkeluarjadi') == FALSE) {
            // Validasi gagal, tampilkan pesan kesalahan dan status 400 Bad Request
            return $this->failValidationErrors($validation->getErrors());
        } else {
            // Update data berdasarkan ID
            $model = new BarangKeluarJadiModel();
            $updated = $model->updateBarangKeluarJadi($data, $data['idTransaksi']);

            if ($updated) {
                return $this->respond(['success' => true, 'message' => 'Data berhasil diperbarui'], 200);
            } else {
                // Jika pembaruan gagal, kembalikan respons gagal
                return $this->failServerError('Gagal memperbarui data', 500);
            }
        }
    }

    public function deleteData()
    {
        $model = new BarangKeluarJadiModel();
        $data = $this->request->getJSON(true);

        $hapus = $model->deleteBarangKeluarJadi($data);
        if ($hapus) {
            return $this->respond(['success' => true, 'message' => 'Data berhasil dihapus'], 200);
        } else {
            // Jika gagal menghapus data
            return $this->failServerError('Data gagal dihapus', 500);
        }
    }
}
