<?php

namespace App\Controllers;

use App\Models\ModelAuth;
<<<<<<< HEAD

=======
>>>>>>> 6272f5c678276d11d28ccdf0bf0a0fe43581241f
class Auth extends BaseController
{

    public function __construct()
    {
    helper('form');
    $this->ModelAuth = new ModelAuth;
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
<<<<<<< HEAD
            'email' => [
                'label' => 'E-Mail',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} Masih Kosong !',
                    'valid_email' => '{field} Harus Format E-Mail !'
                ]
            ],
            'password' => [
=======
            'email'=> [
                'label' => 'E-Mail',
                'rules' => 'required|valid_email',
                'errors' => [
                  'required' => '{field} Masih Kosong !',
                  'valid_email' => '{field} Harus Format E-Mail !',
                ]
            ],
            'password'=> [
>>>>>>> 6272f5c678276d11d28ccdf0bf0a0fe43581241f
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Masih Kosong !',
<<<<<<< HEAD
                    
                ]
            ]

        ])) {
            //jika entry valid
            $email =  $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $cek_login= $this->ModelAuth->LoginUser($email, $password);
=======
                ]
            ]
        ])) {
            //jika entry valid
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $cek_login = $this->ModelAuth->LoginUser($email, $password);
>>>>>>> 6272f5c678276d11d28ccdf0bf0a0fe43581241f
            if ($cek_login) {
                //jika login berhasil
                session()->set('nama_user', $cek_login['nama_user']);
                session()->set('email', $cek_login['email']);
                session()->set('level', $cek_login['level']);
                return redirect()->to(base_url('Admin'));
<<<<<<< HEAD
            }else{
                //jika gagal login karena password atau email salah
                session()->setFlashdata('pesan','E-Mail Atau Password Salah !');
                return redirect()->to(base_url('Auth/LoginUser'));
            }

        }else {
        //jika entry tidak valid
        session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
        return redirect()->to(base_url('Auth/LoginUser'));
        }

=======
            }else {
                //jika gagal login krna password atau email salah
                session()->setFlashdata('pesan', 'E-Mail Atau Password Salah !');
                return redirect()->to(base_url('Auth/LoginUser'));
            }

        }
        else {
            //jika entry tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Auth/LoginUser'));           
        }
>>>>>>> 6272f5c678276d11d28ccdf0bf0a0fe43581241f
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
