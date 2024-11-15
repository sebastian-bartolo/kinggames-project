<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        Usuario::create([
            'nombre' => 'Admin',
            'apellidos' => 'User',
            'email' => 'admin@example.com',
            'password' => 123456789,
            'rol' => 'admin',
        ]);
    }
}