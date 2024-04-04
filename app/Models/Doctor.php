<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'experience',
        'health_care_id',
        'specialization_id',
        'image',
        'description',
    ];

    public function specialization()
    {
        return $this->hasOne(Specializations::class,'id','specialization_id');
    }
    public function healthcare()
    {
        return $this->hasOne(HealthCare::class,'id','health_care_id');
    }

}
