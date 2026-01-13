<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelEbook;
use App\Models\ModelKategori;
use App\Models\ModelPenerbit;
use App\Models\ModelPenulis;

class Ebook extends BaseController
{
    protected $ModelEbook;
    protected $ModelKategori;
    protected $ModelPenerbit;
    protected $ModelPenulis;

    public function __construct()
    {
        helper('form');
        $this->ModelEbook = new ModelEbook();
        $this->ModelKategori = new ModelKategori();
        $this->ModelPenerbit = new ModelPenerbit();
        $this->ModelPenulis = new ModelPenulis();
    }

    public function index()
    {
        $data = [
            'menu' => 'masterdata',
            'submenu' => 'ebook',
            'judul' => 'E-Book',
            'page'  => 'ebook/v_index',
            'ebook' => $this->ModelEbook->getEbookWithRelasi()
        ];
        return view('v_template_Admin', $data);
    }

    public function input()
    {
        $data = [
            'menu' => 'masterdata',
            'submenu' => 'ebook',
            'judul' => 'Input E-Book',
            'page'  => 'ebook/v_input',
            'kategori' => $this->ModelKategori->findAll(),
            'penerbit' => $this->ModelPenerbit->findAll(),
            'penulis' => $this->ModelPenulis->findAll(),
        ];
        return view('v_template_Admin', $data);
    }

    public function InsertData()
    {
        // VALIDASI FILE UPLOAD
        $rulesFile = [
            'file_ebook' => [
                'rules' => 'uploaded[file_ebook]|max_size[file_ebook,10240]|mime_in[file_ebook,application/pdf]',
                'errors' => [
                    'uploaded' => 'File e-book wajib diupload.',
                    'max_size' => 'Ukuran maksimal 10MB.',
                    'mime_in'  => 'Format file harus PDF.'
                ]
            ],
            'cover' => [
                'rules' => 'uploaded[cover]|is_image[cover]|max_size[cover,2048]|mime_in[cover,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Cover wajib diupload.',
                    'is_image' => 'File harus berupa gambar.',
                    'max_size' => 'Ukuran maksimal 2MB.',
                    'mime_in'  => 'Format cover harus JPG/PNG.'
                ]
            ]
        ];

        if (!$this->validate($rulesFile)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // AMBIL FILE EBOOK DAN COVER (TAPI BELUM DI MOVE)
        $fileEbook = $this->request->getFile('file_ebook');
        $fileCover = $this->request->getFile('cover');
        $newNameEbook = $fileEbook->getRandomName();
        $newNameCover = $fileCover->getRandomName();
        
        $data = [
            'judul_ebook' => $this->request->getPost('judul_ebook'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'id_penerbit' => $this->request->getPost('id_penerbit'),
            'id_penulis' => $this->request->getPost('id_penulis'),
            'tahun' => $this->request->getPost('tahun'),
            'isbn' => $this->request->getPost('isbn'),
            'bahasa' => $this->request->getPost('bahasa'),
            'sinopsis' => $this->request->getPost('sinopsis'),
            'file_ebook' => $newNameEbook,
            'cover' => $newNameCover
        ];

        // SIMPAN KE DATABASE (TANPA MOVE FILE)
        $insertId = $this->ModelEbook->insert($data);
        if (!$insertId) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelEbook->errors());
        }

        // --- JIKA DATABASE SUKSES, BARU PINDAHKAN FILE ---
        $targetPathEbook = ROOTPATH . 'public/uploads/ebook';
        $targetPathCover = ROOTPATH . 'public/uploads/cover';
        
        if (!is_dir($targetPathEbook)) {
            mkdir($targetPathEbook, 0755, true);
        }
        if (!is_dir($targetPathCover)) {
            mkdir($targetPathCover, 0755, true);
        }

        try {
            $fileEbook->move($targetPathEbook, $newNameEbook);
            $fileCover->move($targetPathCover, $newNameCover);
        } catch (\Exception $e) {
            // rollback jika gagal memindahkan file
            $this->ModelEbook->delete($insertId);
            return redirect()->back()->withInput()
                ->with('errors', ['file' => 'Gagal menyimpan file: ' . $e->getMessage()]);
        }

