<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangKeluarJadiModel extends Model
{
    protected $table            = 'barangkeluarjadi';

    public function getBarangKeluarJadi($id = false)

    {
        if ($id === false) {
            return $this->table('barangkeluarjadi')
                ->select('barangkeluarjadi.*, barangjadi.namaBarangJadi')
                ->join('barangjadi', 'barangjadi.idBarangJadi = barangkeluarjadi.idBarangJadi')
                ->orderBy('inserted_at', 'DESC')
                ->get()
                ->getResultArray();
        } else {
            return $this->table('barangkeluarjadi')
                ->select('barangkeluarjadi.*, barangjadi.namaBarangJadi')
                ->join('barangjadi', 'barangjadi.idBarangJadi = barangkeluarjadi.idBarangJadi')
                ->where('barangkeluarjadi.idTransaksi', $id)
                ->get()
                ->getRowArray();
        }
    }

    public function getCountBarangKeluarJadi()
    {
        return $this->countAll();
    }

    public function getCountBarangKeluarJadiSortByBulan()
    {
        $result = $this->table('barangkeluarjadi')
            ->select('MONTH(tanggal) as bulan, COUNT(*) as jumlah')
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

    public function getSumBarangKeluar()
    {
        return $this->table('barangkeluarjadi')
            ->select('SUM(jumlah) as jumlah')
            ->get()
            ->getRowArray();
    }

    public function getSumBarangKeluarSortByBulan()
    {
        $result = $this->table('barangkeluarjadi')
            ->select('MONTH(tanggal) as bulan, SUM(jumlah) as jumlah')
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

    public function getBarangKeluarByDateRange($startDate, $endDate)
    {
        return $this->table('barangkeluarjadi')
            ->select('barangkeluarjadi.*, barangjadi.namaBarangJadi')
            ->join('barangjadi', 'barangjadi.idBarangJadi = barangkeluarjadi.idBarangJadi')
            ->where('tanggal >=', $startDate)
            ->where('tanggal <=', $endDate)
            ->orderBy('tanggal', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getLastTransaksi()
    {
        return $this->orderBy('idTransaksi', 'DESC')
            ->first();
    }

    public function insertBarangKeluarJadi($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateBarangKeluarJadi($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['idTransaksi' => $id]);
    }

    public function deleteBarangKeluarJadi($id)
    {
        return $this->db->table($this->table)->delete(['idTransaksi' => $id]);
    }
}
