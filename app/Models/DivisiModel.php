<?php

namespace App\Models;

use CodeIgniter\Model;

class DivisiModel extends Model
{
    protected $table = 'divisi';

    public function getDivisi($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_divisi' => $id]);
        }
    }

    public function getLastDivisi()
    {
        return $this->orderBy('id_divisi', 'DESC')
            ->first();
    }

    public function insertDivisi($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateDivisi($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id_divisi' => $id]);
    }

    public function deleteDivisi($id)
    {
        return $this->db->table($this->table)->delete(['id_divisi' => $id]);
    }
}
