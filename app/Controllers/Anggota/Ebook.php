<?php

namespace App\Controllers\Anggota;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelEbook;

class Ebook extends BaseController
{
    protected $ModelEbook;
    public function __construct()
    {
        $this->ModelEbook = new ModelEbook();
    }
    public function index()
    {
        $data = [
            'title' => 'Data E-Book',
            'judul' => 'Data E-Book',
            'menu'  => 'koleksi',
            'submenu'  => 'ebook',
            'page'  => 'dashboard_anggota/ebook/v_index',
            'ebook'  => $this->ModelEbook->getEbookWithRelasi(),
        ];
        return view('v_template_anggota', $data);
    }

    public function detail($id_ebook)
    {
        $ebook = $this->ModelEbook->getDetailEbook($id_ebook);
        if (!$ebook) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('E-Book tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail E-Book',
            'judul' => 'Detail E-Book',
            'menu'  => 'koleksi',
            'submenu'  => 'ebook',
            'page'  => 'dashboard_anggota/ebook/v_detail',
            'ebook'  => $ebook,
        ];
        return view('v_template_anggota', $data);
    }

    public function download($id_ebook)
    {
        $ebook = $this->ModelEbook->find($id_ebook);
        if (!$ebook) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data e-book tidak ditemukan');
        }

        $filePath = ROOTPATH . 'public/uploads/ebook/' . $ebook['file_ebook'];
        if (!is_file($filePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File tidak ditemukan');
        }

        return $this->response->download($filePath, null);
    }
}
