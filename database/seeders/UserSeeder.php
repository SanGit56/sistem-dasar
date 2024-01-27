<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'username' => 'nama pengguna',
            'name' => 'nama',
            'email' => 'surel juga',
            'password' => 'kata sandi',
            'status' => false,
            'created_at' => Carbon::now()
        ]);
    }
}
