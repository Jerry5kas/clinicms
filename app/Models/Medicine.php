<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_id',
        'name',
        'description',
        'stock',
        'price',
        'expiry_date'
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];

    // 🔗 Relationships
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function usageRecords()
    {
        return $this->hasMany(MedicineUsage::class);
    }
}
