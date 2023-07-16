<?php

namespace App\Controllers;

use App\Models\BarangMentahModel;
use App\Models\StokBarangMentahModel;

class StokBarangMentah extends BaseController
{
    public function index()
    {
        $model = new StokBarangMentahModel();
        $barangmentah = new BarangMentahModel();
        $data['barangmentah'] = $barangmentah->getActiveBarangMentah();
        $data['stokbarangmentah'] = $model->getStokBarangMentah();

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


        $data['idStokBarangMentah'] = $idStokBarangMentah;

        echo view('modernize/stok/barangmentah/index', $data);
    }
}
