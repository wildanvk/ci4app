<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangMentahModel extends Model
{
    protected $table            = 'barangmentah';

    public function getBarangMentah($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->where('idBarangMentah', $id)
                ->first();
        }
    }

    public function getCountBarangMentah()
    {
        return $this->countAll();
    }

    public function getLastBarangMentah()
    {
        return $this->orderBy('idBarangMentah', 'DESC')
            ->first();
    }

    public function getActiveBarangMentah()
    {
        return $this->where('status', 'Active')
            ->findAll();
    }

    public function insertBarangMentah($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateBarangMentah($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['idBarangMentah' => $id]);
    }

    public function deleteBarangMentah($id)
    {
        return $this->db->table($this->table)->delete(['idBarangMentah' => $id]);
    }
}
