<?php

namespace App\Controllers;
use App\Models\ModelSlider;
use App\Controllers\BaseController;
use App\Models\ModelPengaturan;

class Home extends BaseController
{
     protected $ModelSlider;
    protected $ModelPengaturan;
    public function __construct()
    {
       
        $this->ModelSlider = new ModelSlider();
        $this->ModelPengaturan = new ModelPengaturan();
        helper('form');
    }
    public function index(): string
    {
        $data = [
            'judul' => 'Home',
            'page' => 'v_home',
            'slider' => $this->ModelSlider->findAll(),
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
}
