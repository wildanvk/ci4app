<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table            = 'karyawan';

    public function getDataKaryawan($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['idkaryawan' => $id]);
        }
    }

    public function getLastKaryawan()
    {
        return $this->orderBy('idkaryawan', 'DESC')
            ->first();
    }

    public function insertKaryawan($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateKaryawan($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['idkaryawan' => $id]);
    }

    public function deleteKaryawan($id)
    {
        return $this->db->table($this->table)->delete(['idkaryawan' => $id]);
    }
}
