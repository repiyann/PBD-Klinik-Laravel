<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    public function run()
    {
        Doctor::create(['name' => 'Dr. Smith']);
        Doctor::create(['name' => 'Dr. Johnson']);
        Doctor::create(['name' => 'Dr. Williams']);
        Doctor::create(['name' => 'Dr. Davis']);
        Doctor::create(['name' => 'Dr. Martinez']);
    }
}
