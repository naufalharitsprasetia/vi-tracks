<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // ======================
            // ADMIN
            // ======================
            [
                'name' => 'Admin Vi-Tracks',
                'title' => 'Administrator',
                'email' => 'admin@vitracks.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'approval_level' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ======================
            // APPROVER LEVEL 1
            // ======================
            [
                'name' => 'Bambang Hartono',
                'title' => 'Manajer Operasional',
                'email' => 'manager@vitracks.com',
                'password' => Hash::make('12345678'),
                'role' => 'approver',
                'approval_level' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ======================
            // APPROVER LEVEL 2
            // ======================
            [
                'name' => 'Dr. Suhendra',
                'title' => 'Direktur Utama',
                'email' => 'director@vitracks.com',
                'password' => Hash::make('12345678'),
                'role' => 'approver',
                'approval_level' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
