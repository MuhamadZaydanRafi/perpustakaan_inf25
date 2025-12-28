<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelAnggota;
use App\Models\ModelKelas;

class Anggota extends BaseController

{
    protected $ModelAnggota;
    protected $ModelKelas;
    public function __construct()
    {
        $this->ModelAnggota = new ModelAnggota();
        $this->ModelKelas = new ModelKelas();
        helper('form');
    }

    

    public function index()
    {
        //
    }
    public function Daftar()
    {
        $data = [
            'judul' => 'Daftar Anggota',
            'page'  => 'v_daftar_anggota',
            'kelas' => $this->ModelKelas->findAll(),
        ];
        return view('v_template_login', $data);
    }

    public function input()
    {
        $data = [
            'judul' => 'Daftar Anggota',
            'page'  => 'anggota/v_input',
            'kelas' => $this->ModelKelas->findAll(),
        ];
        return view('v_template_login', $data);
    }

    public function InsertData()
    {
        $validation = \Config\Services::validation();

        // VALIDASI FILE UPLOAD
        $rulesFile = [
            'foto' => [
                'rules' => 'uploaded[foto]|is_image[foto]|max_size[foto,2048]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Foto wajib diupload.',
                    'is_image' => 'File harus berupa gambar.',
                    'max_size' => 'Ukuran maksimal 2MB.',
                    'mime_in'  => 'Format foto harus JPG/PNG.'
                ]
            ]
        ];

        if (!$this->validate($rulesFile)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // AMBIL FILE FOTO (TAPI BELUM DI MOVE)
        $file = $this->request->getFile('foto');
        $newName = $file->getRandomName();

        // DATA ke model (sesuaikan dengan nama field pada form)
        $data = [
            'nim'          => $this->request->getPost('nim'),
            'nama_anggota' => $this->request->getPost('nama_anggota'),
            'alamat'       => $this->request->getPost('alamat'),
            'no_hp'        => $this->request->getPost('no_hp'),
            'jenis_kelamin'=> $this->request->getPost('jenis_kelamin'),
            'id_kelas'     => $this->request->getPost('kelas'),
            'foto'         => $newName
        ];

        // SIMPAN KE DATABASE (TANPA MOVE FOTO)
        if (!$this->ModelAnggota->insert($data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelAnggota->errors());
        }

        // --- JIKA DATABASE SUKSES, BARU PINDAHKAN FOTO ---
        $file->move('uploads/anggota/', $newName);

        session()->setFlashdata('success', 'Data anggota berhasil disimpan.');
        return redirect()->to('/login_anggota');
    }
}
