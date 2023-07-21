<?php

namespace App\Controllers;

use App\Models\BarangJadiModel;
use App\Models\StokBarangJadiModel;

class StokBarangJadi extends BaseController
{
    public function index()
    {
        echo view('modernize/stok/barangjadi/index');
    }
}
