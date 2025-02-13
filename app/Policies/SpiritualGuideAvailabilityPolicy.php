<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\SpiritualGuideAvailability;
use App\Models\User;

class SpiritualGuideAvailabilityPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any SpiritualGuideAvailability');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SpiritualGuideAvailability $spiritualguideavailability): bool
    {
        return $user->checkPermissionTo('view SpiritualGuideAvailability');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create SpiritualGuideAvailability');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SpiritualGuideAvailability $spiritualguideavailability): bool
    {
        return $user->checkPermissionTo('update SpiritualGuideAvailability');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SpiritualGuideAvailability $spiritualguideavailability): bool
    {
        return $user->checkPermissionTo('delete SpiritualGuideAvailability');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any SpiritualGuideAvailability');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SpiritualGuideAvailability $spiritualguideavailability): bool
    {
        return $user->checkPermissionTo('restore SpiritualGuideAvailability');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any SpiritualGuideAvailability');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, SpiritualGuideAvailability $spiritualguideavailability): bool
    {
        return $user->checkPermissionTo('replicate SpiritualGuideAvailability');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder SpiritualGuideAvailability');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SpiritualGuideAvailability $spiritualguideavailability): bool
    {
        return $user->checkPermissionTo('force-delete SpiritualGuideAvailability');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any SpiritualGuideAvailability');
    }
}
