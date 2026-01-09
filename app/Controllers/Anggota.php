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
         $data = [
            'menu' => 'dashboard',
            'submenu'=> '',
            'judul' => 'Profil Anggota',
            'page'  => 'dashboard_anggota/v_anggota',
            'anggotawithkelas'   => $this->ModelAnggota->getAnggotaWithKelas(),
            'web' => [
                'nama_web' => 'Digital'
            ]
        ];
        return view('v_template_anggota',$data);
    }

    public function indexAdmin()
    {
         $data = [
            'menu' => 'masteranggota',
            'submenu'=> 'anggota',
            'judul' => 'Profil Anggota',
            'page'  => 'anggota/v_index',
            'anggotawithkelas'   => $this->ModelAnggota->getAnggotaWithKelas(),
            
        ];
        return view('v_template_admin',$data);
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


    public function DaftarAnggota()
    {
        $validation = \Config\Services::validation();

        // Validasi NIM dipindahkan ke controller
        $nimRules = [
            'nim' => 'required|min_length[3]|max_length[20]|is_unique[tbl_anggota.nim]'
        ];
        $nimErrors = [
            'nim' => [
                'required'   => 'NIM wajib diisi.',
                'min_length' => 'NIM minimal 3 karakter.',
                'max_length' => 'NIM maksimal 20 karakter.',
                'is_unique'  => 'NIM sudah terdaftar.'
            ]
        ];

        if (! $this->validate($nimRules, $nimErrors)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nim'          => $this->request->getPost('nim'),
            'nama_anggota' => $this->request->getPost('nama_anggota'),
            'password'     => $this->request->getPost('password'),
            'jenis_kelamin'=> $this->request->getPost('jenis_kelamin'),
            'id_kelas'     => $this->request->getPost('id_kelas'),
            'no_hp'        => $this->request->getPost('no_hp'),
            'alamat'       => $this->request->getPost('alamat'),
        ];

        if (! $this->ModelAnggota->insert($data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelAnggota->errors());
        }

        session()->setFlashdata('success', 'Daftar anggota berhasil disimpan.');
        return redirect()->to('/login_anggota');
    }

    public function input()
    {
        $data = [
            'menu' => 'masteranggota',
            'submenu'=> 'anggota',
            'judul' => 'Tambah Anggota',
            'page'  => 'anggota/v_input',
            'kelas' => $this->ModelKelas->findAll(),
        ];
        return view('v_template_admin', $data);
    }


    public function InsertData()
    {
        $validation = \Config\Services::validation();

        // Validasi NIM pada proses insert (admin)
        $nimRules = [
            'nim' => 'required|min_length[3]|max_length[20]|is_unique[tbl_anggota.nim]'
        ];
        $nimErrors = [
            'nim' => [
                'required'   => 'NIM wajib diisi.',
                'min_length' => 'NIM minimal 3 karakter.',
                'max_length' => 'NIM maksimal 20 karakter.',
                'is_unique'  => 'NIM sudah terdaftar.'
            ]
        ];

        if (! $this->validate($nimRules, $nimErrors)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

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
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // AMBIL FILE FOTO (TAPI BELUM DI MOVE)
        $file = $this->request->getFile('foto');
        $newName = $file->getRandomName();

        // DATA ke model (sesuaikan dengan nama field pada form)
        $data = [
            'nim'          => $this->request->getPost('nim'),
            'nama_anggota' => $this->request->getPost('nama_anggota'),
            'password'      => $this->request->getPost('password'),
            'verifikasi'   => $this->request->getPost('verifikasi') ?? 0,
            'alamat'       => $this->request->getPost('alamat'),
            'no_hp'        => $this->request->getPost('no_hp'),
            'jenis_kelamin'=> $this->request->getPost('jenis_kelamin'),
            'id_kelas'     => $this->request->getPost('id_kelas'),
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
            return redirect()->to('/admin/anggota');
    }

    public function edit ($id_anggota) {
        $data = [
            'judul' => 'Edit Anggota',
            'menu' => 'user',
            'page' => 'dashboard_anggota/v_edit_profil',
            'anggota' => $this->ModelAnggota->find($id_anggota),
            'kelas' => $this->ModelKelas->findAll(),
        ];
        return view('v_template_anggota', $data);
    }

     public function updateData($id_anggota)
    {
        $validation = \Config\Services::validation();

        // Ambil data lama
        $anggota = $this->ModelAnggota->find($id_anggota);
        if (!$anggota) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data anggota tidak ditemukan');
        }

        // Validasi NIM pada update: cek format dulu, lalu pastikan unik jika diubah
        $nimRules = [
            'nim' => 'required|min_length[3]|max_length[20]'
        ];
        $nimErrors = [
            'nim' => [
                'required'   => 'NIM wajib diisi.',
                'min_length' => 'NIM minimal 3 karakter.',
                'max_length' => 'NIM maksimal 20 karakter.',
            ]
        ];
        if (! $this->validate($nimRules, $nimErrors)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $newNim = $this->request->getPost('nim');
        if ($newNim !== $anggota['nim']) {
            // jika nim diubah, pastikan belum ada di DB
            if ($this->ModelAnggota->where('nim', $newNim)->first()) {
                return redirect()->back()->withInput()->with('errors', ['nim' => 'NIM sudah terdaftar.']);
            }
        }

        // Ambil file foto
        $file = $this->request->getFile('foto');

        /*
        |--------------------------------------------------------------
        | VALIDASI FOTO HANYA JIKA ADA FILE BARU
        |--------------------------------------------------------------
        */
        $rulesFile = [];
        if ($file->getError() != 4) {
            $rulesFile = [
                'foto' => [
                    'rules' => 'is_image[foto]|max_size[foto,2048]|mime_in[foto,image/jpg,image/jpeg,image/png]',
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
        | DATA UPDATE
        |--------------------------------------------------------------
        */
        $data = [
            'nama_anggota'    => $this->request->getPost('nama_anggota'),
            'nim'           => $this->request->getPost('nim'),
            'alamat'        => $this->request->getPost('alamat'),
            'no_hp'         => $this->request->getPost('no_hp'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'id_kelas'      => $this->request->getPost('id_kelas'),
        ];

        // Password opsional
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        /*
        |--------------------------------------------------------------
        | FOTO OPSIONAL
        |--------------------------------------------------------------
        */
        $fotoBaru = null;

        if ($file->getError() != 4) {
            $fotoBaru = $file->getRandomName();
            $data['foto'] = $fotoBaru;
        } else {
            $data['foto'] = $anggota['foto'];
        }

        /*
        |--------------------------------------------------------------
        | UPDATE DATABASE
        |--------------------------------------------------------------
        */
        if (!$this->ModelAnggota->update($id_anggota, $data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelAnggota->errors());
        }

        // Upload dan hapus foto lama jika ada file baru
        if ($fotoBaru) {
            // Hapus foto lama
            if (!empty($anggota['foto']) && file_exists('uploads/anggota/' . $anggota['foto'])) {
                unlink('uploads/anggota/' . $anggota['foto']);
            }

            // Upload foto baru
            $file->move('uploads/anggota/', $fotoBaru);
        }

        session()->setFlashdata('success', 'Data anggota berhasil diupdate.');
        return redirect()->to('/anggota/dashboard');
    }

    public function editAnggota ($id_anggota) {
        $data = [
            'menu' => 'masteranggota',
            'submenu'=> 'anggota',
            'judul' => 'Profil Anggota',
            'page'  => 'anggota/v_edit',
            'anggota' => $this->ModelAnggota->find($id_anggota),
            'kelas' => $this->ModelKelas->findAll(),
        ];
        return view('v_template_admin', $data);
    }

    public function detail($id_anggota)
    {
        $anggota = $this->ModelAnggota->getDetailkelas($id_anggota);
        if (! $anggota) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data anggota tidak ditemukan');
        }

        $data = [
            'menu'  => 'masteranggota',
            'submenu' => 'anggota',
            'judul' => 'Detail Anggota',
            'page'  => 'anggota/v_detail',
            'anggota' => $anggota,
        ];

        return view('v_template_admin', $data);
    }

     public function updateDataAnggota($id_anggota)
    {
        $validation = \Config\Services::validation();

        // Ambil data lama
        $anggota = $this->ModelAnggota->find($id_anggota);
        if (!$anggota) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data anggota tidak ditemukan');
        }

        // Validasi NIM pada update: cek format dulu, lalu pastikan unik jika diubah
        $nimRules = [
            'nim' => 'required|min_length[3]|max_length[20]'
        ];
        $nimErrors = [
            'nim' => [
                'required'   => 'NIM wajib diisi.',
                'min_length' => 'NIM minimal 3 karakter.',
                'max_length' => 'NIM maksimal 20 karakter.',
            ]
        ];
        if (! $this->validate($nimRules, $nimErrors)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $newNim = $this->request->getPost('nim');
        if ($newNim !== $anggota['nim']) {
            // jika nim diubah, pastikan belum ada di DB
            if ($this->ModelAnggota->where('nim', $newNim)->first()) {
                return redirect()->back()->withInput()->with('errors', ['nim' => 'NIM sudah terdaftar.']);
            }
        }

        // Ambil file foto
        $file = $this->request->getFile('foto');

        /*
        |--------------------------------------------------------------
        | VALIDASI FOTO HANYA JIKA ADA FILE BARU
        |--------------------------------------------------------------
        */
        $rulesFile = [];
        if ($file->getError() != 4) {
            $rulesFile = [
                'foto' => [
                    'rules' => 'is_image[foto]|max_size[foto,2048]|mime_in[foto,image/jpg,image/jpeg,image/png]',
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
        | DATA UPDATE
        |--------------------------------------------------------------
        */
        $data = [
            'nama_anggota'    => $this->request->getPost('nama_anggota'),
            'nim'              => $this->request->getPost('nim'),
            'verifikasi'       => $this->request->getPost('verifikasi'),
            'alamat'           => $this->request->getPost('alamat'),
            'no_hp'            => $this->request->getPost('no_hp'),
            'jenis_kelamin'    => $this->request->getPost('jenis_kelamin'),
            'id_kelas'         => $this->request->getPost('id_kelas'),
        ];

        // Password opsional
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        /*
        |--------------------------------------------------------------
        | FOTO OPSIONAL
        |--------------------------------------------------------------
        */
        $fotoBaru = null;

        if ($file->getError() != 4) {
            $fotoBaru = $file->getRandomName();
            $data['foto'] = $fotoBaru;
        } else {
            $data['foto'] = $anggota['foto'];
        }

        /*
        |--------------------------------------------------------------
        | UPDATE DATABASE
        |--------------------------------------------------------------
        */
        if (!$this->ModelAnggota->update($id_anggota, $data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelAnggota->errors());
        }

        // Upload dan hapus foto lama jika ada file baru
        if ($fotoBaru) {
            // Hapus foto lama
            if (!empty($anggota['foto']) && file_exists('uploads/anggota/' . $anggota['foto'])) {
                unlink('uploads/anggota/' . $anggota['foto']);
            }

            // Upload foto baru
            $file->move('uploads/anggota/', $fotoBaru);
        }

        session()->setFlashdata('success', 'Data anggota berhasil diupdate.');
        return redirect()->to('/admin/anggota');
    }

   
    public function DeleteData($id_anggota)
    {
        // Ambil data lama
        $anggota = $this->ModelAnggota->find($id_anggota);
        if (!$anggota) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data anggota tidak ditemukan');
        }

        // Hapus data dari database
        $this->ModelAnggota->delete($id_anggota);

        // Hapus foto lama
        if (!empty($anggota['foto']) && file_exists('uploads/anggota/' . $anggota['foto'])) {
            unlink('uploads/anggota/' . $anggota['foto']);
        }

        session()->setFlashdata('success', 'Data anggota berhasil dihapus.');
        return redirect()->to('/admin/anggota');
    }

    public function verify($id_anggota)
    {
        $anggota = $this->ModelAnggota->find($id_anggota);
        if (! $anggota) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data anggota tidak ditemukan');
        }

        // Set verifikasi = 1
        $this->ModelAnggota->update($id_anggota, ['verifikasi' => 1]);

        session()->setFlashdata('success', 'Anggota berhasil diverifikasi.');
        return redirect()->to('/admin/anggota');
    }

    public function profil()
    {
         $data = [
            'menu' => 'dashboard',
            'submenu'=> '',
            'judul' => 'Profil Anggota',
            'page'  => 'dashboard_anggota/v_anggota',
            'anggotawithkelas'   => $this->ModelAnggota->getAnggotaWithKelas(),
            'anggota' => session()
            
        ];
        return view('v_template_anggota',$data);
    }

}
