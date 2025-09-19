<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicineUsage extends Model
{
    use HasFactory;

    protected $table = 'medicine_usage';

    protected $fillable = [
        'medicine_id', 'patient_id', 'doctor_id',
        'appointment_id', 'quantity'
    ];

    // 🔗 Relationships
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
