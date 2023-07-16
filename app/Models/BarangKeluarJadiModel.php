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
