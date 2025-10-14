<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'reference_no' => 'USER-0001',
            'username' => 'admin',
            'first' => 'System',
            'middle' => null,
            'last' => 'Administrator',
            'type' => 'Admin',
            'password' => Hash::make('admin123'), // default password
        ]);
    }
}