        session()->setFlashdata('success', 'Data e-book berhasil disimpan.');
        return redirect()->to('/admin/ebook');
    }

    public function detail($id_ebook)
    {
        $ebook = $this->ModelEbook->getDetailEbook($id_ebook);
        if (!$ebook) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data e-book tidak ditemukan');
        }

        $data = [
            'menu' => 'masterdata',
            'submenu' => 'ebook',
            'judul' => 'Detail E-Book',
            'page' => 'ebook/v_detail',
            'ebook' => $ebook,
        ];

        return view('v_template_Admin', $data);
    }

    public function edit($id_ebook)
    {
        $data = [
            'menu' => 'masterdata',
            'submenu' => 'ebook',
            'judul' => 'Edit E-Book',
            'page' => 'ebook/v_edit',
            'ebook' => $this->ModelEbook->getDetailEbook($id_ebook),
            'kategori' => $this->ModelKategori->findAll(),
            'penerbit' => $this->ModelPenerbit->findAll(),
            'penulis' => $this->ModelPenulis->findAll(),
        ];

        return view('v_template_Admin', $data);
    }

    public function UpdateData($id_ebook)
    {
        // Ambil data lama
        $ebook = $this->ModelEbook->find($id_ebook);
        if (!$ebook) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data e-book tidak ditemukan');
        }

        $data = [
            'id_ebook' => $id_ebook,
            'judul_ebook' => $this->request->getPost('judul_ebook'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'id_penerbit' => $this->request->getPost('id_penerbit'),
            'id_penulis' => $this->request->getPost('id_penulis'),
            'tahun' => $this->request->getPost('tahun'),
            'isbn' => $this->request->getPost('isbn'),
            'bahasa' => $this->request->getPost('bahasa'),
            'sinopsis' => $this->request->getPost('sinopsis'),
        ];

        // Ambil file ebook dan cover
        $file = $this->request->getFile('file_ebook');
        $fileCover = $this->request->getFile('cover');

        /*
        |--------------------------------------------------------------
        | VALIDASI FILE HANYA JIKA ADA FILE BARU
        |--------------------------------------------------------------
        */
        $rulesFile = [];
        if ($file && $file->getError() != 4) {
            $rulesFile['file_ebook'] = [
                'rules' => 'max_size[file_ebook,10240]|mime_in[file_ebook,application/pdf]',
                'errors' => [
                    'max_size' => 'Ukuran maksimal 10MB.',
                    'mime_in'  => 'Format harus PDF.'
                ]
            ];
        }

        if ($fileCover && $fileCover->getError() != 4) {
            $rulesFile['cover'] = [
                'rules' => 'is_image[cover]|max_size[cover,2048]|mime_in[cover,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'File harus berupa gambar.',
                    'max_size' => 'Ukuran maksimal 2MB.',
                    'mime_in'  => 'Format harus JPG/PNG.'
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
        | FILE OPSIONAL
        |--------------------------------------------------------------
        */
        $fileBaru = null;
        $coverBaru = null;

        if ($file && $file->getError() != 4) {
            $fileBaru = $file->getRandomName();
            $data['file_ebook'] = $fileBaru;
        } else {
            $data['file_ebook'] = $ebook['file_ebook'];
        }

        if ($fileCover && $fileCover->getError() != 4) {
            $coverBaru = $fileCover->getRandomName();
            $data['cover'] = $coverBaru;
        } else {
            $data['cover'] = $ebook['cover'];
        }

        /*
        |--------------------------------------------------------------
        | UPDATE DATABASE
        |--------------------------------------------------------------
        */
        if (!$this->ModelEbook->update($id_ebook, $data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelEbook->errors());
        }

        // Upload dan hapus file lama jika ada file baru
        if ($fileBaru || $coverBaru) {
            // Pastikan folder exist
            $targetPathEbook = ROOTPATH . 'public/uploads/ebook';
            $targetPathCover = ROOTPATH . 'public/uploads/cover';
            
            if (!is_dir($targetPathEbook)) {
                mkdir($targetPathEbook, 0755, true);
            }
            if (!is_dir($targetPathCover)) {
                mkdir($targetPathCover, 0755, true);
            }

            try {
                // Upload file ebook baru
                if ($fileBaru) {
                    $file->move($targetPathEbook, $fileBaru);
                    // hapus file lama jika ada
                    if (!empty($ebook['file_ebook']) && is_file($targetPathEbook . '/' . $ebook['file_ebook'])) {
                        @unlink($targetPathEbook . '/' . $ebook['file_ebook']);
                    }
                }
                
                // Upload cover baru
                if ($coverBaru) {
                    $fileCover->move($targetPathCover, $coverBaru);
                    // hapus cover lama jika ada
                    if (!empty($ebook['cover']) && is_file($targetPathCover . '/' . $ebook['cover'])) {
                        @unlink($targetPathCover . '/' . $ebook['cover']);
                    }
                }
            } catch (\Exception $e) {
                // rollback nama file di DB
                $this->ModelEbook->update($id_ebook, [
                    'file_ebook' => $ebook['file_ebook'],
                    'cover' => $ebook['cover']
                ]);
                return redirect()->back()->withInput()
                    ->with('errors', ['file' => 'Gagal memindahkan file: ' . $e->getMessage()]);
            }
        }

        session()->setFlashdata('success', 'Data e-book berhasil diubah.');
        return redirect()->to('/admin/ebook');
    }

    public function DeleteData($id_ebook)
    {
        // Ambil data untuk menghapus file
        $ebook = $this->ModelEbook->find($id_ebook);
        
        if (!$this->ModelEbook->delete($id_ebook)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelEbook->errors());
        }

        // Hapus file ebook jika ada
        if ($ebook && !empty($ebook['file_ebook'])) {
            $filePath = ROOTPATH . 'public/uploads/ebook/' . $ebook['file_ebook'];
            if (is_file($filePath)) {
                @unlink($filePath);
            }
        }

        // Hapus cover jika ada
        if ($ebook && !empty($ebook['cover'])) {
            $coverPath = ROOTPATH . 'public/uploads/cover/' . $ebook['cover'];
            if (is_file($coverPath)) {
                @unlink($coverPath);
            }
        }

        session()->setFlashdata('success', 'Data e-book berhasil dihapus.');
        return redirect()->to('/admin/ebook');
    }

    public function download($id_ebook)
    {
        $ebook = $this->ModelEbook->find($id_ebook);
        if (!$ebook) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data e-book tidak ditemukan');
        }

        $filePath = ROOTPATH . 'public/uploads/ebook/' . $ebook['file_ebook'];
        if (!is_file($filePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File tidak ditemukan');
        }

        return $this->response->download($filePath, null);
    }
}
