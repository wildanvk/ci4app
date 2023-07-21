<?php

namespace App\Controllers;

use App\Models\BarangJadiModel;

class BarangJadi extends BaseController
{
    public function index()
    {
        echo view('modernize/master/barangjadi/index');
    }
}
