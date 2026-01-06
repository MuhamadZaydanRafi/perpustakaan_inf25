<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelBuku;
use App\Models\ModelKategori;
use App\Models\ModelRak;
use App\Models\ModelPenerbit;
use App\Models\ModelPenulis;

class Buku extends BaseController
{
    protected $ModelBuku;
    protected $ModelKategori;
    protected $ModelRak;
    protected $ModelPenerbit;
    protected $ModelPenulis;

    public function __construct()
    {
        helper('form');
        $this->ModelBuku = new ModelBuku();
        $this->ModelKategori = new ModelKategori();
        $this->ModelRak = new ModelRak();
        $this->ModelPenerbit = new ModelPenerbit();
        $this->ModelPenulis = new ModelPenulis();
    }

    public function index()
    {
        $data = [
            'menu' => 'masterdata',
            'submenu' => 'buku',
            'judul' => 'Buku',
            'page'  => 'buku/v_index',
            'buku' => $this->ModelBuku->getBukuWithRelasi()
        ];
        return view('v_template_Admin', $data);
    }

    public function input()
    {
        $data = [
            'menu' => 'masterdata',
            'submenu' => 'buku',
            'judul' => 'Input Buku',
            'page'  => 'buku/v_input',
            'kategori' => $this->ModelKategori->findAll(),
            'rak' => $this->ModelRak->findAll(),
            'penerbit' => $this->ModelPenerbit->findAll(),
            'penulis' => $this->ModelPenulis->findAll(),
        ];
        return view('v_template_Admin', $data);
    }

    public function InsertData()
    {
        // VALIDASI FILE UPLOAD
        $rulesFile = [
            'cover' => [
                'rules' => 'uploaded[cover]|is_image[cover]|max_size[cover,2048]|mime_in[cover,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Foto wajib diupload.',
                    'is_image' => 'File harus berupa gambar.',
                    'max_size' => 'Ukuran maksimal 2MB.',
                    'mime_in'  => 'Format foto harus JPG/PNG.'
                ]
            ]
        ];

        if (!$this->validate($rulesFile)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // AMBIL FILE FOTO (TAPI BELUM DI MOVE)
        $file = $this->request->getFile('cover');
        $newName = $file->getRandomName();
        $data = [
            'kode_buku' => $this->request->getPost('kode_buku'),
            'judul_buku' => $this->request->getPost('judul_buku'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'id_rak' => $this->request->getPost('id_rak'),
            'id_penerbit' => $this->request->getPost('id_penerbit'),
            'id_penulis' => $this->request->getPost('id_penulis'),
            'tahun' => $this->request->getPost('tahun'),
            'isbn' => $this->request->getPost('isbn'),
            'halaman' => $this->request->getPost('halaman'),
            'jumlah' => $this->request->getPost('jumlah'),
            'bahasa' => $this->request->getPost('bahasa'),
            'cover'         => $newName
        ];

        // SIMPAN KE DATABASE (TANPA MOVE FOTO)
        $insertId = $this->ModelBuku->insert($data);
        if (!$insertId) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelBuku->errors());
        }

        // --- JIKA DATABASE SUKSES, BARU PINDAHKAN FOTO ---
        $targetPath = ROOTPATH . 'public/uploads/cover';
        if (!is_dir($targetPath)) {
            mkdir($targetPath, 0755, true);
        }

        try {
            $file->move($targetPath, $newName);
        } catch (\Exception $e) {
            // rollback jika gagal memindahkan file
            $this->ModelBuku->delete($insertId);
            return redirect()->back()->withInput()
                ->with('errors', ['cover' => 'Gagal menyimpan file cover: ' . $e->getMessage()]);
        }

