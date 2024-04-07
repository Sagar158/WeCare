<?php

namespace App\Policies;

use App\Models\User;
use App\Helpers\Helper;
use App\Models\Recordings;
use Illuminate\Auth\Access\Response;

class RecordingsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Helper::checkUserPermission('recordings.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Recordings $recordings): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Helper::checkUserPermission('recordings.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return Helper::checkUserPermission('recordings.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return Helper::checkUserPermission('recordings.delete');

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Recordings $recordings): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Recordings $recordings): bool
    {
        //
    }
}
