<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\UserType' => 'App\Policies\UserTypePolicy',
        'App\Models\Appointments' => 'App\Policies\AppointmentsPolicy',
        'App\Models\Specializations' => 'App\Policies\SpecializationPolicy',
        'App\Models\Doctors' => 'App\Policies\DoctorPolicy',
        'App\Models\HealthCare' => 'App\Policies\HealthCarePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
