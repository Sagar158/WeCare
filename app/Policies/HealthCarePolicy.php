<?php

namespace App\Policies;

use App\Models\User;
use App\Helpers\Helper;
use App\Models\HealthCare;
use Illuminate\Auth\Access\Response;

class HealthCarePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Helper::checkUserPermission('healthcare.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, HealthCare $healthCare): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Helper::checkUserPermission('healthcare.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return Helper::checkUserPermission('healthcare.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return Helper::checkUserPermission('healthcare.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, HealthCare $healthCare): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, HealthCare $healthCare): bool
    {
        //
    }
}
