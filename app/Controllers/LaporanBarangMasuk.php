<?php

namespace App\Controllers;

use App\Models\BarangMentahModel;
use App\Models\SupplierModel;
use App\Models\BarangMasukMentahModel;

class LaporanBarangMasuk extends BaseController
{
    public function index()
    {
        $model = new BarangMasukMentahModel();
        $barangmentah = new BarangMentahModel();
        $supplier = new SupplierModel();
        $data['barangmasukmentah'] = $model->getBarangMasukMentah();
        $data['barangmentah'] = $barangmentah->getActiveBarangMentah();
        $data['supplier'] = $supplier->getActiveSupplier();

        return view('modernize/barangmasuk/barangmentah/index', $data);
    }
}
