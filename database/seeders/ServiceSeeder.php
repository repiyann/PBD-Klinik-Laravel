<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        Service::create(['name' => 'Dentistry']);
        Service::create(['name' => 'Cardiology']);
        Service::create(['name' => 'Orthopedics']);
        Service::create(['name' => 'Ophthalmology']);
        Service::create(['name' => 'Dermatology']);
        // Add more services as needed
    }
}
