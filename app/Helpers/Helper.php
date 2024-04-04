<?php
namespace App\Helpers;

use App\Models\User;
use App\Models\UserType;
use App\Models\HealthCare;
use App\Models\Specializations;
use Illuminate\Support\Facades\Storage;

class Helper
{
    public static $gender = array('male' => 'Male', 'female' => 'Female', 'other' => 'Other');
    public static $type = array('visit' => 'Visit', 'recording' => 'Recording');

    public static function checkUserPermission($permissionName)
    {
        $permissions = self::userPermissions();
        return ($permissions->{$permissionName} == 1) ? true : false;
    }

    public static function userPermissions()
    {
        $userTypeId = auth()->user()->user_type_id;
        $permissions = UserType::select('permissions')->where('id', $userTypeId)->first()->permissions;
        return json_decode($permissions);
    }
    public static function fetchUserType()
    {
        return UserType::select('id','name')->pluck('name','id')->toArray();
    }

    public static function fetchPatients()
    {
        $users = User::all(['id', 'first_name', 'last_name']);

        $patients = $users->mapWithKeys(function ($user) {
            return [$user->id => $user->fullname];
        });
        return $patients->toArray();
    }

    public static function fetchSpecializations()
    {
        return Specializations::select('id','name')->pluck('name','id')->toArray();
    }
    public static function fetchHealthCare()
    {
        return HealthCare::select('id','name')->pluck('name','id')->toArray();
    }

    public static function imageUpload($file, $existingFile = '')
    {
        $path = $file->store('public/uploads');
        return Storage::url($path);
    }

}
?>
