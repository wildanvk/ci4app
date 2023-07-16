<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangMasukMentahModel extends Model
{
    protected $table            = 'barangmasukmentah';

    public function getBarangMasukMentah($id = false)
    {
        if ($id === false) {
            return $this->table('barangmasukmentah')
                ->select('barangmasukmentah.*, barangmentah.namaBarangMentah, supplier.namaSupplier')
                ->join('barangmentah', 'barangmentah.idBarangMentah = barangmasukmentah.idBarangMentah')
                ->join('supplier', 'supplier.idSupplier = barangmasukmentah.idSupplier')
                ->orderBy('inserted_at', 'DESC')
                ->get()
                ->getResultArray();
        } else {
            return $this->table('barangmasukmentah')
                ->select('barangmasukmentah.*, barangmentah.namaBarangMentah, supplier.namaSupplier')
                ->join('barangmentah', 'barangmentah.idBarangMentah = barangmasukmentah.idBarangMentah')
                ->join('supplier', 'supplier.idSupplier = barangmasukmentah.idSupplier')
                ->where('barangmasukmentah.idTransaksi', $id)
                ->get()
                ->getRowArray();
        }
    }

    public function getLastTransaksi($tanggal)
    {
        return $this->like('idTransaksi', $tanggal)
            ->orderBy('idTransaksi', 'DESC')
            ->first();
    }

    public function insertBarangMasukMentah($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateBarangMasukMentah($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['idTransaksi' => $id]);
    }

    public function deleteBarangMasukMentah($id)
    {
        return $this->db->table($this->table)->delete(['idTransaksi' => $id]);
    }
}
