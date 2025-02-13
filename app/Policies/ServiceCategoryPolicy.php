<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\ServiceCategory;
use App\Models\User;

class ServiceCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any ServiceCategory');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ServiceCategory $servicecategory): bool
    {
        return $user->checkPermissionTo('view ServiceCategory');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create ServiceCategory');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ServiceCategory $servicecategory): bool
    {
        return $user->checkPermissionTo('update ServiceCategory');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ServiceCategory $servicecategory): bool
    {
        return $user->checkPermissionTo('delete ServiceCategory');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any ServiceCategory');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ServiceCategory $servicecategory): bool
    {
        return $user->checkPermissionTo('restore ServiceCategory');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any ServiceCategory');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, ServiceCategory $servicecategory): bool
    {
        return $user->checkPermissionTo('replicate ServiceCategory');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder ServiceCategory');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ServiceCategory $servicecategory): bool
    {
        return $user->checkPermissionTo('force-delete ServiceCategory');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any ServiceCategory');
    }
}
