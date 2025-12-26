<?php

namespace App\Controllers;

class ReHashPassword extends BaseController
{
    public function index()
    {
        $modelUser = new \App\Models\ModelUser();
        
        // Ambil semua user
        $users = $modelUser->findAll();
        
        echo "<h1>Re-Hash All Passwords</h1>";
        echo "<pre>";
        
        $count = 0;
        foreach ($users as $user) {
            // Cek apakah password sudah hash (dimulai dengan $2y$)
            if (strpos($user['password'], '$2y$') === 0) {
                echo "[SKIP] User {$user['id_user']} ({$user['email']}) - Sudah di-hash\n";
                continue;
            }
            
            // Hash password plain text
            $newHash = password_hash($user['password'], PASSWORD_DEFAULT);
            
            // Update langsung ke database (bypass model untuk menghindari double hash)
            db_connect()->table('tbl_user')
                ->where('id_user', $user['id_user'])
                ->update(['password' => $newHash]);
            
            echo "[HASH] User {$user['id_user']} ({$user['email']}) - Password di-hash\n";
            echo "       Old: {$user['password']}\n";
            echo "       New: $newHash\n\n";
            $count++;
        }
        
        echo "\nTotal password yang di-hash: $count\n";
        echo "</pre>";
    }
}
