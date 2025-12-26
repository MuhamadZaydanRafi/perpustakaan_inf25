<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelPenulis;

class Penulis extends BaseController
{
    protected $ModelPenulis;
    

    public function __construct()
    {
         helper('form');
        $this->ModelPenulis = new ModelPenulis();
    }
    public function index()
    {
        $data = [
            'menu' => 'masterdata',
            'submenu' => 'penulis',
            'judul' => 'Penulis',
            'page'  => 'penulis/v_index',
            'penulis' => $this->ModelPenulis->findAll()
        ];
        return view('v_template_Admin',$data);
    }

    public function input()
    {
        $data = [
            'menu' => 'masterdata',
            'submenu' => 'penulis',
            'judul' => 'Input Penulis',
            'page'  => 'penulis/v_input',
            'penulis' => $this->ModelPenulis->findAll()
        ];
        return view('v_template_Admin',$data);
    }

    public function InsertData()
    {
        $data = [
            'nama_penulis' => $this->request->getPost('nama_penulis'),
        ];

        if (!$this->ModelPenulis->insert($data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelPenulis->errors());
        }

        session()->setFlashdata('success', 'Data penulis berhasil disimpan.');
        return redirect()->to('/admin/penulis');
    }

    public function edit($id_penulis) {
        $data = [
            'judul' => 'Edit Penulis',
            'menu' => 'masterdata',
            'submenu' => 'penulis',
            'page' => 'penulis/v_edit',
            'penulis' => $this->ModelPenulis->find($id_penulis),
        ];

        return view('v_template_admin', $data);
    }

    public function UpdateData($id_penulis)
    {
        $data = [
            'id_penulis' => $id_penulis,
            'nama_penulis'  => $this->request->getPost('nama_penulis'),
        ];

        if (!$this->ModelPenulis->update($id_penulis, $data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelPenulis->errors());
        }

        session()->setFlashdata('success', 'Data penulis berhasil Edit.');
        return redirect()->to('/admin/penulis');
    }

     public function DeleteData($id_penulis)
    {
        $data = [
            'id_penulis' => $id_penulis,
        ];

        if (!$this->ModelPenulis->delete($data )) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelPenulis->errors());
        }

        session()->setFlashdata('success', 'Data penulis berhasil dihapus.');
        return redirect()->to('/admin/penulis');
    }

    



}
