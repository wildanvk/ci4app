<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgresProduksiModel extends Model
{
    protected $table = 'progres_produksi';

    public function getProgresProduksi($id = false)
    {
        if ($id == false) {
            return $this->table('progres_produksi')
                ->select('progres_produksi.*, permintaan_produksi.id_produksi, permintaan_produksi.nama_barang, permintaan_produksi.jumlah')
                ->join('permintaan_produksi', 'progres_produksi.id_produksi = permintaan_produksi.id_produksi')
                ->where('status_produksi !=', 'selesai')
                ->orderBy('id_progres', 'ASC')
                ->get()
                ->getResultArray();
        } else {
            return $this->getWhere(['id_progres' => $id]);
        }
    }

    public function getLastProgresProduksi()
    {
        return $this->orderBy('id_progres', 'DESC')
            ->first();
    }

    public function getStatusProgresProduksi()
    {
        return $this->where('status_produksi', 'pemolaan$pemotongan')
            ->findAll();
    }

    public function insertProgresProduksi($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateProgresProduksi($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id_progres' => $id]);
    }

    public function deleteProgresProduksi($id)
    {
        return $this->db->table($this->table)->delete(['id_progres' => $id]);
    }
}
