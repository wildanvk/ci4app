<?php

namespace App\Controllers;

use App\Models\PembagianProduksiModel;

class pembagianproduksi extends BaseController
{
    public function index()
    {
        $model = new PembagianProduksiModel();
        $data['pembagianproduksi'] = $model->getPembagianProduksi();
        echo view('modernize/master/pembagianproduksi/index', $data);
    }

    public function input()
    {
        $model = new PembagianProduksiModel();
        $lastPembagianProduksi = $model->getLastPembagianProduksi();

        $id_karyawan = 'K001'; // Nilai default jika tidak ada ID pembagianproduksi sebelumnya

        if (!empty($lastPembagianProduksi)) {
            $lastIdNumber = (int) substr($lastPembagianProduksi['id_karyawan'], 1);
            $availableIDs = [];

            // Mencari ID pembagianproduksi yang ada
            for ($i = 1; $i <= $lastIdNumber; $i++) {
                $checkID = 'K' . str_pad($i, 3, '0', STR_PAD_LEFT);
                $existingPembagianProduksi = $model->getPembagianProduksi($checkID)->getRowArray();
                if ($existingPembagianProduksi) {
                    $availableIDs[] = $i;
                }
            }

            // Mencari ID pembagianproduksi yang terlewat
            $missedIDs = array_diff(range(1, $lastIdNumber), $availableIDs);
            if (count($missedIDs) > 0) {
                // Jika ada ID yang terlewat, gunakan ID terlewat terkecil sebagai ID pembagianproduksi berikutnya
                $nextIdNumber = min($missedIDs);
            } else {
                // Jika tidak ada ID yang terlewat, gunakan ID pembagianproduksi terakhir + 1
                $nextIdNumber = $lastIdNumber + 1;
            }

            // Format angka menjadi tiga digit dengan awalan nol jika perlu
            $id_karyawan = 'K' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);
        }



        return view('modernize/master/pembagianproduksi/input', ['id_karyawan' => $id_karyawan]);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $data = array(
            'id_karyawan' => $this->request->getVar('id_karyawan'),
            'nama_karyawan' => $this->request->getVar('nama_karyawan'),
            'divisi/bagian' => $this->request->getVar('divisi/bagian'),
        );

        if ($validation->run($data, 'pembagianproduksi') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('pembagianproduksi/input'))->withInput();
        } else {
            $model = new PembagianProduksiModel();
            $simpan = $model->insertPembagianProduksi($data);
            if ($simpan) {
                session()->setFlashdata('input', 'Data pembagianproduksi berhasil ditambahkan!');
                return redirect()->to(base_url('pembagianproduksi'));
            }
        }
    }

    public function edit($id)
    {
        $model = new PembagianProduksiModel();
        $data['pembagianproduksi'] = $model->getPembagianProduksi($id)->getRowArray();
        echo view('modernize/master/pembagianproduksi/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('oldidkaryawan');
        $validation = \Config\Services::validation();

        $data = array(
            'id_karyawan' => $this->request->getVar('id_karyawan'),
            'nama_karyawan' => $this->request->getVar('nama_karyawan'),
            'divisi/bagian' => $this->request->getVar('divisi/bagian'),
        );

        if ($validation->run($data, 'pembagianproduksi') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('pembagianproduksi/edit/' . $id))->withInput();
        } else {
            $model = new PembagianProduksiModel();
            $ubah = $model->updatePembagianProduksi($data, $id);
            if ($ubah) {
                session()->setFlashdata('update', 'Data Karyawan berhasil diupdate!');
                return redirect()->to(base_url('pembagianproduksi'));
            }
        }
    }

    public function delete($id)
    {
        $model = new PembagianProduksiModel();
        $hapus = $model->deletePembagianProduksi($id);
        if ($hapus) {
            session()->setFlashdata('delete', 'Data Karyawan berhasil dihapus!');
            return redirect()->to(base_url('pembagianproduksi'));
        }
    }
}