<?php

namespace App\Models;

use CodeIgniter\Model;

class PermintaanProduksiModel extends Model
{
    protected $table = 'permintaan_produksi';

    public function getPermintaanProduksi($id = false)
    {
        if ($id == false) {
            return $this->where('id_produksi !=', 'selesai')
                ->findAll();
        } else {
            return $this->getWhere(['id_produksi' => $id]);
        }
    }

    public function getLastPermintaanProduksi()
    {
        return $this->orderBy('id_produksi', 'DESC')
            ->first();
    }

    public function getStatusPermintaanProduksi()
    {
        return $this->where('id_produksi', 'pemolaan$pemotongan')
            ->findAll();
    }

    public function insertPermintaanProduksi($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updatePermintaanProduksi($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id_produksi' => $id]);
    }

    public function deletePermintaanProduksi($id)
    {
        return $this->db->table($this->table)->delete(['id_produksi' => $id]);
    }

}