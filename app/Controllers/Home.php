<?php

namespace App\Controllers;
use App\Models\ModelSlider;
use App\Controllers\BaseController;

class Home extends BaseController
{
     protected $ModelSlider;
    public function __construct()
    {
       
        $this->ModelSlider = new ModelSlider();
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
}
