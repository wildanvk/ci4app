<?php

namespace App\Controllers;

use App\Models\PenggajianModel;
use App\Models\KaryawanModel;

class Penggajian extends BaseController
{

    public function index()
    {
        $penggajian = new PenggajianModel();
        $data['penggajian'] = $penggajian->getPenggajian();
        return view('modernize/master/penggajian/index', $data);
    }
    
    public function input()
    {
        $model = new penggajianModel();
        $karyawan = new karyawanModel();
        $lastpenggajian = $model->getLastpenggajian();

        $idpenggajian = 'G001'; // Nilai default jika tidak ada ID karyawansebelumnya

        if (!empty($lastpenggajian)) {
            $lastIdNumber = (int) substr($lastpenggajian['idpenggajian'], 1);
            $availableIDs = [];

            // Mencari ID penggajian yang ada
            for ($i = 1; $i <= $lastIdNumber; $i++) {
                $checkID = 'G' . str_pad($i, 3, '0', STR_PAD_LEFT);
                $existingpengajian = $model->getPenggajian($checkID);
                
                if ($existingpengajian) {
                    $availableIDs[] = $i;
                }
            }

            // Mencari ID penggajian yang terlewat
            $missedIDs = array_diff(range(1, $lastIdNumber), $availableIDs);
            if (count($missedIDs) > 0) {
                // Jika ada ID yang terlewat, gunakan ID terlewat terkecil sebagai ID karyawan berikutnya
                $nextIdNumber = min($missedIDs);
            } else {
                // Jika tidak ada ID yang terlewat, gunakan ID karyawan terakhir + 1
                $nextIdNumber = $lastIdNumber + 1;
            }

            // Format angka menjadi tiga digit dengan awalan nol jika perlu
            $idpenggajian = 'G' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);

        }
        $data['idpenggajian'] = $idpenggajian;
        $data['karyawan'] = $karyawan->getDataKaryawan();
        return view('modernize/master/penggajian/input', $data);
    }

    public function store()
    {

        $validation =  \Config\Services::validation();
    
        $data = array(
            'idpenggajian'     => $this->request->getVar('idpenggajian'),
            'idkaryawan'     => $this->request->getVar('idkaryawan'),
            'tanggal'     => $this->request->getVar('tanggal'),
            'jumlahproduksi'     => $this->request->getVar('jumlahproduksi'),
            'totalgaji'   => $this->request->getVar('totalgaji'),
            
        );
        // dd($data);

        if ($validation->run($data, 'penggajian') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('penggajian/input'))->withInput();
        } else {
            $model = new penggajianModel();
            $simpan = $model->insertpenggajian($data);
            if ($simpan) {
                session()->setFlashdata('input', 'Data penggajian berhasil ditambahkan!');
                return redirect()->to(base_url('penggajian'));
            }
        }
    }

    public function edit($id)
    {
        $model = new PenggajianModel();
        $karyawan = new karyawanModel();
        $data['penggajian'] = $model->getPenggajian($id);
        $data['karyawan'] = $karyawan->getDataKaryawan();

        echo view('modernize/master/penggajian/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('oldidpenggajian');
        $validation = \Config\Services::validation();

        $data = array(
            'idpenggajian'     => $this->request->getVar('idpenggajian'),
            'idkaryawan'     => $this->request->getVar('idkaryawan'),
            'tanggal'     => $this->request->getVar('tanggal'),
            'jumlahproduksi'     => $this->request->getVar('jumlahproduksi'),
            'totalgaji'   => $this->request->getVar('totalgaji')
           
        );

        if ($validation->run($data, 'penggajian') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('penggajian/edit/' . $id))->withInput();
        } else {
            $model = new PenggajianModel();
            $ubah = $model->updatepenggajian($data, $id);
            if ($ubah) {
                session()->setFlashdata('update', 'Data berhasil diupdate!');
                return redirect()->to(base_url('penggajian'));
            }
        }
    }

    public function delete($id)
    {
        $model = new PenggajianModel();
        $hapus = $model->deletePenggajian($id);
        if ($hapus) {
            session()->setFlashdata('delete', 'Data  berhasil dihapus!');
            return redirect()->to(base_url('penggajian'));
        }
    }
}
