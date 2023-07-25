<?php

namespace App\Controllers;

use App\Models\TransaksiModel;

class Transaksi extends BaseController
{
    public function index()
    {
        $model = new TransaksiModel();
        $data['Transaksi'] = $model->getTransaksi();
        echo view('modernize/transaksi/index', $data);
    }

    public function input()
    {
        $model = new TransaksiModel();
        $lasttransaksi = $model->getLasttransaksi();

        $id_transaksi = 'T001'; // Nilai default jika tidak ada ID transaksi sebelumnya

        if (!empty($lasttransaksi)) {
            $lastIdNumber = (int) substr($lasttransaksi['id_transaksi'], 1);
            $availableIDs = [];

            // Mencari ID transaksi yang ada
            for ($i = 1; $i <= $lastIdNumber; $i++) {
                $checkID = 'T' . str_pad($i, 3, '0', STR_PAD_LEFT);
                $existingtransaksi = $model->getTransaksi($checkID)->getRowArray();
                if ($existingtransaksi) {
                    $availableIDs[] = $i;
                }
            }

            // Mencari ID transaksi yang terlewat
            $missedIDs = array_diff(range(1, $lastIdNumber), $availableIDs);
            if (count($missedIDs) > 0) {
                // Jika ada ID yang terlewat, gunakan ID terlewat terkecil sebagai ID transaksi berikutnya
                $nextIdNumber = min($missedIDs);
            } else {
                // Jika tidak ada ID yang terlewat, gunakan ID transaksi terakhir + 1
                $nextIdNumber = $lastIdNumber + 1;
            }

            // Format angka menjadi tiga digit dengan awalan nol jika perlu
            $id_transaksi = 'T' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);
        }



        return view('modernize/transaksi/input', ['id_transaksi' => $id_transaksi]);
    }

    public function store()
    {
        $validation =  \Config\Services::validation();

        $data = array(
            'id_transaksi'     => $this->request->getVar('id_transaksi'),
            'tgl_transaksi'     => $this->request->getVar('tgl_transaksi'),
            'alamat'   => $this->request->getVar('alamat'),
            'nama_customer'   => $this->request->getVar('nama_customer'),
            'no_hp' => $this->request->getVar('no_hp'),
            'nama_barang' => $this->request->getVar('nama_barang'),
            'jumlah_barang' => $this->request->getVar('jumlah_barang'),
            'total_bayar' => $this->request->getVar('total_bayar')
        );

        if ($validation->run($data, 'transaksi') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('/penjualan/transaksi/input'))->withInput();
        } else {
            $model = new TransaksiModel();
            $simpan = $model->inserttransaksi($data);
            if ($simpan) {
                session()->setFlashdata('input', 'Data transaksi berhasil ditambahkan!');
                return redirect()->to(base_url('/penjualan/transaksi'));
            }
        }
    }

    public function edit($id)
    {
        $model = new TransaksiModel();
        $data['transaksi'] = $model->getTransaksi($id)->getRowArray();
        echo view('modernize/transaksi/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('oldid_transaksi');
        $validation = \Config\Services::validation();

        $data = array(
            'id_transaksi'     => $this->request->getVar('id_transaksi'),
            'tgl_transaksi'     => $this->request->getVar('tgl_transaksi'),
            'alamat'   => $this->request->getVar('alamat'),
            'nama_customer'   => $this->request->getVar('nama_customer'),
            'no_hp' => $this->request->getVar('no_hp'),
            'nama_barang' => $this->request->getVar('nama_barang'),
            'jumlah_barang' => $this->request->getVar('jumlah_barang'),
            'total_bayar' => $this->request->getVar('total_bayar')
        );

        if ($validation->run($data, 'transaksi') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('/penjualan/transaksi/edit/' . $id))->withInput();
        } else {
            $model = new TransaksiModel();
            $ubah = $model->updatetransaksi($data, $id);
            if ($ubah) {
                session()->setFlashdata('update', 'Data transaksi berhasil diupdate!');
                return redirect()->to(base_url('/penjualan/transaksi'));
            }
        }
    }

    public function delete($id)
    {
        $model = new TransaksiModel();
        $hapus = $model->deleteTransaksi($id);
        if ($hapus) {
            session()->setFlashdata('delete', 'Data transaksi berhasil dihapus!');
            return redirect()->to(base_url('/penjualan/transaksi'));
        }
    }
}
