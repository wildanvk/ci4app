<?php

namespace App\Controllers;

use App\Models\SupplierModel;
use App\Models\BarangMentahModel;
use App\Models\BarangJadiModel;
use App\Models\StokBarangMentahModel;
use App\Models\StokBarangJadiModel;
use App\Models\BarangMasukMentahModel;
use App\Models\BarangKeluarJadiModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $supplierModel = new SupplierModel();
        $barangMentahModel = new BarangMentahModel();
        $barangJadiModel = new BarangJadiModel();
        $stokBarangMentahModel = new StokBarangMentahModel();
        $stokBarangJadiModel = new StokBarangJadiModel();
        $barangMasukMentahModel = new BarangMasukMentahModel();
        $barangKeluarJadiModel = new BarangKeluarJadiModel();
        $data['supplier'] = $supplierModel->getCountSupplier();
        $data['barangmentah'] = $barangMentahModel->getCountBarangMentah();
        $data['barangjadi'] = $barangJadiModel->getCountBarangJadi();
        $data['stokbarangmentah'] = $stokBarangMentahModel->getSumStokBarangMentah();
        $data['stokbarangjadi'] = $stokBarangJadiModel->getSumStokBarangJadi();
        $data['totalstok'] = $data['stokbarangmentah']['stok'] + $data['stokbarangjadi']['stok'];
        $data['barangmasukmentah'] = $barangMasukMentahModel->getCountBarangMasukMentah();
        $data['getpengeluaranbulanini'] = $barangMasukMentahModel->getSumPengeluaranBulanIni();
        $data['pengeluaranbulanini'] = format_rupiah($data['getpengeluaranbulanini']['jumlah']);
        $data['barangkeluarjadi'] = $barangKeluarJadiModel->getCountBarangKeluarJadi();
        $data['sumbarangmasuk'] = $barangMasukMentahModel->getSumBarangMasuk();
        $data['sumbarangkeluar'] = $barangKeluarJadiModel->getSumBarangKeluar();

        if (session()->get('role') === 'Gudang') {
            return view('modernize/dashboard/gudang/index', $data);
        } elseif (session()->get('role') === 'Penjualan') {
            return view('modernize/dashboard/penjualan/index', $data);
        } elseif (session()->get('role') === 'Produksi') {
            return view('modernize/dashboard/produksi/index', $data);
        } elseif (session()->get('role') === 'Penggajian') {
            return view('modernize/dashboard/penggajian/index', $data);
        }
    }

    public function chartTransaksi()
    {
        $barangMasukMentahModel = new BarangMasukMentahModel();
        $barangKeluarJadiModel = new BarangKeluarJadiModel();

        $dataTransaksiMasuk = $barangMasukMentahModel->getCountBarangMasukMentahSortByBulan();
        $dataTransaksiKeluar = $barangKeluarJadiModel->getCountBarangKeluarJadiSortByBulan();

        // Buat array kosong untuk menyimpan data akhir
        $dataChart = [];

        // Loop untuk menggabungkan data transaksi masuk dan keluar menjadi satu array
        foreach ($dataTransaksiMasuk as $bulan => $jumlahMasuk) {
            $jumlahKeluar = isset($dataTransaksiKeluar[$bulan]) ? $dataTransaksiKeluar[$bulan] : 0;

            // Tambahkan data ke array akhir
            $dataChart[] = ['bulan' => $bulan, 'jumlah_masuk' => $jumlahMasuk, 'jumlah_keluar' => $jumlahKeluar];
        }

        return $this->response->setJSON($dataChart);
    }

    public function chartBarang()
    {
        $barangMasukMentahModel = new BarangMasukMentahModel();
        $barangKeluarJadiModel = new BarangKeluarJadiModel();

        $dataBarangMasuk = $barangMasukMentahModel->getSumBarangMasukSortByBulan();
        $dataBarangKeluar = $barangKeluarJadiModel->getSumBarangKeluarSortByBulan();

        // Buat array kosong untuk menyimpan data akhir
        $dataChart = [];

        // Loop untuk menggabungkan data barang masuk dan keluar menjadi satu array
        foreach ($dataBarangMasuk as $bulan => $jumlahMasuk) {
            $jumlahKeluar = isset($dataBarangKeluar[$bulan]) ? $dataBarangKeluar[$bulan] : 0;

            // Tambahkan data ke array akhir
            $dataChart[] = ['bulan' => $bulan, 'jumlah_masuk' => $jumlahMasuk, 'jumlah_keluar' => $jumlahKeluar];
        }

        return $this->response->setJSON($dataChart);
    }

    public function chartStok()
    {
        $stokBarangMentahModel = new StokBarangMentahModel();
        $stokBarangJadiModel = new StokBarangJadiModel();

        $dataStokBarangMentah = $stokBarangMentahModel->getSumStokBarangMentah();
        $dataStokBarangJadi = $stokBarangJadiModel->getSumStokBarangJadi();

        // Buat array kosong untuk menyimpan data akhir
        $labels = ['Barang Mentah', 'Barang Jadi'];
        $dataChart = ['labels' => $labels, 'series' => [$dataStokBarangMentah['stok'], $dataStokBarangJadi['stok']]];

        return $this->response->setJSON($dataChart);
    }

    public function chartPengeluaran()
    {
        $barangMasukMentahModel = new BarangMasukMentahModel();

        $dataPengeluaran = $barangMasukMentahModel->getSumPengeluaranSortByBulan();

        // Buat array kosong untuk menyimpan data akhir
        $dataChart = [];

        // Loop untuk menggabungkan data barang masuk dan keluar menjadi satu array
        foreach ($dataPengeluaran as $bulan => $jumlahPengeluaran) {
            // Tambahkan data ke array akhir
            $dataChart[] = ['bulan' => $bulan, 'jumlah_pengeluaran' => $jumlahPengeluaran];
        }

        return $this->response->setJSON($dataChart);
    }
}