<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Data yang akan diinsert
        $data = [
            [
                'nama_user' => 'Admin',
                'email'     => 'admin@gmail.com',
                'password'  => password_hash('1234', PASSWORD_DEFAULT),
                'foto'      => '',
                'role'      => 'admin',
            ],
            [
                'nama_user' => 'User 1',
                'email'     => 'user1@gmail.com',
                'password'  => password_hash('1234', PASSWORD_DEFAULT),
                'foto'      => '',
                'role'      => 'user',
            ],
            [
                'nama_user' => 'Isa',
                'email'     => 'sabig1984@gmail.com',
                'password'  => password_hash('1234', PASSWORD_DEFAULT),
                'foto'      => '',
                'role'      => 'admin',
            ],
        ];

        // Menggunakan Query Builder
        $this->db->table('tbl_user')->insertBatch($data);
    }
}
