<?php

namespace App\Controllers;

class Auth extends BaseController
{

    public function __construct()
    {
    helper('form');
    }

    public function index()
    {
        $data = [
            'judul' => 'Login',
            'page'  => 'v_login',
        ];
        return view('v_template_login', $data);
    }
    public function LoginUser()
    {
        $data = [
            'judul' => 'Login User',
            'page'  => 'v_login_User',
        ];
        return view('v_template_login', $data);
    }

    public function CekLoginUser()
    {
    }

    public function LoginAnggota()
    {
        $data = [
            'judul' => 'Login Anggota',
            'page'  => 'v_login_Anggota',
        ];
        return view('v_template_login', $data);
    }
}
