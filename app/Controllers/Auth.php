<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('modernize/auth/login');
    }

    public function auth()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $user = $model->where('username', $username)->first();
        if ($user) {
            $pass = $user['password'];
            if ($pass == $password) {
                $this->setUserSession($user);
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('pesan', 'Password yang anda masukkan salah!');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('pesan', 'Username yang anda masukkan tidak ada!');
            return redirect()->to('/login');
        }
    }

    private function setUserSession($user)
    {
        $sessionData = [
            'user_id' => $user['userId'],
            'username' => $user['username'],
            'role' => $user['role'],
            'logged_in' => true,
        ];

        session()->set($sessionData);
        return true;
    }

    public function logout()
    {
        $session = session();
        $session->setFlashdata('logout', 'Anda telah berhasil logout!');
        $fields = ['user_id', 'username', 'role', 'logged_in'];
        $session->remove($fields);


        return redirect()->to('/login');
    }
}