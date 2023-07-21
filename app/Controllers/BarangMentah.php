<?php

namespace App\Controllers;

use App\Models\BarangMentahModel;

class BarangMentah extends BaseController
{
    public function index()
    {
        echo view('modernize/master/barangmentah/index');
    }
}
