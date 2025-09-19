<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'clinic_id',
        'date',
        'check_in',
        'check_out',
        'status'
    ];

    protected $casts = [
        'date'      => 'date',
        'check_in'  => 'datetime:H:i',
        'check_out' => 'datetime:H:i',
    ];

    // 🔗 Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
