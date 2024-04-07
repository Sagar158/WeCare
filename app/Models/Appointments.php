<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id','appointment_date','appointment_time','type','healthcare_id','specialization_id','doctor_id','reason','status','appointment_number'
    ];

    public static $status = array(
        'pending' => 'Pending',
        'confirmed' => 'Confirmed',
        'cancelled' => 'Cancelled',
        'completed' => 'Completed',
    );

    public function doctor()
    {
        return $this->hasOne(Doctor::class,'id','doctor_id');
    }

    public function healthcare()
    {
        return $this->hasOne(HealthCare::class, 'id','healthcare_id');
    }
    public function specialization()
    {
        return $this->hasOne(Specializations::class, 'id','specialization_id');
    }
    public function patient()
    {
        return $this->hasOne(User::class, 'id','patient_id');
    }


    public function scopeUser($query)
    {
        $userType = auth()->user()->user_type_id;
        $userId = auth()->user()->id;
        if($userType == 3)
        {
            return $query->where('patient_id', $userId);
        }
    }


    public static function status(){

    }


}
