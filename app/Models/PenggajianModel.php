<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggajianModel extends Model
{
    protected $table            = 'penggajian';

    public function getPenggajian($id = false)
    {
        if ($id === false) {
            return $this->table('penggajian')
                ->select('penggajian.*, data_karyawan.*')
                ->join('data_karyawan', 'penggajian.idkaryawan = data_karyawan.id_karyawan')
                ->orderBy('penggajian.idkaryawan', 'DESC')
                ->get()
                ->getResultArray();
        } else {
            return $this->table('penggajian')
                ->select('penggajian.*, data_karyawan.*')
                ->join('data_karyawan', 'penggajian.idkaryawan = data_karyawan.id_karyawan')
                ->where('penggajian.idpenggajian', $id)
                ->get()
                ->getRowArray();
        }
    }

    public function getPenggajianByBulan($bulan)
    {
        return $this->table('penggajian')
            ->select('penggajian.*, data_karyawan.*')
            ->join('data_karyawan', 'penggajian.idkaryawan = data_karyawan.id_karyawan')
            ->where('MONTH(tanggal)', $bulan)
            ->orderBy('penggajian.idkaryawan', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getLastPenggajian()
    {
        return $this->orderBy('idpenggajian', 'DESC')
            ->first();
    }

    public function insertPenggajian($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updatePenggajian($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['idpenggajian' => $id]);
    }

    public function deletePenggajian($id)
    {
        return $this->db->table($this->table)->delete(['idpenggajian' => $id]);
    }
}
