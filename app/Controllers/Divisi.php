<?php

namespace App\Controllers;

use App\Models\DivisiModel;

class divisi extends BaseController
{
    public function index()
    {
        $model = new DivisiModel();
        $data['divisi'] = $model->getDivisi();
        echo view('modernize/master/divisi/index', $data);
    }

    public function input()
    {
        $model = new DivisiModel();
        $lastDivisi = $model->getLastDivisi();

        $id_divisi = 'D001'; // Nilai default jika tidak ada ID divisi sebelumnya

        if (!empty($lastDivisi)) {
            $lastIdNumber = (int) substr($lastDivisi['id_divisi'], 1);
            $availableIDs = [];

            // Mencari ID divisi yang ada
            for ($i = 1; $i <= $lastIdNumber; $i++) {
                $checkID = 'D' . str_pad($i, 3, '0', STR_PAD_LEFT);
                $existingDivisi = $model->getDivisi($checkID)->getRowArray();
                if ($existingDivisi) {
                    $availableIDs[] = $i;
                }
            }

            // Mencari ID divisi yang terlewat
            $missedIDs = array_diff(range(1, $lastIdNumber), $availableIDs);
            if (count($missedIDs) > 0) {
                // Jika ada ID yang terlewat, gunakan ID terlewat terkecil sebagai ID divisi berikutnya
                $nextIdNumber = min($missedIDs);
            } else {
                // Jika tidak ada ID yang terlewat, gunakan ID divisi terakhir + 1
                $nextIdNumber = $lastIdNumber + 1;
            }

            // Format angka menjadi tiga digit dengan awalan nol jika perlu
            $id_divisi = 'D' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);
        }



        return view('modernize/master/divisi/input', ['id_divisi' => $id_divisi]);
    }

    public function store()
    {
        $validation =  \Config\Services::validation();

        $data = array(
            'id_divisi'     => $this->request->getVar('id_divisi'),
            'divisi'   => $this->request->getVar('divisi'),
        );

        if ($validation->run($data, 'divisi') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('divisi/input'))->withInput();
        } else {
            $model = new DivisiModel();
            $simpan = $model->insertDivisi($data);
            if ($simpan) {
                session()->setFlashdata('input', 'Data divisi berhasil ditambahkan!');
                return redirect()->to(base_url('divisi'));
            }
        }
    }

    public function edit($id)
    {
        $model = new DivisiModel();
        $data['divisi'] = $model->getDivisi($id)->getRowArray();
        echo view('modernize/master/divisi/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('oldiddivisi');
        $validation = \Config\Services::validation();

        $data = array(
            'id_divisi'     => $this->request->getVar('id_divisi'),
            'divisi'   => $this->request->getVar('divisi'),
        );

        if ($validation->run($data, 'divisi') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('divisi/edit/' . $id))->withInput();
        } else {
            $model = new DivisiModel();
            $ubah = $model->updateDivisi($data, $id);
            if ($ubah) {
                session()->setFlashdata('update', 'Data Karyawan berhasil diupdate!');
                return redirect()->to(base_url('divisi'));
            }
        }
    }

    public function delete($id)
    {
        $model = new DivisiModel();
        $hapus = $model->deleteDivisi($id);
        if ($hapus) {
            session()->setFlashdata('delete', 'Data Karyawan berhasil dihapus!');
            return redirect()->to(base_url('divisi'));
        }
    }
}
