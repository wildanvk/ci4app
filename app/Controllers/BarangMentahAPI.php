<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Header;
use App\Models\BarangMentahModel;

Header('Access-Control-Allow-Origin: *');
Header('X-Requested-With: XMLHttpRequest');
Header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
Header('Content-Type: application/json');
header('Access-control-allow-headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

class BarangMentahAPI extends ResourceController
{
    use ResponseTrait;

    public function getAllData()
    {
        $model = new BarangMentahModel();
        $data['barangmentah'] = $model->getBarangMentah();

        return $this->respond($data);
    }

    public function newIdBarangMentah()
    {
        $model = new BarangMentahModel();

        // Membuat ID barang mentah otomatis
        $lastBarangMentah = $model->getLastBarangMentah();

        $idBarangMentah = 'BM001'; // Nilai default jika tidak ada ID BarangMentah sebelumnya

        if (!empty($lastBarangMentah)) {
            $lastIdNumber = (int) substr($lastBarangMentah['idBarangMentah'], 2);
            $availableIDs = [];

            // Mencari ID BarangMentah yang ada
            for ($i = 1; $i <= $lastIdNumber; $i++) {
                $checkID = 'BM' . str_pad($i, 3, '0', STR_PAD_LEFT);
                $existingBarangMentah = $model->getBarangMentah($checkID);
                if ($existingBarangMentah) {
                    $availableIDs[] = $i;
                }
            }


            // Mencari ID BarangMentah yang terlewat
            $missedIDs = array_diff(range(1, $lastIdNumber), $availableIDs);
            if (count($missedIDs) > 0) {
                // Jika ada ID yang terlewat, gunakan ID terlewat terkecil sebagai ID BarangMentah berikutnya
                $nextIdNumber = min($missedIDs);
            } else {
                // Jika tidak ada ID yang terlewat, gunakan ID BarangMentah terakhir + 1
                $nextIdNumber = $lastIdNumber + 1;
            }

            // Format angka menjadi tiga digit dengan awalan nol jika perlu
            $idBarangMentah = 'BM' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);
        }

        return $idBarangMentah;
    }

    public function getNewIdBarangMentah()
    {
        $newId = $this->newIdBarangMentah();
        return $this->respond(['idBarangMentah' => $newId], 200);
    }

    public function inputData()
    {
        $validation =  \Config\Services::validation();

        $data = $this->request->getJSON(true);


        if ($validation->run($data, 'barangmentah') == FALSE) {
            // Validasi gagal, tampilkan pesan kesalahan dan status 400 Bad Request
            return $this->failValidationErrors($validation->getErrors());
        } else {
            $model = new BarangMentahModel();
            $simpan = $model->insertBarangMentah($data);
            if ($simpan) {
                return $this->respond(['success' => true, 'message' => 'Data barang mentah berhasil ditambahkan'], 200);
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

        if ($validation->run($data, 'barangmentah') == FALSE) {
            // Validasi gagal, tampilkan pesan kesalahan dan status 400 Bad Request
            return $this->failValidationErrors($validation->getErrors());
        } else {
            // Update data berdasarkan ID
            $model = new BarangMentahModel();
            $updated = $model->updateBarangMentah($data, $data['idBarangMentah']);

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
        $model = new BarangMentahModel();
        $data = $this->request->getJSON(true);

        $hapus = $model->deleteBarangMentah($data);
        if ($hapus) {
            // Jika berhasil menghapus data
            return $this->respond(['success' => true, 'message' => 'Data berhasil dihapus'], 200);
        } else {
            // Jika gagal menghapus data
            return $this->failServerError('Data gagal dihapus', 500);
        }
    }
}
