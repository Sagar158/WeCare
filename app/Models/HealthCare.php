<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthCare extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','institute_address','contact_number','opening_hours','closing_hours','history','map_link','from_day','to_day'
    ];

    public function specializations()
    {
        return $this->belongsToMany(Specializations::class, 'health_care_specializations', 'health_care_id', 'specialization_id');
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class,'health_care_id','id');
    }

}
