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
            'name' => 'Muhammad Rizki',
            'username' => 'adminsimak',
            'password' => Hash::make('123')
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        echo "Token: $token\n";
    }
}
