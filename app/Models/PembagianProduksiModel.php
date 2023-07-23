<?php

namespace App\Models;

use CodeIgniter\Model;

class PembagianProduksiModel extends Model
{
    protected $table = 'data_karyawan';

    public function getPembagianProduksi($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_karyawan' => $id]);
        }
    }

    public function getLastPembagianProduksi()
    {
        return $this->orderBy('id_karyawan', 'DESC')
            ->first();
    }

    public function insertPembagianProduksi($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updatePembagianProduksi($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id_karyawan' => $id]);
    }

    public function deletePembagianProduksi($id)
    {
        return $this->db->table($this->table)->delete(['id_karyawan' => $id]);
    }
}