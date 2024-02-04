<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName',
        'lastName',
        'nationalID',
        'birthDate',
        'address',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
