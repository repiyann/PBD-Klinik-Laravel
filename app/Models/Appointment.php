<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_id',
        'firstName',
        'lastName',
        'clinicService',
        'dateAvailable',
        'doctor_id',
        'timeSlot'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function record()
    {
        return $this->belongsTo(Record::class, 'record_id');
    }
}
