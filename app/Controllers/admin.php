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
            'total_buku'  =>   $this->ModelAdmin->TotalBuku(),
            'total_user'  => $this->ModelAdmin->TotalUser(),
            'total_ebook' =>   $this->ModelAdmin->TotalEBook(),
            'total_peminjaman_pending' => $this->ModelAdmin->TotalPeminjamanPending(),
        ];
        return view('v_template_Admin',$data);
    }
}
