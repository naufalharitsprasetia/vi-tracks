<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vehicles')->insert([
            [
                'plate_number' => 'B 1234 ABC',
                'vehicle_type' => 'ANGKUTAN_ORANG',
                'ownership' => 'MILIK',
                'brand' => 'Toyota Hilux',
                'fuel_type' => 'Solar',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plate_number' => 'B 5678 DEF',
                'vehicle_type' => 'ANGKUTAN_ORANG',
                'ownership' => 'SEWA',
                'brand' => 'Toyota Avanza',
                'fuel_type' => 'Pertalite',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plate_number' => 'DT 1111 AA',
                'vehicle_type' => 'ANGKUTAN_BARANG',
                'ownership' => 'MILIK',
                'brand' => 'Isuzu Giga',
                'fuel_type' => 'Solar',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plate_number' => 'DT 2222 BB',
                'vehicle_type' => 'ANGKUTAN_BARANG',
                'ownership' => 'SEWA',
                'brand' => 'Hino Dutro',
                'fuel_type' => 'Solar',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
