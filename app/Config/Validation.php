<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public $supplier = [
        'idSupplier'     => 'required',
        'namaSupplier'     => 'required',
        'alamat'     => 'required',
        'kontak'     => 'required',
        'status'     => 'required',
    ];

    public $supplier_errors = [
        'idSupplier' => [
            'required'    => 'ID Supplier wajib diisi.',
        ],
        'namaSupplier'    => [
            'required' => 'Nama Supplier wajib diisi.',
        ],
        'alamat'    => [
            'required' => 'Alamat Supplier wajib diisi.',
        ],
        'kontak'    => [
            'required' => 'Kontak Supplier wajib diisi.',
        ],
        'status'    => [
            'required' => 'Status Supplier wajib diisi.',
        ],
    ];

    public $barangmentah = [
        'idBarangMentah'     => 'required',
        'namaBarangMentah'     => 'required',
        'status'     => 'required',
    ];

    public $barangmentah_errors = [
        'idBarangMentah' => [
            'required'    => 'ID Barang Mentah wajib diisi.',
        ],
        'namaBarangMentah'    => [
            'required' => 'Nama Barang Mentah wajib diisi.',
        ],
        'status'    => [
            'required' => 'Status Barang Mentah wajib diisi.',
        ],
    ];

    public $barangjadi = [
        'idBarangJadi'     => 'required',
        'namaBarangJadi'     => 'required',
        'status'     => 'required',
    ];

    public $barangjadi_errors = [
        'idBarangJadi' => [
            'required'    => 'ID Barang Jadi wajib diisi.',
        ],
        'namaBarangJadi'    => [
            'required' => 'Nama Barang Jadi wajib diisi.',
        ],
        'status'    => [
            'required' => 'Status Barang Jadi wajib diisi.',
        ],
    ];

    public $stokbarangmentah = [
        'idStokBarangMentah'     => 'required',
        'idBarangMentah'     => 'required',
        'stok'     => 'required',
    ];

    public $stokbarangmentah_errors = [
        'idStokBarangMentah' => [
            'required'    => 'ID Stok wajib diisi.',
        ],
        'idBarangMentah'    => [
            'required' => 'Barang Mentah wajib diisi.',
        ],
        'stok'    => [
            'required' => 'Stok barang wajib diisi.',
        ],
    ];

    public $stokbarangjadi = [
        'idStokBarangJadi'     => 'required',
        'idBarangJadi'     => 'required',
        'stok'     => 'required',
    ];

    public $stokbarangjadi_errors = [
        'idStokBarangJadi' => [
            'required'    => 'ID Stok wajib diisi.',
        ],
        'idBarangJadi'    => [
            'required' => 'Barang Jadi wajib diisi.',
        ],
        'stok'    => [
            'required' => 'Stok barang wajib diisi.',
        ],
    ];

    public $barangmasukmentah = [
        'idTransaksi'     => 'required',
        'tanggal'     => 'required',
        'idBarangMentah'     => 'required',
        'idSupplier'     => 'required',
        'jumlah'     => 'required',
        'harga'     => 'required',
    ];

    public $barangmasukmentah_errors = [
        'idTransaksi' => [
            'required'    => 'ID Transaksi wajib diisi.',
        ],
        'tanggal'    => [
            'required' => 'Tanggal wajib diisi.',
        ],
        'idBarangMentah'    => [
            'required' => 'Barang Mentah wajib diisi.',
        ],
        'idSupplier'    => [
            'required' => 'Supplier wajib diisi.',
        ],
        'jumlah'    => [
            'required' => 'Jumlah wajib diisi.',
        ],
        'harga'    => [
            'required' => 'Harga wajib diisi.',
        ],
    ];

    public $barangkeluarjadi = [
        'idTransaksi'     => 'required',
        'tanggal'     => 'required',
        'idBarangJadi'     => 'required',
        'jumlah'     => 'required',
        'harga'     => 'required',
    ];

    public $barangkeluarjadi_errors = [
        'idTransaksi' => [
            'required'    => 'ID Transaksi wajib diisi.',
        ],
        'tanggal'    => [
            'required' => 'Tanggal wajib diisi.',
        ],
        'idBarangJadi'    => [
            'required' => 'Barang Jadi wajib diisi.',
        ],
        'jumlah'    => [
            'required' => 'Jumlah wajib diisi.',
        ],
        'harga'    => [
            'required' => 'Harga wajib diisi.',
        ],
    ];

    public $datakaryawan = [
        'id_karyawan' => 'required',
        'nama_karyawan' => 'required',
        'id_divisi' => 'required',
    ];

    public $datakaryawan_errors = [
        'id_karyawan' => [
            'required' => 'Id Karyawan wajib diisi.',
        ],
        'nama_karyawan' => [
            'required' => 'Nama Karyawan wajib diisi.',
        ],
        'id_divisi' => [
            'required' => 'Divisi Karyawan wajib diisi.',
        ],
    ];

    public $divisi = [
        'id_divisi' => 'required',
        'divisi' => 'required',
    ];

    public $divisi_errors = [
        'id_divisi' => [
            'required' => 'Id divisi wajib diisi.',
        ],
        'divisi' => [
            'required' => 'Divisi wajib diisi.',
        ],
    ];

    public $permintaanproduksi = [
        'id_produksi' => 'required',
        'nama_barang' => 'required',
        'jumlah' => 'required',
    ];

    public $permintaanproduksi_errors = [
        'id_produksi' => [
            'required' => 'Id produksi wajib diisi.',
        ],
        'nama_barang' => [
            'required' => 'Nama barang wajib diisi.',
        ],
        'jumlah' => [
            'required' => 'Jumlah wajib diisi.',
        ],
    ];

    public $progresproduksi = [
        'id_progres' => 'required',
        'id_produksi' => 'required',
        'tgl_produksi' => 'required',
        'status_produksi' => 'required',
    ];

    public $progresproduksi_errors = [
        'id_produksi' => [
            'required' => 'Id Produksi wajib diisi.',
        ],
        'tgl_produksi' => [
            'required' => 'Tanggal Produksi wajib diisi.',
        ],
        'status_produksi' => [
            'required' => 'Status Produksi wajib diisi.',
        ],
    ];

    public $riwayatproduksi = [
        'id_riwayat_produksi' => 'required',
        'id_produksi' => 'required',
        'nama_barang' => 'required',
        'jumlah' => 'required',
        'tgl_produksi' => 'required',
        'tgl_selesai' => 'required',
    ];

    public $riwayatproduksi_errors = [
        'id_riwayat_produksi' => [
            'required' => 'Id Riwayat Produksi wajib diisi.',
        ],
        'id_produksi' => [
            'required' => 'Id Produksi wajib diisi.',
        ],
        'nama_barang' => [
            'required' => 'Nama Barang wajib diisi.',
        ],
        'jumlah' => [
            'required' => 'Jumlah wajib diisi.',
        ],
        'tgl_produksi' => [
            'required' => 'Tanggal Produksi wajib diisi.',
        ],
        'tgl_selesai' => [
            'required' => 'Tanggal Selesai wajib diisi.',
        ],
    ];

    public $karyawan = [
        'idkaryawan'     => 'required',
        'nama'     => 'required',
        'bagian'     => 'required',
        'jenis_kelamin'     => 'required',
        'alamat'     => 'required',
    ];

    public $karyawan_errors = [
        'idkaryawan' => [
            'required'    => 'ID Karyawan wajib diisi.',
        ],
        'nama'    => [
            'required' => 'Nama Karyawan wajib diisi.',
        ],
        'bagian'    => [
            'required' => 'Bagian Karyawan wajib diisi.',
        ],
        'jenis_kelamin'    => [
            'required' => 'Jenis Kelamin Karyawan wajib diisi.',
        ],
        'alamat'    => [
            'required' => 'Alamat Karyawan wajib diisi.',
        ],
    ];

    public $penggajian = [
        'idpenggajian'     => 'required',
        'idkaryawan'     => 'required',
        'tanggal'     => 'required',
        'jumlahproduksi'     => 'required',
        'totalgaji'     => 'required',
    ];

    public $penggajian_errors = [
        'idpenggajian' => [
            'required'    => 'ID Penggajian wajib diisi.',
        ],
        'idkaryawan'    => [
            'required' => 'ID Karyawan wajib diisi.',
        ],
        'tanggal'    => [
            'required' => 'Tanggal wajib diisi.',
        ],
        'jumlahproduksi'    => [
            'required' => 'Jumlah Produksi wajib diisi.',
        ],
        'totalgaji'    => [
            'required' => 'Total Gaji wajib diisi.',
        ],
    ];

    public $transaksi = [
        'tgl_transaksi'     => 'required',
        'id_transaksi'     => 'required',
        'nama_customer'     => 'required',
        'alamat'     => 'required',
        'no_hp'     => 'required',
        'nama_barang'     => 'required',
        'jumlah_barang'     => 'required',
        'total_bayar'     => 'required',

    ];

    public $transaksi_errors = [
        'id_transaksi' => [
            'required'    => 'ID pengiriman wajib diisi.',
        ],
        'nama_customer'    => [
            'required' => 'Nama Customer wajib diisi.',
        ],
        'alamat'    => [
            'required' => 'Alamat pengiriman wajib diisi.',
        ],
        'no_hp'    => [
            'required' => 'NO HP pengiriman wajib diisi.',
        ],
        'nama_barang'    => [
            'required' => 'Nama Barang wajib diisi.',
        ],
        'jumlah_barang'    => [
            'required' => 'Jumlah Barang pengiriman wajib diisi.',
        ],
        'total_bayar'    => [
            'required' => 'Total Bayar pengiriman wajib diisi.',
        ],

    ];

    public $pengiriman = [
        'id_pengiriman' => 'required',
        'id_transaksi'     => 'required',
        'resi'     => 'required',

    ];

    public $pengiriman_errors = [

        'id_pengiriman' => [
            'required' => 'ID Pesanan wajib diisi.'
        ],

        'id_transaksi' => [
            'required'    => 'ID transaksi wajib diisi.',
        ],
        'resi'    => [
            'required' => 'Resi wajib diisi.',
        ],

    ];

    public $request = [
        'id_request'     => 'required',
        'id_transaksi'     => 'required',
        'jumlah_pesanan'     => 'required',
        'status_request'     => 'required',
    ];

    public $request_errors = [
        'id_request' => [
            'required'    => 'ID Request wajib diisi.',
        ],
        'id_transaksi'    => [
            'required' => 'ID Transaksi wajib diisi.',
        ],
        'jumlah_pesanan'    => [
            'required' => 'Jumlah pesanan wajib diisi.',
        ],
        'status_request'    => [
            'required' => 'Status request wajib diisi.',
        ],
    ];
}
