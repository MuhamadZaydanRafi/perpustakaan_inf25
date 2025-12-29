<?php

namespace App\Controllers;

use App\Models\ModelAuth;

class Auth extends BaseController
{
    protected $ModelAuth;

    public function __construct()
    {
    helper('form');
    $this->ModelAuth = new ModelAuth();
    }

    public function index()
    {
        $data = [
            'judul' => 'Login',
            'page'  => 'v_login',
        ];
        return view('v_template_login', $data);
    }
    public function LoginUser()
    {
        $data = [
            'judul' => 'Login User',
            'page'  => 'v_login_User',
        ];
        return view('v_template_login', $data);
    }

    public function CekLoginUser()
    {
        if ($this->validate([
            'email' => [
                'label' => 'E-Mail',
                'rules' => 'required|valid_email',
                'errors' =>[
                    'required' => '{field} Masih Kosong !',
                    'valid_email' => '{field} Harus Formait E-Mail !',
                ]
            ],
            'password' => [
                'label' => 'password',
                'rules' => 'required',
                'errors' =>[
                    'required' => '{field} Masih Kosong !',
                ]
            ]
        ])) {
            //jika entry valid
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $cek_login = $this->ModelAuth->LoginUser($email, $password);
            if ($cek_login) {
                //jika login berhasil
                session()->set([
                    'nama_user' => $cek_login['nama_user'],
                    'email'     => $cek_login['email'],
                    'role'      => $cek_login['role'],
                    'logged_in' => true,
                ]);
                return redirect()->to(base_url('admin'));
            } else {
                //jika gagal login karena password atau email salah
                session()->setFlashdata('pesan', 'E-Mail Atau Password Salah !');
                return redirect()->to(base_url('login_user'));
            }
        } else {
            //jika entry tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('login_user'));
        }
    }

    public function LoginAnggota()
    {
        $data = [
            'judul' => 'Login Anggota',
            'page'  => 'v_login_Anggota',
        ];
        return view('v_template_login', $data);
    }
    public function CekLoginAnggota()
    {
        if ($this->validate([
            'nim' => [
                'label' => 'NIM',
                'rules' => 'required',
                'errors' =>[
                    'required' => '{field} Masih Kosong !',
                ]
            ],
            'password' => [
                'label' => 'password',
                'rules' => 'required',
                'errors' =>[
                    'required' => '{field} Masih Kosong !',
                ]
            ]
        ])) {
            //jika entry valid
            $nim = $this->request->getPost('nim');
            $password = $this->request->getPost('password');
            $cek_login = $this->ModelAuth->LoginAnggota($nim, $password);
            if ($cek_login) {
                //jika login berhasil
                session()->set([
                    'nim' => $cek_login['nim'],
                    'nama_user' => $cek_login['nama_anggota'],
                    'password'     => $cek_login['password'],
                    'jenis_kelamin'     => $cek_login['jenis_kelamin'],
                    'id_kelas'     => $cek_login['id_kelas'],
                    'no_hp'     => $cek_login['no_hp'],
                    'alamat'     => $cek_login['alamat'],
                    'foto'     => $cek_login['foto'],
                    'logged_in' => true,
                ]);
                return redirect()->to(base_url('anggota/dashboard'));
            } else {
                //jika gagal login karena password atau email salah
                session()->setFlashdata('pesan', 'E-Mail Atau Password Salah !');
                return redirect()->to(base_url('login_anggota'));
            }
        } else {
            //jika entry tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('login_anggota'));
        }
    }

     public function LogOut()
    {
        session()->destroy();

        // Redirect ke halaman login
        return redirect()->to('/');
    }
}
