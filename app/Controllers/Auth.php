<?php

namespace App\Controllers;

use App\Models\ModelAuth;

use App\Models\ModelAuth;
class Auth extends BaseController
{

    public function __construct()
    {
    helper('form');
    $this->ModelAuth = new ModelAuth;
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
