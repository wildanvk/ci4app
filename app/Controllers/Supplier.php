<?php

namespace App\Controllers;

use App\Models\SupplierModel;

class Supplier extends BaseController
{
    public function index()
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

        $data['idSupplier'] = $idSupplier;
        $data['supplier'] = $model->getSupplier();

        echo view('modernize/master/supplier/index', $data);
    }
}
