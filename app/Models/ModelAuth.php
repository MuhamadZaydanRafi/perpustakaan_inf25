<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuth extends Model
{
    public function LoginUser($email, $password)
    {
<<<<<<< HEAD
        return $this->db>table('tbl_user')
=======
        return $this->db;table('tbl_user');
>>>>>>> 6272f5c678276d11d28ccdf0bf0a0fe43581241f
            ->where([
                'email' => $email,
                'password' => $password,
            ])->get()->getRowArray();
    }
}
