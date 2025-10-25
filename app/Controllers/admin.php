<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Admin',
            'page'  => 'v_Admin',
        ];
        return view('v_template_Admin',$data);
    }
}
