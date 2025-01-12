<?php 
// app/Controllers/AuthController.php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function doLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set('logged_in', true);
            session()->set('username', $user['username']);
            return redirect()->to('/');
        } else {
            return redirect()->to('/login')->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}