<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'user_id',
        'clinic_id',
        'specialization',
        'experience',          // you might want to add this column in migration
        'consultation_fee',
        'available_days',      // JSON array of days
        'available_time',      // JSON with start and end times
    ];

    protected $casts = [
        'available_days' => 'array',
        'available_time' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
