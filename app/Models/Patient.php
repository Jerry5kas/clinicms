<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'dob',
        'gender',
        'phone',
        'email',
        'address',
        'blood_group',
        'medical_history', // store as JSON
    ];

    protected $casts = [
        'medical_history' => 'array', // Laravel will automatically cast JSON to array
        'dob' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}
