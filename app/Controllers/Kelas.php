<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelKelas;

class Kelas extends BaseController
{
    protected $ModelKelas;
    

    public function __construct()
    {
         helper('form');
        $this->ModelKelas = new ModelKelas();
    }
    public function index()
    {
        $data = [
            'menu' => 'masteranggota',
            'submenu' => 'kelas',
            'judul' => 'Kelas',
            'page'  => 'kelas/v_index',
            'kelas' => $this->ModelKelas->findAll()
        ];
        return view('v_template_Admin',$data);
    }

    public function input()
    {
        $data = [
            'menu' => 'masteranggota',
            'submenu' => 'kelas',
            'judul' => 'Input Kelas',
            'page'  => 'kelas/v_input',
            'kelas' => $this->ModelKelas->findAll()
        ];
        return view('v_template_Admin',$data);
    }

    public function InsertData()
    {
        $data = [
            'nama_kelas' => $this->request->getPost('nama_kelas'),
        ];

        if (!$this->ModelKelas->insert($data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelKelas->errors());
        }

        session()->setFlashdata('success', 'Data kelas berhasil disimpan.');
        return redirect()->to('/admin/kelas');
    }

    public function edit($id_kelas) {
        $data = [
            'judul' => 'Edit Kelas',
            'menu' => 'masteranggota',
            'submenu' => 'kelas',
            'page' => 'kelas/v_edit',
            'kelas' => $this->ModelKelas->find($id_kelas),
        ];

        return view('v_template_admin', $data);
    }

    public function UpdateData($id_kelas)
    {
        $data = [
            'id_kelas' => $id_kelas,
            'nama_kelas'  => $this->request->getPost('nama_kelas'),
        ];

        if (!$this->ModelKelas->update($id_kelas, $data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelKelas->errors());
        }

        session()->setFlashdata('success', 'Data kelas berhasil Edit.');
        return redirect()->to('/admin/kelas');
    }

     public function DeleteData($id_kelas)
    {
        $data = [
            'id_kelas' => $id_kelas,
        ];
        if (!$this->ModelKelas->delete($data )) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelKelas->errors());
        }

        session()->setFlashdata('success', 'Data kelas berhasil dihapus.');
        return redirect()->to('/admin/kelas');
    }

}
