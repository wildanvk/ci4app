<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Header;
use App\Models\BarangJadiModel;
use App\Models\StokBarangJadiModel;

Header('Access-Control-Allow-Origin: *');
Header('X-Requested-With: XMLHttpRequest');
Header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
Header('Content-Type: application/json');
header('Access-control-allow-headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

class StokBarangJadiAPI extends ResourceController
{
    use ResponseTrait;

    public function showData()
    {
        $model = new BarangJadiModel();
        $data['barangjadi'] = $model->getBarangJadi();

        return $this->respond($data);
    }

    public function getAvailableBarangJadi()
    {
        $model = new StokBarangJadiModel();
        $barangjadi = new BarangJadiModel();
        $data['barangjadi'] = $barangjadi->getActiveBarangJadi();
        $data['stokbarangjadi'] = $model->getStokBarangJadi();

        // Mencari idBarangJadi yang sudah ada di stokbarangjadi
        $existingIds = array_column($data['stokbarangjadi'], 'idBarangJadi');
        $missingIds = array_diff(array_column($data['barangjadi'], 'idBarangJadi'), $existingIds);

        if (empty($missingIds)) {
            // Semua idBarangJadi pada barangjadi sudah ada di stokbarangjadi
            return $this->respond(['success' => true, 'message' => 'Semua barang jadi sudah memiliki data stok', 'data' => null], 200);
        } else {
            // Memfilter array barang jadi untuk menghapus data dengan idBarangJadi yang sudah ada di array stok barang jadi
            $filteredBarangJadi = array_filter($data['barangjadi'], function ($item) use ($existingIds) {
                return !in_array($item['idBarangJadi'], $existingIds);
            });

            // Menyimpan hasil filter ke dalam array $data['barangjadi']
            $data['barangjadi'] = $filteredBarangJadi;

            return $this->respond(['success' => true, 'data' => $data['barangjadi']], 200);
        }
    }

    public function getNewIdStokBarangJadi()
    {
        $model = new StokBarangJadiModel();

        // Membuat ID Stok BarangJadi otomatis
        $lastStokBarangJadi = $model->getLastStokBarangJadi();
        $idStokBarangJadi = 'SBJ001'; // Nilai default jika tidak ada ID Stok sebelumnya

        if (!empty($lastStokBarangJadi)) {
            $lastIdNumber = (int) substr($lastStokBarangJadi['idStokBarangJadi'], 3);
            $availableIDs = [];

            // Mencari ID BarangJadi yang ada
            for ($i = 1; $i <= $lastIdNumber; $i++) {
                $checkID = 'SBJ' . str_pad($i, 3, '0', STR_PAD_LEFT);
                $existingBarangMentah = $model->getStokBarangJadi($checkID);
                if ($existingBarangMentah) {
                    $availableIDs[] = $i;
                }
            }

            // Mencari ID BarangJadi yang terlewat
            $missedIDs = array_diff(range(1, $lastIdNumber), $availableIDs);
            if (count($missedIDs) > 0) {
                // Jika ada ID yang terlewat, gunakan ID terlewat terkecil sebagai ID Stok berikutnya
                $nextIdNumber = min($missedIDs);
            } else {
                // Jika tidak ada ID yang terlewat, gunakan ID Stok terakhir + 1
                $nextIdNumber = $lastIdNumber + 1;
            }

            // Format angka menjadi tiga digit dengan awalan nol jika perlu
            $idStokBarangJadi = 'SBJ' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);
        }

        return $idStokBarangJadi;
    }

    public function inputData()
    {
        $validation =  \Config\Services::validation();

        $data = $this->request->getJSON(true);

        if ($validation->run($data, 'stokbarangjadi') == FALSE) {
            // Validasi gagal, tampilkan pesan kesalahan dan status 400 Bad Request
            return $this->failValidationErrors($validation->getErrors());
        } else {
            $model = new StokBarangJadiModel();
            $simpan = $model->insertStokBarangJadi($data);
            if ($simpan) {
                // Ambil data baru dari database
                $newData = $model->getStokBarangJadi($data['idStokBarangJadi']);
                $newId = $this->getNewIdStokBarangJadi();

                // Tampilkan data baru dalam respons API
                return $this->respond(['success' => true, 'message' => 'Data barang jadi berhasil ditambahkan', 'data' => $newData, 'newId' => $newId], 200);
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

        if (empty($data['stok'])) {
            // Jika stok kosong, tampilkan pesan kesalahan dan status 400 Bad Request
            return $this->failValidationErrors(['stok' => 'Stok tidak boleh kosong']);
        } else {
            // Update data berdasarkan ID
            $model = new StokBarangJadiModel();
            $updated = $model->updateStokBarangJadi($data, $data['idStokBarangJadi']);

            if ($updated) {
                // Jika pembaruan sukses, kembalikan respons sukses
                $updatedData = $model->getStokBarangJadi($data['idStokBarangJadi']);

                return $this->respond(['success' => true, 'message' => 'Data berhasil diperbarui', 'data' => $updatedData], 200);
            } else {
                // Jika pembaruan gagal, kembalikan respons gagal
                return $this->failServerError('Gagal memperbarui data', 500);
            }
        }
    }

    public function deleteData()
    {
        $model = new StokBarangJadiModel();
        $data = $this->request->getJSON(true);

        $hapus = $model->deleteStokBarangJadi($data);
        if ($hapus) {
            // Jika berhasil menghapus data
            $newId = $this->getNewIdStokBarangJadi();
            return $this->respond(['success' => true, 'message' => 'Data berhasil dihapus', 'data' => $data, 'newId' => $newId], 200);
        } else {
            // Jika gagal menghapus data
            return $this->failServerError('Data gagal dihapus', 500);
        }
    }
}
