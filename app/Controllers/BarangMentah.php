<?php

namespace App\Controllers;

use App\Models\BarangMentahModel;

class BarangMentah extends BaseController
{
    public function index()
    {
        $model = new BarangMentahModel();

        // Membuat ID Barang Mentah
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

        $data['idBarangMentah'] = $idBarangMentah;
        $data['barangmentah'] = $model->getBarangMentah();

        echo view('modernize/master/barangmentah/index', $data);
    }
}
