<?php

namespace App\Controllers;

use App\Models\BarangMentahModel;
use App\Models\StokBarangMentahModel;

class StokBarangMentah extends BaseController
{
    public function index()
    {
        echo view('modernize/stok/barangmentah/index');
    }
}
