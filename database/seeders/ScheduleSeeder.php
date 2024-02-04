<?php

namespace Database\Seeders;

// database/seeders/ScheduleSeeder.php

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Doctor;
use App\Models\Service;

class ScheduleSeeder extends Seeder
{
    public function run()
    {
        $dentist = Service::where('name', 'Dentistry')->first();
        $cardiologist = Service::where('name', 'Cardiology')->first();
        $orthopedic = Service::where('name', 'Orthopedics')->first();
        $ophthalmologist = Service::where('name', 'Ophthalmology')->first();
        $dermatologist = Service::where('name', 'Dermatology')->first();

        $drSmith = Doctor::where('name', 'Dr. Smith')->first();
        $drJohnson = Doctor::where('name', 'Dr. Johnson')->first();
        $drWilliams = Doctor::where('name', 'Dr. Williams')->first();
        $drDavis = Doctor::where('name', 'Dr. Davis')->first();
        $drMartinez = Doctor::where('name', 'Dr. Martinez')->first();

        // Schedule for Dr. Smith (Dentistry)
        Schedule::create([
            'doctor_id' => $drSmith->id,
            'day' => 'Monday',
            'start_time' => '09:00',
            'end_time' => '17:00',
            'max_appointments' => 10,
            'current_appointments' => 0,
        ]);

        // Schedule for Dr. Smith (Cardiology)
        Schedule::create([
            'doctor_id' => $drSmith->id,
            'day' => 'Tuesday',
            'start_time' => '10:00',
            'end_time' => '18:00',
            'max_appointments' => 8,
            'current_appointments' => 0,
        ]);

        // Schedule for Dr. Johnson (Cardiology)
        Schedule::create([
            'doctor_id' => $drJohnson->id,
            'day' => 'Wednesday',
            'start_time' => '08:00',
            'end_time' => '16:00',
            'max_appointments' => 12,
            'current_appointments' => 0,
        ]);

        // Schedule for Dr. Williams (Orthopedics)
        Schedule::create([
            'doctor_id' => $drWilliams->id,
            'day' => 'Thursday',
            'start_time' => '12:00',
            'end_time' => '20:00',
            'max_appointments' => 15,
            'current_appointments' => 0,
        ]);

        // Schedule for Dr. Davis (Ophthalmology)
        Schedule::create([
            'doctor_id' => $drDavis->id,
            'day' => 'Friday',
            'start_time' => '11:00',
            'end_time' => '19:00',
            'max_appointments' => 10,
            'current_appointments' => 0,
        ]);

        // Schedule for Dr. Martinez (Dermatology)
        Schedule::create([
            'doctor_id' => $drMartinez->id,
            'day' => 'Saturday',
            'start_time' => '09:00',
            'end_time' => '17:00',
            'max_appointments' => 8,
            'current_appointments' => 0,
        ]);

        // Add more schedules as needed
    }
}
