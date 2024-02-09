<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
    }

    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $startWork = $this->getRandomWorkHour(6, 21);
            $maxDuration = min(7, 21 - $startWork);
            $endWork = $this->getRandomWorkHour($startWork + 1, $startWork + $maxDuration);

            Doctor::create([
                'name' => 'Dr. '.$this->faker->name,
                'service' => $this->faker->randomElement(['Dentist', 'Cardiologist', 'Orthopedic']),
                'work_days' => json_encode($this->getRandomWorkDays()),
                'start_work' => $startWork.':00:00',
                'end_work' => $endWork.':00:00',
            ]);
        }
    }

    private function getRandomWorkDays()
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        shuffle($days);

        return array_slice($days, 0, rand(1, count($days)));
    }

    private function getRandomWorkHour($min, $max)
    {
        return mt_rand($min, $max);
    }
}
