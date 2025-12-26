<?php

namespace App\Controllers;

use App\Models\ModelUser;
use App\Models\ModelAuth;

class DebugPassword extends BaseController
{
    public function index()
    {
        $modelUser = new ModelUser();
        $modelAuth = new ModelAuth();

        // Ambil semua user
        $users = $modelUser->findAll();
        
        echo "<h1>Debug Password Hash</h1>";
        echo "<pre>";
        echo "Semua User di Database:\n";
        print_r($users);
        echo "</pre>";

        // Test dengan email tertentu
        $email = $this->request->getGet('email') ?? 'admin@example.com';
        $password = $this->request->getGet('password') ?? '123456';

        echo "<h2>Test Login dengan Email: $email, Password: $password</h2>";
        $user = (new \App\Models\ModelUser())->where('email', $email)->first();
        
        if ($user) {
            echo "<pre>";
            echo "User ditemukan:\n";
            print_r($user);
            echo "\n\nPassword input: $password\n";
            echo "Password di DB: " . $user['password'] . "\n";
            echo "Password verify result: " . (password_verify($password, $user['password']) ? 'TRUE' : 'FALSE') . "\n";
            echo "</pre>";
        } else {
            echo "User tidak ditemukan dengan email: $email";
        }
    }

    public function hashTest()
    {
        $password = $this->request->getGet('password') ?? '123456';
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        echo "<h1>Hash Test</h1>";
        echo "<pre>";
        echo "Password: $password\n";
        echo "Hash: $hash\n";
        echo "Verify: " . (password_verify($password, $hash) ? 'TRUE' : 'FALSE') . "\n";
        echo "</pre>";
    }
}
