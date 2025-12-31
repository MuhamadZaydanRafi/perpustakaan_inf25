<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelPengaturan;

class Pengaturan extends BaseController
{
     protected $ModelPengaturan;
    public function __construct()
    {
       
        $this->ModelPengaturan = new ModelPengaturan();
        helper('form');
    }
    public function web()
    {
        $data = [
            'menu' => 'pengaturan',
            'submenu'=> '',
            'judul' => 'Pengaturan Web',
            'page'  => 'v_pengaturan_web',
            'web'   => $this->ModelPengaturan->find(1),
        ];
        return view('v_template_Admin',$data);
    }

    public function UpdateWeb()
    {
        $id_web = 1; // Selalu update id_web = 1
        $validation = \Config\Services::validation();

        // Ambil data lama
        $web = $this->ModelPengaturan->find($id_web);
        if (!$web) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data web tidak ditemukan');
        }   

        // Ambil file foto
        $file = $this->request->getFile('logo');

        /*
        * Validasi foto hanya jika user memilih file baru
        */
        $rulesFile = [];
        if ($file->getError() != 4) { 
            $rulesFile = [
                'logo' => [
                    'rules' => 'is_image[logo]|max_size[logo,2048]|mime_in[logo,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'is_image' => 'File harus berupa gambar.',
                        'max_size' => 'Ukuran maksimal 2MB.',
                        'mime_in'  => 'Format logo harus JPG/PNG.'
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
            'nama_web'    => $this->request->getPost('nama_web'),
            'alamat'         => $this->request->getPost('alamat'),
            'kecamatan'        => $this->request->getPost('kecamatan'),
            'kab_kota'        => $this->request->getPost('kab_kota'),
            'no_telp'        => $this->request->getPost('no_telp'),
        ];

        /*
        * FOTO opsional
        * Jika tidak upload foto baru → tetap gunakan foto lama
        */
        $fotoBaru = null;

        if ($file->getError() != 4) { 
            // Upload foto baru
            $fotoBaru = $file->getRandomName();
            $data['logo'] = $fotoBaru; // update foto di DB
        } else {
            // Tidak pilih foto baru → tetap pakai foto lama
            $data['logo'] = $web['logo'];
        }

        // Update database
        if (!$this->ModelPengaturan->update($id_web, $data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelPengaturan->errors());
        }

        // Jika ada foto baru → hapus lama → upload baru
        if ($fotoBaru) {

            // Hapus foto lama
            if (!empty($web['logo']) && file_exists('uploads/web/' . $web['logo'])) {
                unlink('uploads/web/' . $web['logo']);
            }

            // Upload foto baru
            $file->move('uploads/web/', $fotoBaru);
        }

        session()->setFlashdata('success', 'Pengaturan berhasil diupdate.');
        return redirect()->to('/admin/prngaturan');
    }
}
