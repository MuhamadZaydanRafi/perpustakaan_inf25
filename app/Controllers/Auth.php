<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Login',
        ];
        return view('v_login',$data);
    }
    public function LoginUser()
    {
    }

    public function LoginAnggota()
    {
    }

}
