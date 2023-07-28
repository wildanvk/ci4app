<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Header;
use App\Models\PenggajianModel;

Header('Access-Control-Allow-Origin:*');
Header('X-Requested-With: XMLHttpRequest');
Header('Access-Control-Allow-Methods:GET,PUT,POST,DELETE,OPTIONS');
Header('Content-Type:application\json');
Header('Access-control-allow-headers:Content-Type,Access-Control-Allow-Headers,Authorization,x-Requested-with');

class PenggajianAPI extends ResourceController
{
    use ResponseTrait;
    public function getAllData()
    {
        $model = new PenggajianModel();
        $data['penggajian'] = $model->getPenggajian();
        return $this->respond($data);
    }

    public function getDataByDate()
    {
        $bulan = $this->request->getVar('bulan');

        $model = new PenggajianModel();
        $data['penggajian'] = $model->getPenggajianByBulan($bulan);
        return $this->respond($data);
    }
}
