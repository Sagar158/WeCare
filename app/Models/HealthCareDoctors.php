<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthCareDoctors extends Model
{
    use HasFactory;

    protected $fillable = ['health_care_id','doctor_id'];
}
