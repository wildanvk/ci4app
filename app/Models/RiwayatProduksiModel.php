<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatProduksiModel extends Model
{
    protected $table = 'riwayat_produksi';

    public function getRiwayatProduksi($id = false)
    {
        if ($id == false) {
            return $this->table('riwayat_produksi')
                ->select('riwayat_produksi.*, progres_produksi.*')
                ->join('progres_produksi', 'riwayat_produksi.id_produksi = progres_produksi.id_produksi')
                ->get()
                ->getResultArray();
        } else {
            return $this->getWhere(['id_riwayat_produksi' => $id]);
        }
    }

    public function getLastRiwayatProduksi()
    {
        return $this->orderBy('id_riwayat_produksi', 'DESC')
            ->first();
    }

    public function insertRiwayatProduksi($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateRiwayatProduksi($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id_riwayat_produksi' => $id]);
    }

    public function deleteRiwayatProduksi($id)
    {
        return $this->db->table($this->table)->delete(['id_riwayat_produksi' => $id]);
    }
}
