<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BarangKeluarJadi extends Seeder
{
    public function run()
    {

        $today = date('dmy');

        for ($i = 1; $i <= 99; $i++) {
            $idTransaksi = 'TKBJ-' . $today . '-' . str_pad($i, 3, '0', STR_PAD_LEFT);
            $data = [
                [
                    'idTransaksi' => $idTransaksi,
                    'tanggal' => '2023-06-25',
                    'idBarangJadi' => 'BJ001',
                    'jumlah' => '100',
                    'harga' => '100000',
                    'keterangan' => 'Barang Keluar Jadi 1'
                ],
            ];
            // Masukkan data ke dalam tabel
            $this->db->table('barangkeluarjadi')->insertBatch($data);
        }
    }
}
