<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangJadiModel extends Model
{
    protected $table            = 'barangjadi';

    public function getBarangJadi($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->where('idBarangJadi', $id)
                ->first();
        }
    }

    public function getLastBarangJadi()
    {
        return $this->orderBy('idBarangJadi', 'DESC')
            ->first();
    }

    public function getActiveBarangJadi()
    {
        return $this->where('status', 'Active')
            ->findAll();
    }

    public function insertBarangJadi($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateBarangJadi($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['idBarangJadi' => $id]);
    }

    public function deleteBarangJadi($id)
    {
        return $this->db->table($this->table)->delete(['idBarangJadi' => $id]);
    }
}
