<?php

namespace App\Controllers;

use App\Models\SupplierModel;

class Supplier extends BaseController
{
    public function index()
    {
        echo view('modernize/master/supplier/index');
    }
}
