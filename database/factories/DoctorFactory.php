<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    protected $model = Doctor::class;

    public function definition()
    {
        $hour = $this->faker->numberBetween(6, 18);
        $startTime = sprintf('%02d:00:00', $hour);
        $closingTime = '21:00:00';
        $endTime = date('H:i:s', min(strtotime($startTime) + 6 * 3600, strtotime($closingTime)));

        return [
            'name' => $this->faker->name,
            'work_days' => $this->faker->randomElements(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'], 3),
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
    }
}

