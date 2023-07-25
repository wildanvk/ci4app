<?php

namespace App\Controllers;

use App\Models\DataKaryawanModel;
use App\Models\DivisiModel;

class datakaryawan extends BaseController
{
    public function index()
    {
        $model = new DataKaryawanModel();

        $data['datakaryawan'] = $model->getDataKaryawan();

        echo view('modernize/master/datakaryawan/index', $data);
    }

    public function input()
    {
        $model = new DataKaryawanModel();
        $divisi = new DivisiModel();
        $lastDataKaryawan = $model->getLastDataKaryawan();

        $id_karyawan = 'K001'; // Nilai default jika tidak ada ID datakaryawan sebelumnya

        if (!empty($lastDataKaryawan)) {
            $lastIdNumber = (int) substr($lastDataKaryawan['id_karyawan'], 1);
            $availableIDs = [];

            // Mencari ID datakaryawan yang ada
            for ($i = 1; $i <= $lastIdNumber; $i++) {
                $checkID = 'K' . str_pad($i, 3, '0', STR_PAD_LEFT);
                $existingDataKaryawan = $model->getDataKaryawan($checkID);
                if ($existingDataKaryawan) {
                    $availableIDs[] = $i;
                }
            }

            // Mencari ID datakaryawan yang terlewat
            $missedIDs = array_diff(range(1, $lastIdNumber), $availableIDs);
            if (count($missedIDs) > 0) {
                // Jika ada ID yang terlewat, gunakan ID terlewat terkecil sebagai ID datakaryawan berikutnya
                $nextIdNumber = min($missedIDs);
            } else {
                // Jika tidak ada ID yang terlewat, gunakan ID datakaryawan terakhir + 1
                $nextIdNumber = $lastIdNumber + 1;
            }

            // Format angka menjadi tiga digit dengan awalan nol jika perlu
            $id_karyawan = 'K' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);
        }

        $data['divisi'] = $divisi->getDivisi();
        $data['id_karyawan'] = $id_karyawan;


        return view('modernize/master/datakaryawan/input', $data);
    }

    public function store()
    {
        $validation =  \Config\Services::validation();

        $data = array(
            'id_karyawan'     => $this->request->getVar('id_karyawan'),
            'nama_karyawan'     => $this->request->getVar('nama_karyawan'),
            'id_divisi'   => $this->request->getVar('divisi'),
        );

        if ($validation->run($data, 'datakaryawan') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('datakaryawan/input'))->withInput();
        } else {
            $model = new DataKaryawanModel();
            $simpan = $model->insertDataKaryawan($data);
            if ($simpan) {
                session()->setFlashdata('input', 'Data karyawan berhasil ditambahkan!');
                return redirect()->to(base_url('/produksi/datakaryawan'));
            }
        }
    }

    public function edit($id)
    {
        $model = new DataKaryawanModel();
        $data['datakaryawan'] = $model->getDataKaryawan($id);
        echo view('modernize/master/datakaryawan/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('oldidkaryawan');
        $validation = \Config\Services::validation();

        $data = array(
            'id_karyawan'     => $this->request->getVar('id_karyawan'),
            'nama_karyawan'     => $this->request->getVar('nama_karyawan'),
            'id_divisi'   => $this->request->getVar('id_divisi'),
        );

        if ($validation->run($data, 'datakaryawan') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('/produksi/datakaryawan/edit/' . $id))->withInput();
        } else {
            $model = new DataKaryawanModel();
            $ubah = $model->updateDataKaryawan($data, $id);
            if ($ubah) {
                session()->setFlashdata('update', 'Data Karyawan berhasil diupdate!');
                return redirect()->to(base_url('/produksi/datakaryawan'));
            }
        }
    }

    public function delete($id)
    {
        $model = new DataKaryawanModel();
        $hapus = $model->deleteDataKaryawan($id);
        if ($hapus) {
            session()->setFlashdata('delete', 'Data Karyawan berhasil dihapus!');
            return redirect()->to(base_url('/produksi/datakaryawan'));
        }
    }
}
