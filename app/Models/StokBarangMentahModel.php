<?php

namespace App\Models;

use CodeIgniter\Model;

class StokBarangMentahModel extends Model
{
    protected $table            = 'stokbarangmentah';

    public function getStokBarangMentah($id = false)
    {
        if ($id === false) {
            return $this->table('stokbarangmentah')
                ->select('stokbarangmentah.*, barangmentah.idBarangMentah, barangmentah.namaBarangMentah')
                ->join('barangmentah', 'barangmentah.idBarangMentah = stokbarangmentah.idBarangMentah')
                ->where('status', 'Active')
                ->orderBy('idStokBarangMentah', 'ASC')
                ->get()
                ->getResultArray();
        } else {
            return $this->table('stokbarangmentah')
                ->select('stokbarangmentah.*, barangmentah.idBarangMentah, barangmentah.namaBarangMentah')
                ->join('barangmentah', 'barangmentah.idBarangMentah = stokbarangmentah.idBarangMentah')
                ->where('stokbarangmentah.idStokBarangMentah', $id)
                ->where('status', 'Active')
                ->first();
        }
    }

    public function getSumStokBarangMentah()
    {
        return $this->table('stokbarangmentah')
            ->select('SUM(stokbarangmentah.stok) as stok')
            ->get()
            ->getRowArray();
    }

    public function getLastStokBarangMentah()
    {
        return $this->orderBy('idStokBarangMentah', 'DESC')
            ->first();
    }

    public function insertStokBarangMentah($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateStokBarangMentah($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['idStokBarangMentah' => $id]);
    }

    public function deleteStokBarangMentah($id)
    {
        return $this->db->table($this->table)->delete(['idStokBarangMentah' => $id]);
    }
}
