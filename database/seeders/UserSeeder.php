<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =  User::create([
            'id' => 'a693c3da-1ebc-48c6-8eee-35d7cfc072af',
            'name' => 'Muhammad Rizki',
            'email' => 'muhammadrizkitkj123@gmail.com',
            'password' => Hash::make('123')
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        echo "Token: $token\n";
    }
}
