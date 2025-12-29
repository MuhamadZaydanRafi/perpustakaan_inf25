<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuth extends Model
{
    protected $DBGroup = 'default';

    public function LoginUser($email, $password)
    {
        // Ambil user berdasarkan email
        $db = \Config\Database::connect();
        $user = $db->table('tbl_user')
            ->where('email', $email)
            ->get()
            ->getRowArray();

        if (!$user || !isset($user['password'])) {
            return false;
        }

        // Coba verifikasi password hashed terlebih dahulu
        if (password_verify($password, $user['password'])) {
            return $user;
        }

        // Fallback: jika password masih plain text (legacy data)
        if ($password === $user['password']) {
            return $user;
        }

        return false;
    }

    public function LoginAnggota($nim, $password)
    {
        // Ambil anggota berdasarkan nim
        $db = \Config\Database::connect();
        $anggota = $db->table('tbl_anggota')
            ->where('nim', $nim)
            ->get()
            ->getRowArray();

        if (!$anggota || !isset($anggota['password'])) {
            return false;
        }

        // Coba verifikasi password hashed terlebih dahulu
        if (password_verify($password, $anggota['password'])) {
            return $anggota;
        }

        // Fallback: jika password masih plain text (legacy data)
        if ($password === $anggota['password']) {
            return $anggota;
        }

        return false;
    }
}
