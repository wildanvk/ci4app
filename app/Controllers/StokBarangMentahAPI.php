<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Header;
use App\Models\BarangMentahModel;
use App\Models\StokBarangMentahModel;

Header('Access-Control-Allow-Origin: *');
Header('X-Requested-With: XMLHttpRequest');
Header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
Header('Content-Type: application/json');
header('Access-control-allow-headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

class StokBarangMentahAPI extends ResourceController
{
    use ResponseTrait;

    public function showData()
    {
        $model = new BarangMentahModel();
        $data['barangmentah'] = $model->getBarangMentah();

        return $this->respond($data);
    }

    public function getAvailableBarangMentah()
    {
        $model = new StokBarangMentahModel();
        $barangmentah = new BarangMentahModel();
        $data['barangmentah'] = $barangmentah->getActiveBarangMentah();
        $data['stokbarangmentah'] = $model->getStokBarangMentah();

        // Mencari idBarangMentah yang sudah ada di stokbarangmentah
        $existingIds = array_column($data['stokbarangmentah'], 'idBarangMentah');
        $missingIds = array_diff(array_column($data['barangmentah'], 'idBarangMentah'), $existingIds);

        if (empty($missingIds)) {
            // Semua idBarangMentah pada barangmentah sudah ada di stokbarangmentah
            return $this->respond(['success' => true, 'message' => 'Semua barang mentah sudah memiliki data stok', 'data' => null], 200);
        } else {
            // Memfilter array barang mentah untuk menghapus data dengan idBarangMentah yang sudah ada di array stok barang mentah
            $filteredBarangMentah = array_filter($data['barangmentah'], function ($item) use ($existingIds) {
                return !in_array($item['idBarangMentah'], $existingIds);
            });

            // Menyimpan hasil filter ke dalam array $data['barangmentah']
            $data['barangmentah'] = $filteredBarangMentah;

            return $this->respond(['success' => true, 'data' => $data['barangmentah']], 200);
        }
    }

    public function getNewIdStokBarangMentah()
    {
        $model = new StokBarangMentahModel();

        // Membuat ID Stok BarangMentah otomatis
        $lastStokBarangMentah = $model->getLastStokBarangMentah();
        $idStokBarangMentah = 'SBM001'; // Nilai default jika tidak ada ID Stok sebelumnya

        if (!empty($lastStokBarangMentah)) {
            $lastIdNumber = (int) substr($lastStokBarangMentah['idStokBarangMentah'], 3);
            $availableIDs = [];

            // Mencari ID BarangMentah yang ada
            for ($i = 1; $i <= $lastIdNumber; $i++) {
                $checkID = 'SBM' . str_pad($i, 3, '0', STR_PAD_LEFT);
                $existingBarangMentah = $model->getStokBarangMentah($checkID);
                if ($existingBarangMentah) {
                    $availableIDs[] = $i;
                }
            }

            // Mencari ID BarangMentah yang terlewat
            $missedIDs = array_diff(range(1, $lastIdNumber), $availableIDs);
            if (count($missedIDs) > 0) {
                // Jika ada ID yang terlewat, gunakan ID terlewat terkecil sebagai ID Stok berikutnya
                $nextIdNumber = min($missedIDs);
            } else {
                // Jika tidak ada ID yang terlewat, gunakan ID Stok terakhir + 1
                $nextIdNumber = $lastIdNumber + 1;
            }

            // Format angka menjadi tiga digit dengan awalan nol jika perlu
            $idStokBarangMentah = 'SBM' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);
        }

        return $idStokBarangMentah;
    }

    public function inputData()
    {
        $validation =  \Config\Services::validation();

        $data = $this->request->getJSON(true);

        if ($validation->run($data, 'stokbarangmentah') == FALSE) {
            // Validasi gagal, tampilkan pesan kesalahan dan status 400 Bad Request
            return $this->failValidationErrors($validation->getErrors());
        } else {
            $model = new StokBarangMentahModel();
            $simpan = $model->insertStokBarangMentah($data);
            if ($simpan) {
                // Ambil data baru dari database
                $newData = $model->getStokBarangMentah($data['idStokBarangMentah']);
                $newId = $this->getNewIdStokBarangMentah();

                // Tampilkan data baru dalam respons API
                return $this->respond(['success' => true, 'message' => 'Data barang mentah berhasil ditambahkan', 'data' => $newData, 'newId' => $newId], 200);
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
            $model = new StokBarangMentahModel();
            $updated = $model->updateStokBarangMentah($data, $data['idStokBarangMentah']);

            if ($updated) {
                // Jika pembaruan sukses, kembalikan respons sukses
                $updatedData = $model->getStokBarangMentah($data['idStokBarangMentah']);

                return $this->respond(['success' => true, 'message' => 'Data berhasil diperbarui', 'data' => $updatedData], 200);
            } else {
                // Jika pembaruan gagal, kembalikan respons gagal
                return $this->failServerError('Gagal memperbarui data', 500);
            }
        }
    }

    public function deleteData()
    {
        $model = new StokBarangMentahModel();
        $data = $this->request->getJSON(true);

        $hapus = $model->deleteStokBarangMentah($data);
        if ($hapus) {
            // Jika berhasil menghapus data
            $newId = $this->getNewIdStokBarangMentah();
            return $this->respond(['success' => true, 'message' => 'Data berhasil dihapus', 'data' => $data, 'newId' => $newId], 200);
        } else {
            // Jika gagal menghapus data
            return $this->failServerError('Data gagal dihapus', 500);
        }
    }
}
