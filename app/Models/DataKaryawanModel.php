<?php

namespace App\Models;

use CodeIgniter\Model;

class DataKaryawanModel extends Model
{
    protected $table = 'data_karyawan';

    public function getDataKaryawan($id = false)
    {
        if ($id == false) {
            return $this->table('data_karyawan')
            ->select('data_karyawan.*, divisi.divisi')
            ->join('divisi', 'data_karyawan.id_divisi = divisi.id_divisi')
            ->get()
            ->getResultArray();
        } else {
            return $this->getWhere(['id_karyawan' => $id]);
        }
    }

    public function getLastDataKaryawan()
    {
        return $this->orderBy('id_karyawan', 'DESC')
            ->first();
    }

    public function insertDataKaryawan($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateDataKaryawan($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id_karyawan' => $id]);
    }

    public function deleteDataKaryawan($id)
    {
        return $this->db->table($this->table)->delete(['id_karyawan' => $id]);
    }
}
