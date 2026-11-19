<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Trixia Maligad',
            'email' => 'maligad@kaonta.test',
            'password' => Hash::make('kaonta2026'),
        ]);

        User::create([
            'name' => 'Tita Maligad',
            'email' => 'tita.maligad@kaonta.test',
            'password' => Hash::make('kaonta2026'),
        ]);

        User::factory()->count(10)->create();
    }
}
