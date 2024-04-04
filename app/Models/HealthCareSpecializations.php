<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthCareSpecializations extends Model
{
    use HasFactory;
    protected $fillable = ['health_care_id','specialization_id'];

    public function healthcare()
    {
        return $this->belongsTo(HealthCare::class);
    }
}
