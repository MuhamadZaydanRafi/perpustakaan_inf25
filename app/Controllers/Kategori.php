<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelKategori;

class Kategori extends BaseController
{
    protected $ModelKategori;
    

    public function __construct()
    {
         helper('form');
        $this->ModelKategori = new ModelKategori();
    }
    public function index()
    {
        $data = [
            'menu' => 'masterdata',
            'submenu' => 'kategori',
            'judul' => 'Kategori',
            'page'  => 'kategori/v_index',
            'kategori' => $this->ModelKategori->findAll()
        ];
        return view('v_template_Admin',$data);
    }

    public function input()
    {
        $data = [
            'menu' => 'masterdata',
            'submenu' => 'kategori',
            'judul' => 'Input Kategori',
            'page'  => 'kategori/v_input',
            'kategori' => $this->ModelKategori->findAll()
        ];
        return view('v_template_Admin',$data);
    }

    public function InsertData()
    {
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        ];

        if (!$this->ModelKategori->insert($data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelKategori->errors());
        }

        session()->setFlashdata('success', 'Data kategori berhasil disimpan.');
        return redirect()->to('/admin/kategori');
    }

    public function edit($id_kategori) {
        $data = [
            'judul' => 'Edit Kategori',
            'menu' => 'masterdata',
            'submenu' => 'kategori',
            'page' => 'kategori/v_edit',
            'kategori' => $this->ModelKategori->find($id_kategori),
        ];

        return view('v_template_admin', $data);
    }

    public function UpdateData($id_kategori)
    {
        $data = [
            'id_kelas' => $id_kategori,
            'nama_kategori'  => $this->request->getPost('nama_kategori'),
        ];

        if (!$this->ModelKategori->update($id_kategori, $data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelKategori->errors());
        }

        session()->setFlashdata('success', 'Data kategori berhasil Edit.');
        return redirect()->to('/admin/kategori');
    }

     public function DeleteData($id_kategori)
    {
        $data = [
            'id_kategori' => $id_kategori,
        ];

        if (!$this->ModelKategori->delete($data )) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelKategori->errors());
        }

        session()->setFlashdata('success', 'Data kelas berhasil disimpan.');
        return redirect()->to('/admin/kategori');
    }

    



}
