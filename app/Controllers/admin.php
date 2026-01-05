<?php

namespace App\Controllers;
use App\Models\ModelAdmin;
use App\Controllers\BaseController;
class Admin extends BaseController
{
    protected $ModelAdmin;
    public function __construct()
    {
        $this->ModelAdmin = new ModelAdmin();
        helper('form');
    }
    public function index()
    {
        $data = [
            'menu' => 'dashboard',
            'submenu'=> '',
            'judul' => 'Admin',
            'page'  => 'v_admin',
            // 'buku'  =>  // $this->ModelAdmin->TotalBuku(),
            'user'  => $this->ModelAdmin->TotalUser(),
            // 'ebook' =>  // $this->ModelAdmin->TotalEBook(),
        ];
        return view('v_template_Admin',$data);
    }
}
