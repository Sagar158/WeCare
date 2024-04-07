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
    public function scopeHealthcare($query)
    {
        $userType = auth()->user()->user_type_id;
        $userId = auth()->user()->id;
        $healthCareId = auth()->user()->health_care_id;
        if($userType == 2)
        {
            return $query->where('healthcare_id', $healthCareId);
        }
        else if($userType == 3)
        {
            return $query->where('patient_id', $userId);
        }

    }

}
