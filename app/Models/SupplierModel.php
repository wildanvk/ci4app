<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table = 'supplier';

    public function getSupplier($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->where('idSupplier', $id)
                ->first();
        }
    }

    public function getCountSupplier()
    {
        return $this->countAll();
    }

    public function getLastSupplier()
    {
        return $this->orderBy('idSupplier', 'DESC')
            ->first();
    }

    public function getActiveSupplier()
    {
        return $this->where('status', 'Active')
            ->findAll();
    }

    public function insertSupplier($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateSupplier($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['idSupplier' => $id]);
    }

    public function deleteSupplier($id)
    {
        return $this->db->table($this->table)->delete(['idSupplier' => $id]);
    }
}
