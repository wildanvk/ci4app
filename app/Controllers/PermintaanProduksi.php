<?php

namespace App\Controllers;

use App\Models\PermintaanProduksiModel;
use App\Models\RiwayatProduksiModel;

class permintaanproduksi extends BaseController
{
    public function index()
    {
        $model = new PermintaanProduksiModel();
        $data['permintaanproduksi'] = $model->getPermintaanProduksi();
        echo view('modernize/permintaanproduksi/index', $data);
    }

    public function input()
    {
        $model = new PermintaanProduksiModel();
        $lastPermintaanProduksi = $model->getLastPermintaanProduksi();

        $id_produksi = 'P001'; // Nilai default jika tidak ada ID produksi sebelumnya

        if (!empty($lastPermintaanProduksi)) {
            $lastIdNumber = (int) substr($lastPermintaanProduksi['id_produksi'], 1);
            $availableIDs = [];

            // Mencari ID permintaanproduksi yang ada
            for ($i = 1; $i <= $lastIdNumber; $i++) {
                $checkID = 'P' . str_pad($i, 3, '0', STR_PAD_LEFT);
                $existingDataKaryawan = $model->getPermintaanProduksi($checkID)->getRowArray();
                if ($existingDataKaryawan) {
                    $availableIDs[] = $i;
                }
            }

            // Mencari ID permintaanproduksi yang terlewat
            $missedIDs = array_diff(range(1, $lastIdNumber), $availableIDs);
            if (count($missedIDs) > 0) {
                // Jika ada ID yang terlewat, gunakan ID terlewat terkecil sebagai ID permintaanproduksi berikutnya
                $nextIdNumber = min($missedIDs);
            } else {
                // Jika tidak ada ID yang terlewat, gunakan ID permintaanproduksi terakhir + 1
                $nextIdNumber = $lastIdNumber + 1;
            }

            // Format angka menjadi tiga digit dengan awalan nol jika perlu
            $id_produksi = 'P' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);
        }



        return view('modernize/permintaanproduksi/input', ['id_produksi' => $id_produksi]);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $data = array(
            'id_produksi' => $this->request->getVar('id_produksi'),
            'nama_barang' => $this->request->getVar('nama_barang'),
            'jumlah' => $this->request->getVar('jumlah'),
        );

        if ($validation->run($data, 'permintaanproduksi') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('/produksi/permintaanproduksi/input'))->withInput();
        } else {
            $model = new PermintaanProduksiModel();
            $simpan = $model->insertPermintaanProduksi($data);
            if ($simpan) {
                session()->setFlashdata('input', 'Data permintaan produksi berhasil ditambahkan!');
                return redirect()->to(base_url('/produksi/permintaanproduksi'));
            }
        }
    }

    public function edit($id)
    {
        $model = new PermintaanProduksiModel();
        $data['permintaanproduksi'] = $model->getPermintaanProduksi($id)->getRowArray();
        echo view('modernize/permintaanproduksi/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('oldidproduksi');
        $validation = \Config\Services::validation();

        $data = array(
            'id_produksi' => $this->request->getVar('id_produksi'),
            'nama_barang' => $this->request->getVar('nama_barang'),
            'jumlah' => $this->request->getVar('jumlah'),
        );

        if ($validation->run($data, 'permintaanproduksi') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('/produksi/permintaanproduksi/edit/' . $id))->withInput();
        } else {
            $model = new PermintaanProduksiModel();
            $ubah = $model->updatePermintaanProduksi($data, $id);
            if ($ubah) {
                session()->setFlashdata('update', 'Progres Produksi berhasil diupdate!');
                return redirect()->to(base_url('/produksi/permintaanproduksi'));
            }
        }
    }

    public function delete($id)
    {
        $model = new PermintaanProduksiModel();
        $hapus = $model->deletePermintaanProduksi($id);
        if ($hapus) {
            session()->setFlashdata('delete', 'Progres Produksi berhasil dihapus!');
            return redirect()->to(base_url('/produksi/permintaanproduksi'));
        }
    }
}
