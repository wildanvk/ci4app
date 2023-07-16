<?php

namespace App\Models;

use CodeIgniter\Model;

class StokBarangJadiModel extends Model
{
    protected $table            = 'stokbarangjadi';

    public function getStokBarangJadi($id = false)
    {
        if ($id === false) {
            return $this->table('stokbarangjadi')
                ->select('stokbarangjadi.*, barangjadi.idBarangJadi, barangjadi.namaBarangJadi')
                ->join('barangjadi', 'barangjadi.idBarangJadi = stokbarangjadi.idBarangJadi')
                ->where('status', 'Active')
                ->orderBy('idStokBarangJadi', 'ASC')
                ->get()
                ->getResultArray();
        } else {
            return $this->table('stokbarangjadi')
                ->join('barangjadi', 'barangjadi.idBarangJadi = stokbarangjadi.idBarangJadi')
                ->where('stokbarangjadi.idStokBarangJadi', $id)
                ->get()
                ->getRowArray();
        }
    }

    public function getStokBarangJadiByIdBarangJadi($id)
    {
        return $this->table('stokbarangjadi')
            ->where('idBarangJadi', $id)
            ->get()
            ->getRowArray();
    }

    public function getLastStokBarangJadi()
    {
        return $this->orderBy('idStokBarangJadi', 'DESC')
            ->first();
    }

    public function insertStokBarangJadi($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateStokBarangJadi($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['idStokBarangJadi' => $id]);
    }

    public function deleteStokBarangJadi($id)
    {
        return $this->db->table($this->table)->delete(['idStokBarangJadi' => $id]);
    }
}
