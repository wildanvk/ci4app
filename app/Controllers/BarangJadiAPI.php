<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Header;
use App\Models\BarangJadiModel;

Header('Access-Control-Allow-Origin: *');
Header('X-Requested-With: XMLHttpRequest');
Header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
Header('Content-Type: application/json');
header('Access-control-allow-headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

class BarangJadiAPI extends ResourceController
{
    use ResponseTrait;

    public function showData()
    {
        $model = new BarangJadiModel();
        $data['barangjadi'] = $model->getBarangJadi();

        return $this->respond($data);
    }

    public function getNewIdBarangJadi()
    {
        $model = new BarangJadiModel();

        // Membuat ID barang jadi otomatis
        $lastBarangJadi = $model->getLastBarangJadi();
        $idBarangJadi = 'BJ001'; // Nilai default jika tidak ada ID barang jadi sebelumnya

        if (!empty($lastBarangJadi)) {
            $lastIdNumber = (int) substr($lastBarangJadi['idBarangJadi'], 2);
            $availableIDs = [];

            // Mencari ID barang jadi yang ada
            for ($i = 1; $i <= $lastIdNumber; $i++) {
                $checkID = 'BJ' . str_pad($i, 3, '0', STR_PAD_LEFT);
                $existingSupplier = $model->getBarangJadi($checkID);
                if ($existingSupplier) {
                    $availableIDs[] = $i;
                }
            }

            // Mencari ID barang jadi yang terlewat
            $missedIDs = array_diff(range(1, $lastIdNumber), $availableIDs);
            if (count($missedIDs) > 0) {
                // Jika ada ID yang terlewat, gunakan ID terlewat terkecil sebagai ID barang jadi berikutnya
                $nextIdNumber = min($missedIDs);
            } else {
                // Jika tidak ada ID yang terlewat, gunakan ID barang jadi terakhir + 1
                $nextIdNumber = $lastIdNumber + 1;
            }

            // Format angka menjadi tiga digit dengan awalan nol jika perlu
            $idBarangJadi = 'BJ' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);
        }

        return $idBarangJadi;
    }

    public function inputData()
    {
        $validation =  \Config\Services::validation();

        $data = $this->request->getJSON(true);


        if ($validation->run($data, 'barangjadi') == FALSE) {
            // Validasi gagal, tampilkan pesan kesalahan dan status 400 Bad Request
            return $this->failValidationErrors($validation->getErrors());
        } else {
            $model = new BarangJadiModel();
            $simpan = $model->insertBarangJadi($data);
            if ($simpan) {
                // Ambil data baru dari database
                $newData = $model->getBarangJadi($data['idBarangJadi']);
                $newId = $this->getNewIdBarangJadi();

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

        if ($validation->run($data, 'barangjadi') == FALSE) {
            // Validasi gagal, tampilkan pesan kesalahan dan status 400 Bad Request
            return $this->failValidationErrors($validation->getErrors());
        } else {
            // Update data berdasarkan ID
            $model = new BarangJadiModel();
            $updated = $model->updateBarangJadi($data, $data['idBarangJadi']);

            if ($updated) {
                // Jika pembaruan sukses, kembalikan respons sukses
                $updatedData = $model->getBarangJadi($data['idBarangJadi']);

                return $this->respond(['success' => true, 'message' => 'Data berhasil diperbarui', 'data' => $updatedData], 200);
            } else {
                // Jika pembaruan gagal, kembalikan respons gagal
                return $this->failServerError('Gagal memperbarui data', 500);
            }
        }
    }

    public function deleteData()
    {
        $model = new BarangJadiModel();
        $data = $this->request->getJSON(true);

        $hapus = $model->deleteBarangJadi($data);
        if ($hapus) {
            // Jika berhasil menghapus data
            $newId = $this->getNewIdBarangJadi();
            return $this->respond(['success' => true, 'message' => 'Data berhasil dihapus', 'data' => $data, 'newId' => $newId], 200);
        } else {
            // Jika gagal menghapus data
            return $this->failServerError('Data gagal dihapus', 500);
        }
    }
}
