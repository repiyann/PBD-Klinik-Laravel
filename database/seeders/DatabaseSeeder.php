<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Doctor;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // DatabaseSeeder.php
    public function run()
    {
        $this->call([
            DoctorSeeder::class,
        ]);
    }
}
