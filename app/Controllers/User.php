<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelUser;

class User extends BaseController
{
    protected $ModelUser;

    public function __construct() {
        $this->ModelUser = new ModelUser();
        helper(['form', 'url']);
    }
    public function index()
    {
        $data = [
            'judul' => 'User',
            'menu' => 'user',
            'page' => 'user/v_index',
            'users' => $this->ModelUser->findAll(),
        ];
        return view('v_template_admin', $data);
    }

    public function input () {
        $data = [
            'judul' => 'Input User',
            'menu' => 'user',
            'page' => 'user/v_input',
            'admins' => $this->ModelUser->findAll(),
        ];
        return view('v_template_admin' ,$data);
    }

    public function InsertData()
    {
        $validation = \Config\Services::validation();

        // AMBIL FILE FOTO
        $file = $this->request->getFile('foto');

        // Periksa apakah file di-upload
        if (! $file || $file->getError() == UPLOAD_ERR_NO_FILE) {
            return redirect()->back()->withInput()->with('errors', ['foto' => 'Foto wajib diupload.']);
        }

        // Periksa error upload lain
        if ($file->getError() !== UPLOAD_ERR_OK) {
            return redirect()->back()->withInput()->with('errors', ['foto' => 'Upload gagal (kode: ' . $file->getError() . ').']);
        }

        // Validasi tipe/ukuran
        $rulesFile = [
            'foto' => [
                'rules' => 'is_image[foto]|max_size[foto,2048]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'File harus berupa gambar.',
                    'max_size' => 'Ukuran maksimal 2MB.',
                    'mime_in'  => 'Format foto harus JPG/PNG.'
                ]
            ]
        ];

        if (! $this->validate($rulesFile)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $newName = $file->getRandomName();

        // DATA ke model
        $data = [
            'nama_user'    => $this->request->getPost('nama_user'),
            'email'         => $this->request->getPost('email'),
            'password'      => $this->request->getPost('password'),
            'role'        => $this->request->getPost('role'),
            'foto'          => $newName
        ];

        // SIMPAN KE DATABASE (TANPA MOVE FOTO)
        if (!$this->ModelUser->insert($data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelUser->errors());
        }

        // --- JIKA DATABASE SUKSES, BARU PINDAHKAN FOTO ---
        $file->move('uploads/user/', $newName);

        session()->setFlashdata('success', 'Data admin berhasil disimpan.');
        return redirect()->to('/admin/user');
    }

     public function edit ($id_admin) {
        $data = [
            'judul' => 'Edit Admin',
            'menu' => 'user',
            'page' => 'user/v_edit',
            'users' => $this->ModelUser->find($id_admin),
        ];
        return view('v_template_admin' ,$data);
    }

    public function UpdateData($id_user)
    {
        $validation = \Config\Services::validation();

        // Ambil data lama
        $user = $this->ModelUser->find($id_user);
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data user tidak ditemukan');
        }

        // Ambil file foto
        $file = $this->request->getFile('foto');

        /*
        * Validasi foto hanya jika user memilih file baru
        */
        $rulesFile = [];
        if ($file->getError() != 4) { 
            $rulesFile = [
                'foto' => [
                    'rules' => 'is_image[foto]|max_size[foto,2048]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'is_image' => 'File harus berupa gambar.',
                        'max_size' => 'Ukuran maksimal 2MB.',
                        'mime_in'  => 'Format foto harus JPG/PNG.'
                    ]
                ]
            ];
        }

        if (!empty($rulesFile)) {
            if (!$this->validate($rulesFile)) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
        }


        // Data utama
        $data = [
            'nama_admin'    => $this->request->getPost('nama_admin'),
            'email'         => $this->request->getPost('email'),
            'role'        => $this->request->getPost('role'),
        ];

        // PASSWORD opsional
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        /*
        * FOTO opsional
        * Jika tidak upload foto baru → tetap gunakan foto lama
        */
        $fotoBaru = null;

        if ($file->getError() != 4) { 
            // Upload foto baru
            $fotoBaru = $file->getRandomName();
            $data['foto'] = $fotoBaru; // update foto di DB
        } else {
            // Tidak pilih foto baru → tetap pakai foto lama
            $data['foto'] = $user['foto'];
        }

        // Update database
        if (!$this->ModelUser->update($id_user, $data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelUser->errors());
        }

        // Jika ada foto baru → hapus lama → upload baru
        if ($fotoBaru) {

            // Hapus foto lama
            if (!empty($admin['foto']) && file_exists('uploads/admin/' . $user['foto'])) {
                unlink('uploads/user/' . $user['foto']);
            }

            // Upload foto baru
            $file->move('uploads/user/', $fotoBaru);
        }

        session()->setFlashdata('success', 'Data admin berhasil diupdate.');
        return redirect()->to('/admin/user');
    }

    public function DeleteData($id_user)
    {
        // Ambil data user
        $user = $this->ModelUser->find($id_user);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data user tidak ditemukan');
        }

        // Hapus foto jika ada
        if (!empty($admin['foto'])) {
            $pathFoto = 'uploads/admin/' . $user['foto'];

            if (file_exists($pathFoto)) {
                unlink($pathFoto); // hapus file foto
            }
        }

        // Hapus data admin dari database
        $this->ModelUser->delete($id_user);

        session()->setFlashdata('success', 'Data admin berhasil dihapus.');
        return redirect()->to('/admin/user');
    }

    public function DetailData($id_user) {
        $data = [
            'judul' => 'Detail User',
            'menu' => 'user',
            'page' => 'user/v_detail',
            'users' => $this->ModelUser->find($id_user),
        ];
        return view('v_template_admin' ,$data);
    }

}
