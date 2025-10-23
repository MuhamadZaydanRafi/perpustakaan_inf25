<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function login()
    {
        $data = [
            'judul' => 'Login',
            
        ];
        return view('v_login',$data);
    }
}
