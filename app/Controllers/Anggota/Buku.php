<?php

namespace App\Controllers\Anggota;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelBuku;

class Buku extends BaseController
{
    protected $ModelBuku;
    public function __construct()
    {
        $this->ModelBuku = new ModelBuku();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Buku',
            'judul' => 'Data Buku',
            'menu'  => 'koleksi',
            'submenu'  => 'buku',
            'page'  => 'dashboard_anggota/buku/v_index',
            'buku'  => $this->ModelBuku->getBukuWithRelasi(),
        ];
        return view('v_template_anggota', $data);
    }

    public function detail($id_buku)
    {
        $buku = $this->ModelBuku->getDetailBuku($id_buku);
        if (!$buku) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail Buku',
            'judul' => 'Detail Buku',
            'menu'  => 'koleksi',
            'submenu'  => 'buku',
            'page'  => 'dashboard_anggota/buku/v_detail',
            'buku'  => $buku,
        ];
        return view('v_template_anggota', $data);
    }
}
