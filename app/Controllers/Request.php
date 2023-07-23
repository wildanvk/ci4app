<?php

namespace App\Controllers;

use App\Models\RequestModel;
use App\Models\TransaksiModel;

class Request extends BaseController
{
    public function index()
    {
        $model = new RequestModel();
        $data['request'] = $model->getRequest();
        echo view('modernize/request/index', $data);
    }

    public function input()
    {
        $model = new RequestModel();
        $modelTransaksi = new TransaksiModel();
        $lastRequest = $model->getLastRequest();

        $id_request = 'R001'; // Nilai default jika tidak ada ID request sebelumnya

        if (!empty($lastRequest)) {
            $lastIdNumber = (int) substr($lastRequest['id_request'], 1);
            $availableIDs = [];

            // Mencari ID request yang ada
            for ($i = 1; $i <= $lastIdNumber; $i++) {
                $checkID = 'R' . str_pad($i, 3, '0', STR_PAD_LEFT);
                $existingRequest = $model->getRequest($checkID)->getRowArray();
                if ($existingRequest) {
                    $availableIDs[] = $i;
                }
            }

            // Mencari ID request yang terlewat
            $missedIDs = array_diff(range(1, $lastIdNumber), $availableIDs);
            if (count($missedIDs) > 0) {
                // Jika ada ID yang terlewat, gunakan ID terlewat terkecil sebagai ID request berikutnya
                $nextIdNumber = min($missedIDs);
            } else {
                // Jika tidak ada ID yang terlewat, gunakan ID request terakhir + 1
                $nextIdNumber = $lastIdNumber + 1;
            }

            // Format angka menjadi tiga digit dengan awalan nol jika perlu
            $id_request = 'R' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);
        }
        $data['id_request'] = $id_request;
        $data['data_transaksi'] = $modelTransaksi->getTransaksi();
        // dd($data['data_transaksi']);
        return view('modernize/request/input', $data);
    }

    public function store()
    {
        $validation =  \Config\Services::validation();

        $data = array(
            'id_request'     => $this->request->getVar('id_request'),
            'id_transaksi'     => $this->request->getVar('id_transaksi'),
            'jumlah_pesanan'   => $this->request->getVar('jumlah_pesanan'),
            'nama_barang'   => $this->request->getVar('nama_barang'),
            'status_request'   => 'diajukan',
        );

        // dd($data);

        if ($validation->run($data, 'request') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('request/input'))->withInput();
        } else {
            $model = new RequestModel();
            $simpan = $model->insertRequest($data);
            if ($simpan) {
                session()->setFlashdata('input', 'Data Request berhasil ditambahkan!');
                return redirect()->to(base_url('request'));
            }
        }
    }

    public function edit($id)
    {
        $model = new RequestModel();
        $data['request'] = $model->getRequest($id)->getRowArray();
        echo view('modernize/request/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('oldIdRequest');
        $validation = \Config\Services::validation();

        $data = array(
            'id_request'     => $this->request->getVar('id_request'),
            'id_transaksi'     => $this->request->getVar('id_transaksi'),
            'jumlah_pesanan'   => $this->request->getVar('jumlah_pesanan'),
            'nama_barang'   => $this->request->getVar('nama_barang'),
            'status_request'   => $this->request->getVar('status_request'),

        );

        if ($validation->run($data, 'request') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('request/edit/' . $id))->withInput();
        } else {
            $model = new RequestModel();
            $ubah = $model->updateSupplier($data, $id);
            if ($ubah) {
                session()->setFlashdata('update', 'Data Request berhasil diupdate!');
                return redirect()->to(base_url('request'));
            }
        }
    }

    public function delete($id)
    {
        $model = new RequestModel();
        $hapus = $model->deleteRequest($id);
        if ($hapus) {
            session()->setFlashdata('delete', 'Data Request berhasil dihapus!');
            return redirect()->to(base_url('request'));
        }
    }
}
