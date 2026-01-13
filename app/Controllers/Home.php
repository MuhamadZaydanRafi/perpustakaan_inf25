<?php

namespace App\Controllers;
use App\Models\ModelSlider;
use App\Controllers\BaseController;
use App\Models\ModelPengaturan;
use App\Models\ModelBuku;
use App\Models\ModelEbook;

class Home extends BaseController
{
     protected $ModelSlider;
     protected $ModelEbook;
     protected $ModelBuku;
    protected $ModelPengaturan;
    public function __construct()
    {
       
        $this->ModelSlider = new ModelSlider();
        $this->ModelPengaturan = new ModelPengaturan();
        $this->ModelEbook = new ModelEbook();
        $this->ModelBuku = new ModelBuku();
        helper('form');
    }
    public function index(): string
    {
        $data = [
            'judul' => 'Home',
            'page' => 'v_home',
            'slider' => $this->ModelSlider->findAll(),
            'buku' => $this->ModelBuku->BukuBaru(),
            'ebook' => $this->ModelEbook->EbookBaru(),
        ];
        return view('v_template',$data);
    }

    public function visimisi(): string
    {
        $data = [
            'judul' => 'Visi Misi',
            'page' => 'profil/v_visimisi',
            'web'   => $this->ModelPengaturan->find(1),
        ];
        return view('v_template',$data);
    }

    public function sejarah(): string
    {
        $data = [
            'judul' => 'Sejarah',
            'page' => 'profil/v_sejarah',
            'web'   => $this->ModelPengaturan->find(1),
        ];
        return view('v_template', $data);
    }

    public function galerybuku(): string
    {
        $data = [
            'judul' => 'Galery Buku',
            'page' => 'v_galerybuku',
            'buku'   => $this->ModelBuku->getBukuWithRelasi(),
        ];
        return view('v_template', $data);
    }

    public function galeryebook(): string
    {
        $data = [
            'judul' => 'Galery E-Book',
            'page' => 'v_galeryebook',
            'ebook'   => $this->ModelEbook->getEbookWithRelasi(),
        ];
        return view('v_template', $data);
    }

    public function detailbuku($id_buku): string
    {
        $data = [
            'judul' => 'Detail Buku',
            'page' => 'v_detai_buku',
            'buku'   => $this->ModelBuku->getDetailBuku($id_buku),
        ];
        return view('v_template', $data);
    }

    public function detailebook($id_ebook): string
    {
        $data = [
            'judul' => 'Detail E-Book',
            'page' => 'v_detai_ebook',
            'ebook'   => $this->ModelEbook->getDetailEbook($id_ebook),
        ];
        return view('v_template', $data);
    }
}
