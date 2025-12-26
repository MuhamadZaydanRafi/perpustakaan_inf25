<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuth extends Model
{
    public function LoginUser($email, $password)
    {
        // Ambil user berdasarkan email
        $user = $this->db->table('tbl_user')
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
}
