<?php

namespace Database\Seeders;

use App\Models\Specializations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Cardiology'],['name' => 'Onclology'],['name' => 'Neurology'],['name' => 'Dentist'],['name' => 'Urology']
        ];
        if(!empty($data))
        {
            foreach($data as $value)
            {
                Specializations::create($value);
            }
        }
    }
}
