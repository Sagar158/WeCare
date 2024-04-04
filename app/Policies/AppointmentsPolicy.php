<?php

namespace App\Policies;

use App\Models\User;
use App\Helpers\Helper;
use App\Models\Appointments;
use Illuminate\Auth\Access\Response;

class AppointmentsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Helper::checkUserPermission('appointments.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Appointments $appointments): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Helper::checkUserPermission('appointments.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return Helper::checkUserPermission('appointments.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return Helper::checkUserPermission('appointments.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Appointments $appointments): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Appointments $appointments): bool
    {
        //
    }
}