        session()->setFlashdata('success', 'Data buku berhasil disimpan.');
        return redirect()->to('/admin/buku');
    }


    public function edit($id_buku)
    {
        $data = [
            'menu' => 'masterdata',
            'submenu' => 'buku',
            'judul' => 'Edit Buku',
            'page' => 'buku/v_edit',
            'buku' => $this->ModelBuku->getDetailBuku($id_buku),
            'kategori' => $this->ModelKategori->findAll(),
            'rak' => $this->ModelRak->findAll(),
            'penerbit' => $this->ModelPenerbit->findAll(),
            'penulis' => $this->ModelPenulis->findAll(),
        ];

        return view('v_template_Admin', $data);
    }

    public function UpdateData($id_buku)
    {
        $validation = \Config\Services::validation();

        // Ambil data lama
        $buku = $this->ModelBuku->find($id_buku);
        if (!$buku) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data buku tidak ditemukan');
        }
        $data = [
            'id_buku' => $id_buku,
            'kode_buku' => $this->request->getPost('kode_buku'),
            'judul_buku' => $this->request->getPost('judul_buku'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'id_rak' => $this->request->getPost('id_rak'),
            'id_penerbit' => $this->request->getPost('id_penerbit'),
            'id_penulis' => $this->request->getPost('id_penulis'),
            'tahun' => $this->request->getPost('tahun'),
            'isbn' => $this->request->getPost('isbn'),
            'halaman' => $this->request->getPost('halaman'),
            'jumlah' => $this->request->getPost('jumlah'),
            'bahasa' => $this->request->getPost('bahasa'),
        ];

        // Ambil file cover
        $file = $this->request->getFile('cover');

        /*
        |--------------------------------------------------------------
        | VALIDASI FOTO HANYA JIKA ADA FILE BARU
        |--------------------------------------------------------------
        */
        $rulesFile = [];
        if ($file && $file->getError() != 4) {
            $rulesFile = [
                'cover' => [
                    'rules' => 'is_image[cover]|max_size[cover,2048]|mime_in[cover,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'is_image' => 'File harus berupa gambar.',
                        'max_size' => 'Ukuran maksimal 2MB.',
                        'mime_in'  => 'Format harus JPG/PNG.'
                    ]
                ]
            ];
        }

        if (!empty($rulesFile)) {
            if (!$this->validate($rulesFile)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        }

        /*
        |--------------------------------------------------------------
        | FOTO OPSIONAL
        |--------------------------------------------------------------
        */
        $fotoBaru = null;

        if ($file && $file->getError() != 4) {
            $fotoBaru = $file->getRandomName();
            $data['cover'] = $fotoBaru;
        } else {
            $data['cover'] = $buku['cover'];
        }


          /* |--------------------------------------------------------------
        | UPDATE DATABASE
        |--------------------------------------------------------------
        */
        if (!$this->ModelBuku->update($id_buku, $data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelBuku->errors());
        }

        // Upload dan hapus foto lama jika ada file baru
        if ($fotoBaru) {
            // Pastikan folder exist
            $targetPath = ROOTPATH . 'public/uploads/cover';
            if (!is_dir($targetPath)) {
                mkdir($targetPath, 0755, true);
            }

            // Upload foto baru dan hapus foto lama
            try {
                // pindah file
                $file->move($targetPath, $fotoBaru);
                // hapus foto lama jika ada
                if (!empty($buku['cover']) && is_file($targetPath . '/' . $buku['cover'])) {
                    @unlink($targetPath . '/' . $buku['cover']);
                }
            } catch (\Exception $e) {
                // rollback nama cover di DB
                $this->ModelBuku->update($id_buku, ['cover' => $buku['cover']]);
                return redirect()->back()->withInput()
                    ->with('errors', ['cover' => 'Gagal memindahkan file cover: ' . $e->getMessage()]);
            }

            session()->setFlashdata('success', 'Data buku berhasil diubah.');
            return redirect()->to('/admin/buku');
        }

        session()->setFlashdata('success', 'Data buku berhasil diubah.');
        return redirect()->to('/admin/buku');
    }
    

    public function DeleteData($id_buku)
    {
        if (!$this->ModelBuku->delete($id_buku)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelBuku->errors());
        }

        session()->setFlashdata('success', 'Data buku berhasil dihapus.');
        return redirect()->to('/admin/buku');
    }
}
