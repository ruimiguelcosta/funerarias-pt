<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate([
            'email' => 'rui.costa@inovador.net',
        ], [
            'name' => 'Rui Costa',
            'email' => 'rui.costa@inovador.net',
            'password' => Hash::make('RuiCosta2024!@#SuperSecure'),
        ]);

        User::query()->updateOrCreate([
            'email' => 'cristianofrwork@gmail.com',
        ], [
            'name' => 'Cristiano',
            'email' => 'cristianofrwork@gmail.com',
            'password' => Hash::make('Cristiano2024!@#UltraSecure'),
        ]);
    }
}
