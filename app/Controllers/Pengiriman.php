<?php

namespace App\Controllers;


use App\Models\PengirimanModel;
use App\Models\TransaksiModel;
use Dompdf\Dompdf;

class Pengiriman extends BaseController
{
    public function index()
    {
        $model = new PengirimanModel();
        $data['Pengiriman'] = $model->getPengiriman();
        echo view('modernize/master/pengiriman/index', $data);
    }

    public function input()
    {
        $model = new PengirimanModel();
        $modelTransaksi = new TransaksiModel();
        $lastpengiriman = $model->getLastpengiriman();

        $id_pengiriman = 'P001';
        // Nilai default jika tidak ada ID pengiriman sebelumnya

        if (!empty($lastpengiriman)) {
            $lastIdNumber = (int) substr($lastpengiriman['id_pengiriman'], 1);
            $availableIDs = [];

            // Mencari ID pengiriman yang ada
            for ($i = 1; $i <= $lastIdNumber; $i++) {
                $checkID = 'P' . str_pad($i, 3, '0', STR_PAD_LEFT);
                $existingpengiriman = $model->getPengiriman($checkID)->getRowArray();
                if ($existingpengiriman) {
                    $availableIDs[] = $i;
                }
            }

            // Mencari ID pengiriman yang terlewat
            $missedIDs = array_diff(range(1, $lastIdNumber), $availableIDs);
            if (count($missedIDs) > 0) {
                // Jika ada ID yang terlewat, gunakan ID terlewat terkecil sebagai ID pengiriman berikutnya
                $nextIdNumber = min($missedIDs);
            } else {
                // Jika tidak ada ID yang terlewat, gunakan ID pengiriman terakhir + 1
                $nextIdNumber = $lastIdNumber + 1;
            }

            // Format angka menjadi tiga digit dengan awalan nol jika perlu
            $id_pengiriman = 'P' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);
        }
        $data['id_pengiriman'] = $id_pengiriman;
        $data['data_transaksi'] = $modelTransaksi->getTransaksi();
        // dd($data['data_transaksi']);
        return view('modernize/master/pengiriman/input', $data);
    }
    public function store()
    {
        $validation =  \Config\Services::validation();

        $data = array(
            'tgl_pengiriman'     => $this->request->getVar('tgl_pengiriman'),
            'id_pengiriman'     => $this->request->getVar('id_pengiriman'),
            'id_transaksi'     => $this->request->getVar('id_transaksi'),
            'resi'   => $this->request->getVar('resi'),
        );

        if ($validation->run($data, 'pengiriman') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('/penjualan/pengiriman/input'))->withInput();
        } else {
            $model = new PengirimanModel();
            $simpan = $model->insertPengiriman($data);
            if ($simpan) {
                session()->setFlashdata('input', 'Data pengiriman berhasil ditambahkan!');
                return redirect()->to(base_url('/penjualan/pengiriman'));
            }
        }
    }

    public function edit($id)
    {
        $model = new PengirimanModel();
        $data['pengiriman'] = $model->getPengiriman($id)->getRowArray();
        echo view('modernize/master/pengiriman/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('oldid_pengiriman');
        $validation = \Config\Services::validation();

        $data = array(
            'tgl_pengiriman'     => $this->request->getVar('tgl_pengiriman'),
            'id_pengiriman'     => $this->request->getVar('id_pengiriman'),
            'id_transaksi'     => $this->request->getVar('id_transaksi'),
            'resi'   => $this->request->getVar('resi'),
        );

        if ($validation->run($data, 'pengiriman') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('/penjualan/pengiriman/edit/' . $id))->withInput();
        } else {
            $model = new PengirimanModel();
            $ubah = $model->updatePengiriman($data, $id);
            if ($ubah) {
                session()->setFlashdata('update', 'Data pengiriman berhasil diupdate!');
                return redirect()->to(base_url('/penjualan/pengiriman'));
            }
        }
    }

    public function delete($id)
    {
        $model = new PengirimanModel();
        $hapus = $model->deletePengiriman($id);
        if ($hapus) {
            session()->setFlashdata('delete', 'Data pengiriman berhasil dihapus!');
            return redirect()->to(base_url('/penjualan/pengiriman'));
        }
    }
}
