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
                session()->set('nama_user', $cek_login['nama_user']);
                session()->set('email', $cek_login['email']);
                session()->set('level', $cek_login['level']);
                return redirect()->to(base_urla('Admin'));
            }else {
                //jika gagal login karena password atau email salah
                session()->setFlasdata('pesan', 'E-Mail Atau Password Salah !');
                return redirect()->to(base_url('Auth/LoginUser'));
            }
        } else {
            //jika entry tidak valid
            session()->setFlasdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Auth/LoginUser'));
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
}
