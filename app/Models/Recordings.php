<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recordings extends Model
{
    use HasFactory;
    protected $fillable = ['appointment_id','recording_id'];

    public function appointment()
    {
        return $this->hasOne(Appointments::class,'id','appointment_id');
    }
}
