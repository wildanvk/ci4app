<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Header;
use App\Models\SupplierModel;

Header('Access-Control-Allow-Origin: *');
Header('X-Requested-With: XMLHttpRequest');
Header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
Header('Content-Type: application/json');
header('Access-control-allow-headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

class SupplierAPI extends ResourceController
{
    use ResponseTrait;

    public function showData()
    {
        $model = new SupplierModel();
        $data['supplier'] = $model->getSupplier();
        return $this->respond(['data' => $data]);
    }

    public function getNewIdSupplier()
    {
        $model = new SupplierModel();

        // Membuat ID Supplier
        $lastSupplier = $model->getLastSupplier();
        $idSupplier = 'S001'; // Nilai default jika tidak ada ID supplier sebelumnya

        if (!empty($lastSupplier)) {
            $lastIdNumber = (int) substr($lastSupplier['idSupplier'], 1);
            $availableIDs = [];

            // Mencari ID supplier yang ada
            for ($i = 1; $i <= $lastIdNumber; $i++) {
                $checkID = 'S' . str_pad($i, 3, '0', STR_PAD_LEFT);
                $existingSupplier = $model->getSupplier($checkID);
                if ($existingSupplier) {
                    $availableIDs[] = $i;
                }
            }

            // Mencari ID supplier yang terlewat
            $missedIDs = array_diff(range(1, $lastIdNumber), $availableIDs);
            if (count($missedIDs) > 0) {
                // Jika ada ID yang terlewat, gunakan ID terlewat terkecil sebagai ID supplier berikutnya
                $nextIdNumber = min($missedIDs);
            } else {
                // Jika tidak ada ID yang terlewat, gunakan ID supplier terakhir + 1
                $nextIdNumber = $lastIdNumber + 1;
            }

            // Format angka menjadi tiga digit dengan awalan nol jika perlu
            $idSupplier = 'S' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);
        }

        return $idSupplier;
    }

    public function inputData()
    {
        $validation =  \Config\Services::validation();

        $data = $this->request->getJSON(true);


        if ($validation->run($data, 'supplier') == FALSE) {
            // Validasi gagal, tampilkan pesan kesalahan dan status 400 Bad Request
            return $this->failValidationErrors($validation->getErrors());
        } else {
            $model = new SupplierModel();
            $simpan = $model->insertSupplier($data);
            if ($simpan) {
                // Ambil data baru dari database
                $newData = $model->getSupplier($this->request->getVar('idSupplier'));
                $newId = $this->getNewIdSupplier();

                // Tampilkan data baru dalam respons API
                return $this->respond(['success' => true, 'message' => 'Data supplier berhasil ditambahkan', 'data' => $newData, 'newId' => $newId], 200);
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

        if ($validation->run($data, 'supplier') == FALSE) {
            // Validasi gagal, tampilkan pesan kesalahan dan status 400 Bad Request
            return $this->failValidationErrors($validation->getErrors());
        } else {
            // Update data berdasarkan ID
            $model = new SupplierModel();
            $updated = $model->updateSupplier($data, $data['idSupplier']);

            if ($updated) {
                // Jika pembaruan sukses, kembalikan respons sukses
                $updatedData = $model->getSupplier($data['idSupplier']);

                return $this->respond(['success' => true, 'message' => 'Data berhasil diperbarui', 'data' => $updatedData], 200);
            } else {
                // Jika pembaruan gagal, kembalikan respons gagal
                return $this->failServerError('Gagal memperbarui data', 500);
            }
        }
    }

    public function deleteData()
    {
        $model = new SupplierModel();
        $data = $this->request->getJSON(true);

        $hapus = $model->deleteSupplier($data);
        if ($hapus) {
            // Jika berhasil menghapus data
            $newId = $this->getNewIdSupplier();

            return $this->respond(['success' => true, 'message' => 'Data berhasil dihapus', 'data' => $data, 'newId' => $newId], 200);
        } else {
            // Jika gagal menghapus data
            return $this->failServerError('Data gagal dihapus', 500);
        }
    }
}
