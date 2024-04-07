<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalPosts extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','image','description','created_by'
    ];

    public function scopeCreatedBy($query)
    {
        $userType = auth()->user()->user_type_id;
        $userId = auth()->user()->id;

        if($userType == 2)
        {
            return $query->where('created_by', $userId);
        }

    }

}
