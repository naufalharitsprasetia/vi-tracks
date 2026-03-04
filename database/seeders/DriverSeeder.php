<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('drivers')->insert([
            [
                'name' => 'Budi Santoso',
                'phone' => '081234567801',
                'license_number' => 'SIM-A-001',
                'address' => 'Jl. Merdeka No. 123, Jakarta',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ahmad Fauzi',
                'phone' => '081234567802',
                'license_number' => 'SIM-A-002',
                'address' => 'Jl. Sudirman No. 456, Bandung',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Herman Wijaya',
                'phone' => '081234567803',
                'license_number' => 'SIM-B-003',
                'address' => 'Jl. Diponegoro No. 789, Surabaya',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rahmat Hidayat',
                'phone' => '081234567804',
                'license_number' => 'SIM-B-004',
                'address' => 'Jl. Gajah Mada No. 321, Makassar',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
