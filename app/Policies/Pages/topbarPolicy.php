<?php

namespace Tasawk\Policies\Pages;

use Tasawk\Models\User;
use Tasawk\Models\Pages\Topbar;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopbarPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \Tasawk\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_pages::topbars');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Tasawk\Models\User  $user
     * @param  \Tasawk\Models\Pages\Topbar  $partner
     * @return bool
     */
    public function view(User $user, Topbar $partner): bool
    {
        return $user->can('view_pages::topbars');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Tasawk\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_pages::topbars');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Tasawk\Models\User  $user
     * @param  \Tasawk\Models\Pages\Topbar  $partner
     * @return bool
     */
    public function update(User $user, Topbar $partner): bool
    {
        return $user->can('update_pages::topbars');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Tasawk\Models\User  $user
     * @param  \Tasawk\Models\Pages\Topbar  $partner
     * @return bool
     */
    public function delete(User $user, Topbar $partner): bool
    {
        return $user->can('delete_pages::topbars');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \Tasawk\Models\User  $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_pages::topbars');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \Tasawk\Models\User  $user
     * @param  \Tasawk\Models\Pages\Topbar  $partner
     * @return bool
     */
    public function forceDelete(User $user, Topbar $partner): bool
    {
        return $user->can('{{ ForceDelete }}');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \Tasawk\Models\User  $user
     * @return bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('{{ ForceDeleteAny }}');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \Tasawk\Models\User  $user
     * @param  \Tasawk\Models\Pages\Topbar  $partner
     * @return bool
     */
    public function restore(User $user, Topbar $partner): bool
    {
        return $user->can('{{ Restore }}');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \Tasawk\Models\User  $user
     * @return bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('{{ RestoreAny }}');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \Tasawk\Models\User  $user
     * @param  \Tasawk\Models\Pages\Topbar  $partner
     * @return bool
     */
    public function replicate(User $user, Topbar $partner): bool
    {
        return $user->can('{{ Replicate }}');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \Tasawk\Models\User  $user
     * @return bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('{{ Reorder }}');
    }

}
