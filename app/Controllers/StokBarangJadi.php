<?php

namespace App\Controllers;

use App\Models\BarangJadiModel;
use App\Models\StokBarangJadiModel;

class StokBarangJadi extends BaseController
{
    public function index()
    {
        $model = new StokBarangJadiModel();
        $barangjadi = new BarangJadiModel();
        $data['barangjadi'] = $barangjadi->getActiveBarangJadi();
        $data['stokbarangjadi'] = $model->getStokBarangJadi();

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

        $data['idStokBarangJadi'] = $idStokBarangJadi;

        echo view('modernize/stok/barangjadi/index', $data);
    }

    public function input()
    {
        $model = new StokBarangJadiModel();
        $barangjadi = new BarangJadiModel();
        $data['barangjadi'] = $barangjadi->getActiveBarangJadi();
        $data['stokbarangjadi'] = $model->getStokBarangJadi();

        // Mengambil nilai idBarangJadi dari array stok barang jadi
        $existingIds = array_column($data['stokbarangjadi'], 'idBarangJadi');

        // Memeriksa perbedaan antara nilai idBarangJadi dari array barangjadi dan stokbarangjadi
        $missingIds = array_diff(array_column($data['barangjadi'], 'idBarangJadi'), $existingIds);


        if (empty($missingIds)) {
            // Semua idBarangJadi pada barangjadi sudah ada di stokbarangjadi
            session()->setFlashdata('info', 'Semua barang jadi aktif sudah memiliki stok');
            return redirect()->to('/stokbarangjadi');
        } else {


            // Memfilter array barang jadi untuk menghapus data dengan idBarangJadi yang sudah ada di array stok barang jadi
            $filteredBarangJadi = array_filter($data['barangjadi'], function ($item) use ($existingIds) {
                return !in_array($item['idBarangJadi'], $existingIds);
            });

            // Menyimpan hasil filter ke dalam array $data['barangjadi']
            $data['barangjadi'] = $filteredBarangJadi;

            return view('modernize/stok/barangjadi/input', $data);
        }
    }
}
