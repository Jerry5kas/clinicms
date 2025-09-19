<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'open_time',
        'close_time',
        'status',
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function staff()
    {
        return $this->hasMany(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
