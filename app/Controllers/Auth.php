<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Login', 
            'page'  => 'v_login' 
        ];
        return view('v_template_login',$data);
    }

    public function LoginUser()
    {
    }

    public function LoginAnggota()
    {        
    }
}
