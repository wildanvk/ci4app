<?php

namespace App\Controllers;

use App\Models\BarangJadiModel;

class BarangJadi extends BaseController
{
    public function index()
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

        $data['idBarangJadi'] = $idBarangJadi;
        $data['barangjadi'] = $model->getBarangJadi();

        echo view('modernize/master/barangjadi/index', $data);
    }
}
