<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;

class Karyawan extends BaseController
{
    public function index()
    {
        $karyawan = new KaryawanModel();
        $data['karyawan'] = $karyawan->getDataKaryawan();
        return view('modernize/master/karyawan/index', $data);
    }

    public function input()
    {
        $model = new KaryawanModel();
        $lastKaryawan = $model->getLastKaryawan();

        $idkaryawan = 'K001'; // Nilai default jika tidak ada IDkaryawan sebelumnya

        if (!empty($lastKaryawan)) {
            $lastIdNumber = (int) substr($lastKaryawan['idkaryawan'], 1);
            $availableIDs = [];

            // Mencari ID karyawan yang ada
            for ($i = 1; $i <= $lastIdNumber; $i++) {
                $checkID = 'K' . str_pad($i, 3, '0', STR_PAD_LEFT);
                $existingKaryawan = $model->getDataKaryawan($checkID)->getRowArray();
                if ($existingKaryawan) {
                    $availableIDs[] = $i;
                }
            }

            // Mencari ID karyawan yang terlewat
            $missedIDs = array_diff(range(1, $lastIdNumber), $availableIDs);
            if (count($missedIDs) > 0) {
                // Jika ada ID yang terlewat, gunakan ID terlewat terkecil sebagai ID supplier berikutnya
                $nextIdNumber = min($missedIDs);
            } else {
                // Jika tidak ada ID yang terlewat, gunakan ID supplier terakhir + 1
                $nextIdNumber = $lastIdNumber + 1;
            }

            // Format angka menjadi tiga digit dengan awalan nol jika perlu
            $idkaryawan = 'K' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);
        }
        return view('modernize/master/karyawan/input', ['idkaryawan' => $idkaryawan]);
    }

    public function store()
    {

        $validation =  \Config\Services::validation();

        $data = array(
            'idkaryawan'     => $this->request->getVar('idkaryawan'),
            'nama'     => $this->request->getVar('nama'),
            'bagian'   => $this->request->getVar('bagian'),
            'jenis_kelamin'   => $this->request->getVar('jenis_kelamin'),
            'alamat' => $this->request->getVar('alamat'),
        );
        // dd($data);

        if ($validation->run($data, 'karyawan') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('karyawan/input'))->withInput();
        } else {
            $model = new KaryawanModel();
            $simpan = $model->insertKaryawan($data);
            if ($simpan) {
                session()->setFlashdata('input', 'Data Karyawan berhasil ditambahkan!');
                return redirect()->to(base_url('karyawan'));
            }
        }
    }

    public function edit($id)
    {
        $model = new KaryawanModel();
        $data['karyawan'] = $model->getDataKaryawan($id)->getRowArray();
        echo view('modernize/master/karyawan/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('oldidkaryawan');
        $validation = \Config\Services::validation();

        $data = array(
            'idkaryawan'     => $this->request->getVar('idkaryawan'),
            'nama'     => $this->request->getVar('nama'),
            'bagian'   => $this->request->getVar('bagian'),
            'jenis_kelamin'   => $this->request->getVar('jenis_kelamin'),
            'alamat'   => $this->request->getVar('alamat')
        );

        if ($validation->run($data, 'karyawan') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('karyawan/edit/' . $id))->withInput();
        } else {
            $model = new KaryawanModel();
            $ubah = $model->updateKaryawan($data, $id);
            if ($ubah) {
                session()->setFlashdata('update', 'Data Karyawan berhasil diupdate!');
                return redirect()->to(base_url('karyawan'));
            }
        }
    }

    public function delete($id)
    {
        $model = new KaryawanModel();
        $hapus = $model->deleteKaryawan($id);
        if ($hapus) {
            session()->setFlashdata('delete', 'Data Karyawan berhasil dihapus!');
            return redirect()->to(base_url('karyawan'));
        }
    }
}
