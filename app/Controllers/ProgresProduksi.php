<?php

namespace App\Controllers;

use App\Models\ProgresProduksiModel;
use App\Models\RiwayatProduksiModel;
use App\Models\PermintaanProduksiModel;

class progresproduksi extends BaseController
{
    public function index()
    {
        $model = new ProgresProduksiModel();
        $data['progresproduksi'] = $model->getProgresProduksi();
        echo view('modernize/progresproduksi/index', $data);
    }

    public function input()
    {
        $model = new ProgresProduksiModel();
        $produksi = new PermintaanProduksiModel();
        $lastProgresProduksi = $model->getLastProgresProduksi();

        $id_progres = 'S001'; // Nilai default jika tidak ada ID produksi sebelumnya

        if (!empty($lastProgresProduksi)) {
            $lastIdNumber = (int) substr($lastProgresProduksi['id_progres'], 1);
            $availableIDs = [];

            // Mencari ID progresproduksi yang ada
            for ($i = 1; $i <= $lastIdNumber; $i++) {
                $checkID = 'S' . str_pad($i, 3, '0', STR_PAD_LEFT);
                $existingDataKaryawan = $model->getProgresProduksi($checkID)->getRowArray();
                if ($existingDataKaryawan) {
                    $availableIDs[] = $i;
                }
            }

            // Mencari ID progresproduksi yang terlewat
            $missedIDs = array_diff(range(1, $lastIdNumber), $availableIDs);
            if (count($missedIDs) > 0) {
                // Jika ada ID yang terlewat, gunakan ID terlewat terkecil sebagai ID progresproduksi berikutnya
                $nextIdNumber = min($missedIDs);
            } else {
                // Jika tidak ada ID yang terlewat, gunakan ID progresproduksi terakhir + 1
                $nextIdNumber = $lastIdNumber + 1;
            }

            // Format angka menjadi tiga digit dengan awalan nol jika perlu
            $id_progres = 'S' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);
        }

        $data['id_produksi'] = $produksi->getPermintaanProduksi();
        $data['id_progres'] = $id_progres;


        return view('modernize/progresproduksi/input', $data);
    }



    public function store()
    {
        $validation = \Config\Services::validation();

        $data = array(
            'id_progres' => $this->request->getVar('id_progres'),
            'id_produksi' => $this->request->getVar('id_produksi'),
            'tgl_produksi' => $this->request->getVar('tgl_produksi'),
            'status_produksi' => $this->request->getVar('status_produksi'),
        );

        if ($validation->run($data, 'progresproduksi') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('progresproduksi/input'))->withInput();
        } else {
            $model = new ProgresProduksiModel();
            $simpan = $model->insertProgresProduksi($data);
            if ($simpan) {
                session()->setFlashdata('input', 'Data progresproduksi berhasil ditambahkan!');
                return redirect()->to(base_url('progresproduksi'));
            }
        }
    }

    public function edit($id)
    {
        $model = new ProgresProduksiModel();
        $produksi = new PermintaanProduksiModel();
        $data['id_produksi'] = $produksi->getPermintaanProduksi();
        $data['progresproduksi'] = $model->getProgresProduksi($id)->getRowArray();
        echo view('modernize/progresproduksi/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('oldidproduksi');
        $validation = \Config\Services::validation();

        $data = array(
            'id_progres' => $this->request->getVar('id_progres'),
            'id_produksi' => $this->request->getVar('id_produksi'),
            'tgl_produksi' => $this->request->getVar('tgl_produksi'),
            'status_produksi' => $this->request->getVar('status_produksi'),
        );

        if ($validation->run($data, 'progresproduksi') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('progresproduksi/edit/' . $id))->withInput();
        } else {
            $model = new ProgresProduksiModel();
            $ubah = $model->updateProgresProduksi($data, $id);
            if ($ubah) {
                if ($data['status_produksi'] === 'selesai') {

                    $modelRiwayat = new RiwayatProduksiModel();
                    $lastRiwayatProduksi = $modelRiwayat->getLastRiwayatProduksi();
                    $now = date("Y-m-d");

                    $id_riwayat_produksi = 'R001'; // Nilai default jika tidak ada ID riwayatproduksi sebelumnya

                    if (!empty($lastRiwayatProduksi)) {
                        $lastIdNumber = (int) substr($lastRiwayatProduksi['id_riwayat_produksi'], 1);
                        $availableIDs = [];

                        // Mencari ID riwayatproduksi yang ada
                        for ($i = 1; $i <= $lastIdNumber; $i++) {
                            $checkID = 'R' . str_pad($i, 3, '0', STR_PAD_LEFT);
                            $existingRiwayatProduksi = $modelRiwayat->getRiwayatProduksi($checkID)->getRowArray();
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

                    $produksi = new PermintaanProduksiModel();
                    $dataProduksi = $produksi->getPermintaanProduksi($this->request->getVar('id_produksi'))->getRowArray();

                    $inputRiwayat = array(
                        'id_riwayat_produksi' => $id_riwayat_produksi,
                        'id_produksi' => $dataProduksi['id_produksi'],
                        'nama_barang' => $dataProduksi['nama_barang'],
                        'jumlah' => $dataProduksi['jumlah'],
                        'tgl_produksi' => $this->request->getVar('tgl_produksi'),
                        'tgl_selesai' => $now,
                    );

                    $simpan = $modelRiwayat->insertRiwayatProduksi($inputRiwayat);
                    if ($simpan) {
                        session()->setFlashdata('update', 'Progres Produksi berhasil diupdate!');
                        return redirect()->to(base_url('progresproduksi'));
                    }
                }
                session()->setFlashdata('update', 'Progres Produksi berhasil diupdate!');
                return redirect()->to(base_url('progresproduksi'));
            }
        }
    }

    public function delete($id)
    {
        $model = new ProgresProduksiModel();
        $hapus = $model->deleteProgresProduksi($id);
        if ($hapus) {
            session()->setFlashdata('delete', 'Progres Produksi berhasil dihapus!');
            return redirect()->to(base_url('progresproduksi'));
        }
    }
}
