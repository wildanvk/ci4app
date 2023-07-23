<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';

    public function getTransaksi($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_transaksi' => $id]);
        }
    }

    public function getLastTransaksi()
    {
        return $this->orderBy('id_transaksi', 'DESC')
            ->first();
    }

    public function getActiveTransaksi()
    {
        return $this->where('status', 'Active')
            ->findAll();
    }

    public function insertTransaksi($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateTransaksi($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id_transaksi' => $id]);
    }

    public function deleteTransaksi($id)
    {
        return $this->db->table($this->table)->delete(['id_transaksi' => $id]);
    }
}
