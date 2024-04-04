<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthCare extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','institute_address','contact_number','opening_hours','closing_hours','history'
    ];

    public function specializations()
    {
        return $this->belongsToMany(Specializations::class, 'health_care_specializations', 'health_care_id', 'specialization_id');
    }
}
