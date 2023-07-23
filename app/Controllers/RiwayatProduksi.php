<?php

namespace App\Controllers;

use App\Models\RiwayatProduksiModel;

class riwayatproduksi extends BaseController
{
    public function index()
    {
        $model = new RiwayatProduksiModel();
        $data['riwayatproduksi'] = $model->getRiwayatProduksi();
        echo view('modernize/riwayatproduksi/index', $data);
    }

    public function input()
    {
        $model = new RiwayatProduksiModel();
        $lastRiwayatProduksi = $model->getLastRiwayatProduksi();

        $id_riwayat_produksi = 'R001'; // Nilai default jika tidak ada ID riwayatproduksi sebelumnya

        if (!empty($lastRiwayatProduksi)) {
            $lastIdNumber = (int) substr($lastRiwayatProduksi['id_riwayat_produksi'], 1);
            $availableIDs = [];

            // Mencari ID riwayatproduksi yang ada
            for ($i = 1; $i <= $lastIdNumber; $i++) {
                $checkID = 'R' . str_pad($i, 3, '0', STR_PAD_LEFT);
                $existingRiwayatProduksi = $model->getRiwayatProduksi($checkID)->getRowArray();
                if ($existingRiwayatProduksi) {
                    $availableIDs[] = $i;
                }
            }

            // Mencari ID riwayatproduksi yang terlewat
            $missedIDs = array_diff(range(1, $lastIdNumber), $availableIDs);
            if (count($missedIDs) > 0) {
                // Jika ada ID yang terlewat, gunakan ID terlewat terkecil sebagai ID riwayatproduksi berikutnya
                $nextIdNumber = min($missedIDs);
            } else {
                // Jika tidak ada ID yang terlewat, gunakan ID riwayatproduksi terakhir + 1
                $nextIdNumber = $lastIdNumber + 1;
            }

            // Format angka menjadi tiga digit dengan awalan nol jika perlu
            $id_riwayat_produksi = 'R' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);
        }



        return view('modernize/riwayatproduksi/input', ['id_riwayat_produksi' => $id_riwayat_produksi]);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $data = array(
            'id_riwayat_produksi' => $this->request->getVar('id_riwayat_produksi'),
            'id_produksi' => $this->request->getVar('id_produksi'),
            'nama_barang' => $this->request->getVar('nama_barang'),
            'jumlah' => $this->request->getVar('jumlah'),
            'tgl_produksi' => $this->request->getVar('tgl_produksi'),
            'tgl_selesai' => $this->request->getVar('tgl_selesai'),
        );

        if ($validation->run($data, 'riwayatproduksi') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('riwayatproduksi/input'))->withInput();
        } else {
            $model = new RiwayatProduksiModel();
            $simpan = $model->insertRiwayatProduksi($data);
            if ($simpan) {
                session()->setFlashdata('input', 'Data riwayatproduksi berhasil ditambahkan!');
                return redirect()->to(base_url('riwayatproduksi'));
            }
        }
    }

    public function edit($id)
    {
        $model = new RiwayatProduksiModel();
        $data['riwayatproduksi'] = $model->getRiwayatProduksi($id)->getRowArray();
        echo view('modernize/riwayatproduksi/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('oldidriwayat');
        $validation = \Config\Services::validation();

        $data = array(
            'id_riwayat_produksi' => $this->request->getVar('id_riwayat_produksi'),
            'id_produksi' => $this->request->getVar('id_produksi'),
            'nama_barang' => $this->request->getVar('nama_barang'),
            'jumlah' => $this->request->getVar('jumlah'),
            'tgl_produksi' => $this->request->getVar('tgl_produksi'),
            'tgl_selesai' => $this->request->getVar('tgl_selesai'),
        );

        if ($validation->run($data, 'riwayatproduksi') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('riwayatproduksi/edit/' . $id))->withInput();
        } else {
            $model = new RiwayatProduksiModel();
            $ubah = $model->updateRiwayatProduksi($data, $id);
            if ($ubah) {
                session()->setFlashdata('update', 'Riwayat Produksi berhasil diupdate!');
                return redirect()->to(base_url('riwayatproduksi'));
            }
        }
    }

    public function delete($id)
    {
        $model = new RiwayatProduksiModel();
        $hapus = $model->deleteRiwayatProduksi($id);
        if ($hapus) {
            session()->setFlashdata('delete', 'Riwayat Produksi berhasil dihapus!');
            return redirect()->to(base_url('riwayatproduksi'));
        }
    }
}
