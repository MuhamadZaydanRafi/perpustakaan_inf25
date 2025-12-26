<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelPenerbit;

class Penerbit extends BaseController
{
    protected $ModelPenerbit;
    

    public function __construct()
    {
         helper('form');
        $this->ModelPenerbit = new ModelPenerbit();
    }
    public function index()
    {
        $data = [
            'menu' => 'masterdata',
            'submenu' => 'penerbit',
            'judul' => 'Penerbit',
            'page'  => 'penerbit/v_index',
            'penerbit' => $this->ModelPenerbit->findAll()
        ];
        return view('v_template_Admin',$data);
    }

    public function input()
    {
        $data = [
            'menu' => 'masterdata',
            'submenu' => 'penerbit',
            'judul' => 'Input Penerbit',
            'page'  => 'penerbit/v_input',
            'penerbit' => $this->ModelPenerbit->findAll()
        ];
        return view('v_template_Admin',$data);
    }

    public function InsertData()
    {
        $data = [
            'nama_penerbit' => $this->request->getPost('nama_penerbit'),
        ];

        if (!$this->ModelPenerbit->insert($data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelPenerbit->errors());
        }

        session()->setFlashdata('success', 'Data penerbit berhasil disimpan.');
        return redirect()->to('/admin/penerbit');
    }

    public function edit($id_penerbit) {
        $data = [
            'judul' => 'Edit Penerbit',
            'menu' => 'masterdata',
            'submenu' => 'penerbit',
            'page' => 'penerbit/v_edit',
            'penerbit' => $this->ModelPenerbit->find($id_penerbit),
        ];

        return view('v_template_admin', $data);
    }

    public function UpdateData($id_penerbit)
    {
        $data = [
            'id_penerbit' => $id_penerbit,
            'nama_penerbit'  => $this->request->getPost('nama_penerbit'),
        ];

        if (!$this->ModelPenerbit->update($id_penerbit, $data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelPenerbit->errors());
        }

        session()->setFlashdata('success', 'Data penerbit berhasil Edit.');
        return redirect()->to('/admin/penerbit');
    }

     public function DeleteData($id_penerbit)
    {
        $data = [
            'id_penerbit' => $id_penerbit,
        ];

        if (!$this->ModelPenerbit->delete($data )) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelPenerbit->errors());
        }

        session()->setFlashdata('success', 'Data penerbit berhasil disimpan.');
        return redirect()->to('/admin/penerbit');
    }

    



}
