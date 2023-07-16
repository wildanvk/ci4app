<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        $session = session();
        return view('modernize/auth/login');
    }

    public function auth()
    {
        $session = session();
        $model  =  new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->where('username', $username)->first();
        if ($data) {
            $pass = $data['password'];
            if ($pass == $password) {
                $session_data = [
                    'user_id'    => $data['user_id'],
                    'username'   => $data['username'],
                    'logged_in'  => TRUE
                ];
                $session->set($session_data);
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('pesan', 'Password yang anda masukkan salah!');
                return redirect()->to('/auth');
            }
        } else {
            $session->setFlashdata('pesan', 'Username yang anda masukkan tidak ada!');
            return redirect()->to('/auth');
        }
    }

    public function logout()
    {
        $session = session();
        $session->setFlashdata('logout', 'Anda telah berhasil logout!');
        $fields = ['user_id', 'username', 'logged_in'];
        $session->remove($fields);


        return redirect()->to('/auth');
    }
}
