<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\EventAttendee;
use App\Models\User;

class EventAttendeePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any EventAttendee');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EventAttendee $eventattendee): bool
    {
        return $user->checkPermissionTo('view EventAttendee');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create EventAttendee');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EventAttendee $eventattendee): bool
    {
        return $user->checkPermissionTo('update EventAttendee');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EventAttendee $eventattendee): bool
    {
        return $user->checkPermissionTo('delete EventAttendee');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any EventAttendee');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, EventAttendee $eventattendee): bool
    {
        return $user->checkPermissionTo('restore EventAttendee');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any EventAttendee');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, EventAttendee $eventattendee): bool
    {
        return $user->checkPermissionTo('replicate EventAttendee');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder EventAttendee');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, EventAttendee $eventattendee): bool
    {
        return $user->checkPermissionTo('force-delete EventAttendee');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any EventAttendee');
    }
}
