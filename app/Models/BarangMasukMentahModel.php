<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangMasukMentahModel extends Model
{
    protected $table            = 'barangmasukmentah';

    public function getBarangMasukMentah($id = false)
    {
        if ($id === false) {
            return $this->table('barangmasukmentah')
                ->select('barangmasukmentah.*, barangmentah.namaBarangMentah, supplier.namaSupplier')
                ->join('barangmentah', 'barangmentah.idBarangMentah = barangmasukmentah.idBarangMentah')
                ->join('supplier', 'supplier.idSupplier = barangmasukmentah.idSupplier')
                ->orderBy('inserted_at', 'DESC')
                ->get()
                ->getResultArray();
        } else {
            return $this->table('barangmasukmentah')
                ->select('barangmasukmentah.*, barangmentah.namaBarangMentah, supplier.namaSupplier')
                ->join('barangmentah', 'barangmentah.idBarangMentah = barangmasukmentah.idBarangMentah')
                ->join('supplier', 'supplier.idSupplier = barangmasukmentah.idSupplier')
                ->where('barangmasukmentah.idTransaksi', $id)
                ->get()
                ->getRowArray();
        }
    }

    public function getCountBarangMasukMentah()
    {
        return $this->countAll();
    }

    public function getCountBarangMasukMentahSortByBulan()
    {
        $result = $this->table('barangmasukmentah')
            ->select('MONTH(tanggal) as bulan, COUNT(*) as jumlah')
            ->where('YEAR(tanggal)', date('Y'))
            ->groupBy('bulan')
            ->get()
            ->getResultArray();

        // Ubah struktur hasil menjadi array asosiatif dengan bulan sebagai kunci
        $data = [];
        foreach ($result as $row) {
            $bulan = $row['bulan'];
            $data[$bulan] = $row['jumlah'];
        }

        // Kembalikan hasil dalam bentuk array asosiatif
        return $data;
    }

    public function getSumBarangMasuk()
    {
        return $this->table('barangmasukmentah')
            ->select('SUM(jumlah) as jumlah')
            ->get()
            ->getRowArray();
    }

    public function getSumBarangMasukSortByBulan()
    {
        $result = $this->table('barangmasukmentah')
            ->select('MONTH(tanggal) as bulan, SUM(jumlah) as jumlah')
            ->where('YEAR(tanggal)', date('Y'))
            ->groupBy('bulan')
            ->get()
            ->getResultArray();

        // Ubah struktur hasil menjadi array asosiatif dengan bulan sebagai kunci
        $data = [];
        foreach ($result as $row) {
            $bulan = $row['bulan'];
            $data[$bulan] = $row['jumlah'];
        }

        // Kembalikan hasil dalam bentuk array asosiatif
        return $data;
    }

    public function getSumPengeluaranBulanIni()
    {
        return $this->table('barangmasukmentah')
            ->select('SUM(harga) as jumlah')
            ->where('MONTH(tanggal)', date('m'))
            ->get()
            ->getRowArray();
    }

    public function getSumPengeluaranSortByBulan()
    {
        $result = $this->table('barangmasukmentah')
            ->select('MONTH(tanggal) as bulan, SUM(harga) as jumlah')
            ->where('YEAR(tanggal)', date('Y'))
            ->groupBy('bulan')
            ->get()
            ->getResultArray();

        // Ubah struktur hasil menjadi array asosiatif dengan bulan sebagai kunci
        $data = [];
        foreach ($result as $row) {
            $bulan = $row['bulan'];
            $data[$bulan] = $row['jumlah'];
        }

        // Kembalikan hasil dalam bentuk array asosiatif
        return $data;
    }

    public function getBarangMasukByDateRange($startDate, $endDate)
    {
        return $this->table('barangmasukmentah')
            ->select('barangmasukmentah.*, barangmentah.namaBarangMentah, supplier.namaSupplier')
            ->join('barangmentah', 'barangmentah.idBarangMentah = barangmasukmentah.idBarangMentah')
            ->join('supplier', 'supplier.idSupplier = barangmasukmentah.idSupplier')
            ->where('tanggal >=', $startDate)
            ->where('tanggal <=', $endDate)
            ->orderBy('inserted_at', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getLastTransaksi($tanggal)
    {
        return $this->like('idTransaksi', $tanggal)
            ->orderBy('idTransaksi', 'DESC')
            ->first();
    }

    public function insertBarangMasukMentah($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateBarangMasukMentah($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['idTransaksi' => $id]);
    }

    public function deleteBarangMasukMentah($id)
    {
        return $this->db->table($this->table)->delete(['idTransaksi' => $id]);
    }
}
