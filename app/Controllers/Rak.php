<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelRak;

class Rak extends BaseController
{
    protected $ModelRak;
    

    public function __construct()
    {
         helper('form');
        $this->ModelRak = new ModelRak();
    }
    public function index()
    {
        $data = [
            'judul' => 'Rak',
            'menu' => 'masterdata',
            'submenu' => 'rak',
            'page'  => 'rak/v_index',
            'rak' => $this->ModelRak->findAll()
        ];
        return view('v_template_Admin',$data);
    }

    public function input()
    {
        $data = [
            'judul' => 'Input Rak',
            'menu' => 'masterdata',
            'submenu' => 'rak',
            'page'  => 'rak/v_input',
            'rak' => $this->ModelRak->findAll()
        ];
        return view('v_template_Admin',$data);
    }

    public function InsertData()
    {
        $data = [
            'nama_rak' => $this->request->getPost('nama_rak'),
            'lantai_rak' => $this->request->getPost('lantai_rak'),
        ];

        if (!$this->ModelRak->insert($data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelRak->errors());
        }

        session()->setFlashdata('success', 'Data kategori berhasil disimpan.');
        return redirect()->to('/admin/rak');
    }

    public function edit($id_rak) {
        $data = [
            'judul' => 'Edit Rak',
            'menu' => 'masterdata',
            'submenu' => 'rak',
            'page' => 'rak/v_edit',
            'rak' => $this->ModelRak->find($id_rak),
        ];

        return view('v_template_admin', $data);
    }

    public function UpdateData($id_rak)
    {
        $data = [
            'id_rak' => $id_rak,
            'nama_rak'  => $this->request->getPost('nama_rak'),
            'lantai_rak'  => $this->request->getPost('lantai_rak'),
        ];

        if (!$this->ModelRak->update($id_rak, $data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelRak->errors());
        }

        session()->setFlashdata('success', 'Data kategori berhasil Edit.');
        return redirect()->to('/admin/rak');
    }

     public function DeleteData($id_rak)
    {
        $data = [
            'id_rak' => $id_rak,
        ];

        if (!$this->ModelRak->delete($data )) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelRak->errors());
        }

        session()->setFlashdata('success', 'Data kelas berhasil disimpan.');
        return redirect()->to('/admin/rak');
    }

}
