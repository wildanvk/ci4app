<?php

namespace App\Controllers;

use App\Models\BarangMentahModel;
use App\Models\SupplierModel;
use App\Models\BarangMasukMentahModel;

class BarangMasukMentah extends BaseController
{
    public function index()
    {
        $barangmentah = new BarangMentahModel();
        $supplier = new SupplierModel();
        $data['barangmentah'] = $barangmentah->getActiveBarangMentah();
        $data['supplier'] = $supplier->getActiveSupplier();

        return view('modernize/barangmasuk/barangmentah/index', $data);
    }
}
