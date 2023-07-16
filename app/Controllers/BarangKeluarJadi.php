<?php

namespace App\Controllers;

use App\Models\BarangJadiModel;
use App\Models\SupplierModel;
use App\Models\BarangKeluarJadiModel;

class BarangKeluarJadi extends BaseController
{
    public function index()
    {
        $model = new BarangKeluarJadiModel();
        $barangjadi = new BarangJadiModel();
        $data['barangkeluarjadi'] = $model->getBarangKeluarJadi();
        $data['barangjadi'] = $barangjadi->getBarangJadi();

        return view('modernize/barangkeluar/barangjadi/index', $data);
    }

    public function input()
    {
        $model = new BarangKeluarJadiModel();
        $supplier = new SupplierModel();
        $barangjadi = new BarangJadiModel();
        $data['barangjadi'] = $barangjadi->getActiveBarangJadi();
        $data['supplier'] = $supplier->getActiveSupplier();

        // Otomatisasi ID Transaksi
        $lastTransaksi = $model->getLastTransaksi();

        $today = date('dmy'); // Mendapatkan tanggal hari ini

        if (!empty($lastTransaksi)) {
            $lastDate = substr($lastTransaksi['idTransaksi'], 5, 6); // Mendapatkan tanggal dari ID transaksi terakhir
            $lastOrderNumber = (int) substr($lastTransaksi['idTransaksi'], 12); // Mendapatkan angka urutan dari ID transaksi terakhir
            $availableIDs = [];

            if ($lastDate === $today) {
                // Mencari ID Transaksi yang ada
                for ($i = 1; $i <= $lastOrderNumber; $i++) {
                    $checkID = 'TKBJ-' . $today . '-' . str_pad($i, 3, '0', STR_PAD_LEFT);
                    $existingTransaksi = $model->getBarangKeluarJadi($checkID);
                    if ($existingTransaksi) {
                        $availableIDs[] = $i;
                    }
                }

                $missedIDs = array_diff(range(1, $lastOrderNumber), $availableIDs);
                if (count($missedIDs) > 0) {
                    // Jika ada ID yang terlewat, gunakan ID terlewat terkecil sebagai ID Transaksi berikutnya
                    $nextOrderNumber = min($missedIDs);
                } else {
                    // Jika tidak ada ID yang terlewat, gunakan ID Transaksi terakhir + 1
                    $nextOrderNumber = $lastOrderNumber + 1;
                }
            } else {
                $nextOrderNumber = 1; // Jika berbeda tanggal, angka urutan kembali ke 1
            }
        } else {
            $nextOrderNumber = 1; // Jika berbeda tanggal, angka urutan kembali ke 1
        }

        $orderNumber = str_pad($nextOrderNumber, 3, '0', STR_PAD_LEFT); // Format angka urutan menjadi tiga digit dengan awalan nol jika perlu

        $idTransaksi = 'TKBJ-' . $today . '-' . $orderNumber; // Gabungkan semua bagian untuk membentuk ID transaksi akhir

        return view('modernize/barangkeluar/barangjadi/input', ['idTransaksi' => $idTransaksi] + $data);
    }

    public function detail($id)
    {
        $model = new BarangKeluarJadiModel();
        $data['barangkeluarjadi'] = $model->getBarangKeluarJadi($id);
        return view('modernize/barangkeluar/barangjadi/detail', $data);
    }

    public function store()
    {
        $validation =  \Config\Services::validation();

        $data = array(
            'idTransaksi'     => $this->request->getVar('idTransaksi'),
            'tanggal'     => $this->request->getVar('tanggal'),
            'idBarangJadi'     => $this->request->getVar('idBarangJadi'),
            'jumlah'   => $this->request->getVar('jumlah'),
            'harga'   => $this->request->getVar('harga'),
            'keterangan'   => $this->request->getVar('keterangan'),
        );

        if ($validation->run($data, 'barangkeluarjadi') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('barangkeluarjadi/input'))->withInput();
        } else {
            $model = new BarangKeluarJadiModel();
            $simpan = $model->insertBarangKeluarJadi($data);
            if ($simpan) {
                session()->setFlashdata('input', 'Data Transaksi Barang Keluar Jadi berhasil ditambahkan!');
                return redirect()->to(base_url('barangkeluarjadi'));
            }
        }
    }

    public function edit($id)
    {
        $model = new BarangKeluarJadiModel();
        $barangjadi = new BarangJadiModel();
        $data['barangkeluarjadi'] = $model->getBarangKeluarJadi($id);
        $data['barangjadi'] = $barangjadi->getActiveBarangJadi();



        echo view('modernize/barangkeluar/barangjadi/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('oldIdTransaksi');
        $validation = \Config\Services::validation();

        $data = array(
            'idTransaksi'     => $this->request->getVar('idTransaksi'),
            'tanggal'     => $this->request->getVar('tanggal'),
            'idBarangJadi'     => $this->request->getVar('idBarangJadi'),
            'jumlah'   => $this->request->getVar('jumlah'),
            'harga'   => $this->request->getVar('harga'),
            'keterangan'   => $this->request->getVar('keterangan'),
        );

        if ($validation->run($data, 'barangkeluarjadi') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('barangkeluarjadi/edit/' . $id))->withInput();
        } else {
            $model = new BarangKeluarJadiModel();
            $ubah = $model->updateBarangKeluarJadi($data, $id);
            if ($ubah) {
                session()->setFlashdata('update', 'Data Transaksi Keluar Barang Jadi berhasil diupdate!');
                return redirect()->to(base_url('barangkeluarjadi'));
            }
        }
    }

    public function delete($id)
    {
        $model = new BarangKeluarJadiModel();
        $hapus = $model->deleteBarangKeluarJadi($id);
        if ($hapus) {
            session()->setFlashdata('delete', 'Data Transaksi Keluar Barang Jadi berhasil dihapus!');
            return redirect()->to(base_url('barangmasukmentah'));
        }
    }
}
