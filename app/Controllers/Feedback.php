<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelFeedback;

class Feedback extends BaseController
{
    protected $ModelFeedback;

    public function __construct()
    {
        helper('form');
        $this->ModelFeedback = new ModelFeedback();
    }

    public function index()
    {
        $data = [
            'judul' => 'Feedback',
            'menu' => 'feedback',
            'submenu' => 'feedback',
            'page'  => 'feedback/v_index',
            'feedback' => $this->ModelFeedback->findAll()
        ];
        return view('v_template_Admin', $data);
    }

    public function input()
    {
        $data = [
            'judul' => 'Input Feedback',
            'menu' => 'feedback',
            'submenu' => 'feedback',
            'page'  => 'feedback/v_input',
        ];
        return view('v_template_Admin', $data);
    }

    public function InsertData()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'komentar' => $this->request->getPost('komentar'),
            'keluhan' => $this->request->getPost('keluhan'),
            'penilaian' => $this->request->getPost('penilaian'),
            'saran' => $this->request->getPost('saran')
        ];

        if (!$this->ModelFeedback->insert($data)) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan feedback');
        }

        return redirect()->to('admin/feedback')->with('success', 'Feedback berhasil ditambahkan');
    }

    public function delete($id)
    {
        if (!$this->ModelFeedback->delete($id)) {
            return redirect()->back()->with('error', 'Gagal menghapus feedback');
        }

        return redirect()->to('admin/feedback')->with('success', 'Feedback berhasil dihapus');
    }

}
