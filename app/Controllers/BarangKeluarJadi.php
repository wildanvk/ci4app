<?php

namespace App\Controllers;

use App\Models\BarangJadiModel;
use App\Models\BarangKeluarJadiModel;

class BarangKeluarJadi extends BaseController
{
    public function index()
    {
        $barangjadi = new BarangJadiModel();
        $data['barangjadi'] = $barangjadi->getBarangJadi();

        return view('modernize/barangkeluar/barangjadi/index', $data);
    }
}
