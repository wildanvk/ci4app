<?php

namespace App\Models;

use CodeIgniter\Model;

class PengirimanModel extends Model
{
    protected $table = 'pengiriman';

    public function getPengiriman($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_pengiriman' => $id]);
        }
    }

    public function getLastPengiriman()
    {
        return $this->orderBy('id_pengiriman', 'DESC')
            ->first();
    }

    public function getActivePengiriman()
    {
        return $this->where('status', 'Active')
            ->findAll();
    }
    public function getPengirimanByBulan($bulan)
    {
        return $this->table('pengiriman')
            ->select('pengiriman.*, transaksi.*')
            ->join('transaksi', 'pengiriman.id_transaksi = transaksi.id_transaksi')
            ->where('MONTH(tgl_pengiriman)', $bulan)
            ->get()
            ->getResultArray();
    }

    public function insertPengiriman($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updatePengiriman($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id_pengiriman' => $id]);
    }

    public function deletePengiriman($id)
    {
        return $this->db->table($this->table)->delete(['id_pengiriman' => $id]);
    }
}
