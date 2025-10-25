<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        $data = [
<<<<<<<< HEAD:app/Controllers/Login.php
            'judul' => 'Login',
========
            'judul' => 'Login',  
>>>>>>>> f07e00cacef258184197f08fae743d635eb0e408:app/Controllers/login.php
        ];
        return view('v_login',$data);
    }
}
