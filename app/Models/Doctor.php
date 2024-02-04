<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'work_days', 'start_time', 'end_time'];

    protected $casts = [
        'work_days' => 'array',
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'doctor_service', 'doctor_id', 'service_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function isAvailable($day, $time)
    {
        return in_array($day, $this->work_days) && $this->isWithinWorkHours($time);
    }

    private function isWithinWorkHours($time)
    {
        return $time >= $this->start_time && $time <= $this->end_time;
    }
}
