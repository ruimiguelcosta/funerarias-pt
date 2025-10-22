<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->create([
            'name' => 'Rui Costa',
            'email' => 'rui.costa@inovador.net',
            'password' => Hash::make('RuiCosta2024!@#SuperSecure'),
        ]);

        User::query()->create([
            'name' => 'Cristiano',
            'email' => 'cristianofrwork@gmail.com',
            'password' => Hash::make('Cristiano2024!@#UltraSecure'),
        ]);
    }
}
