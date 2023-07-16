<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SetDisplayMode extends BaseController
{
    public function index()
    {
        $session = session();

        // Mendapatkan nilai mode dari POST request
        $mode = $this->request->getPost('mode');

        // Simpan nilai mode ke sesi atau database sesuai kebutuhan
        $session->set('mode', $mode);

        // Kirimkan tanggapan kembali ke JavaScript
        $response = 'Mode set to: ' . $session->get('mode');
        return $response;
    }
}
