<?php

namespace Database\Seeders;

use App\Models\VaccinationCenter;
use Illuminate\Database\Seeder;

class VaccinationCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        VaccinationCenter::insert([
            [
                'name' => 'Mdpur Center',
                'daily_limit' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mirpur Health Hub',
                'daily_limit' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mohakhali vaccination Clinic',
                'daily_limit' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jatrabari Clinic',
                'daily_limit' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dhanmondi Clinic',
                'daily_limit' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
