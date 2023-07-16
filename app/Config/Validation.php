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
}
