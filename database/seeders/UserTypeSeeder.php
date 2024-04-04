<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Admin', 'permissions' => '{"users.view" : "1","users.create" : "1","users.edit":"1","users.delete" : "1", "permissions.view" : "1","permissions.edit" : "1", "appointments.view" : "1", "appointments.create" : "1", "appointments.edit" : "1", "appointments.delete" : "1", "recordings.view" : "1", "recordings.create" : "1", "recordings.edit" : "1", "recordings.delete":"1", "healthcare.view" : "1", "healthcare.create" : "1", "healthcare.edit" : "1", "healthcare.delete" : "1", "specialization.view" : "1", "specialization.create" : "1", "specialization.edit" : "1", "specialization.delete" : "1", "doctors.view" : "1", "doctors.create" : "1", "doctors.edit" : "1", "doctors.delete" : "1"}'],
            ['name' => 'Staff', 'permissions' => '{"users.view" : "0","users.create" : "0","users.edit":"1","users.delete" : "1", "permissions.view" : "1","permissions.edit" : "1", "appointments.view" : "1", "appointments.create" : "1", "appointments.edit" : "1", "appointments.delete" : "1", "recordings.view" : "1", "recordings.create" : "1", "recordings.edit" : "1", "recordings.delete":"1", "healthcare.view" : "1", "healthcare.create" : "1", "healthcare.edit" : "1", "healthcare.delete" : "1", "specialization.view" : "1", "specialization.create" : "1", "specialization.edit" : "1", "specialization.delete" : "1", "doctors.view" : "1", "doctors.create" : "1", "doctors.edit" : "1", "doctors.delete" : "1"}'],
            ['name' => 'User', 'permissions' => '{"users.view" : "0","users.create" : "0","users.edit":"0","users.delete" : "0", "permissions.view" : "0","permissions.edit" : "0", "appointments.view" : "1", "appointments.create" : "1", "appointments.edit" : "0", "appointments.delete" : "0", "recordings.view" : "0", "recordings.create" : "0", "recordings.edit" : "0", "recordings.delete":"0", "healthcare.view" : "0", "healthcare.create" : "0", "healthcare.edit" : "0", "healthcare.delete" : "0", "specialization.view" : "0", "specialization.create" : "0", "specialization.edit" : "0", "specialization.delete" : "0", "doctors.view" : "0", "doctors.create" : "0", "doctors.edit" : "0", "doctors.delete" : "0"}'],
        ];

        UserType::truncate();
        if(!empty($data))
        {
            foreach($data as $value)
            {
                UserType::create($value);
            }
        }
    }
}
