<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestModel extends Model
{
    protected $table = 'request';

    public function getRequest($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_request' => $id]);
        }
    }

    public function getLastRequest()
    {
        return $this->orderBy('id_request', 'DESC')
            ->first();
    }

    public function getActiveRequest()
    {
        return $this->where('status', 'Active')
            ->findAll();
    }

    public function insertRequest($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateRequest($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id_request' => $id]);
    }

    public function deleteRequest($id)
    {
        return $this->db->table($this->table)->delete(['id_request' => $id]);
    }
}
