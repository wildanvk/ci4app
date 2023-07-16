<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\BarangMasukMentahModel;

class BarangMasukMentah extends Seeder
{
    public function run()
    {

        $today = date('dmy');

        for ($i = 11; $i <= 99; $i++) {
            $idTransaksi = 'TMBM-' . $today . '-' . str_pad($i, 3, '0', STR_PAD_LEFT);
            $data = [
                [
                    'idTransaksi' => $idTransaksi,
                    'tanggal' => '2023-06-22',
                    'idBarangMentah' => 'BM001',
                    'jumlah' => '100',
                    'harga' => '100000',
                    'keterangan' => 'Barang Masuk Mentah 1'
                ],
            ];
            // Masukkan data ke dalam tabel
            $this->db->table('barangmasukmentah')->insertBatch($data);
        }
    }
}
