<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Sample Admin',
                'email' => 'admin@example.com',
                'role'  => 'admin',
                'password' => Hash::make('12345678'), // Password hashing
            ],
            [
                'name' => 'Sample User',
                'email' => 'user@example.com',
                'role'  => 'user',
                'password' => Hash::make('12345678'), // Password hashing
            ],
        ]);
        User::factory()->count(5)->create();
    }
}
