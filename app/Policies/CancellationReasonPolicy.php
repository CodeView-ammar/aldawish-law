<?php

namespace Tasawk\Policies;

use Tasawk\Models\User;
use Tasawk\Models\CancellationReason;
use Illuminate\Auth\Access\HandlesAuthorization;

class CancellationReasonPolicy
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
        return $user->can('view_any_cancellation::reason');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Tasawk\Models\User  $user
     * @param  \Tasawk\Models\CancellationReason  $cancellationReason
     * @return bool
     */
    public function view(User $user, CancellationReason $cancellationReason): bool
    {
        return $user->can('view_cancellation::reason');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Tasawk\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_cancellation::reason');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Tasawk\Models\User  $user
     * @param  \Tasawk\Models\CancellationReason  $cancellationReason
     * @return bool
     */
    public function update(User $user, CancellationReason $cancellationReason): bool
    {
        return $user->can('update_cancellation::reason');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Tasawk\Models\User  $user
     * @param  \Tasawk\Models\CancellationReason  $cancellationReason
     * @return bool
     */
    public function delete(User $user, CancellationReason $cancellationReason): bool
    {
        return $user->can('delete_cancellation::reason');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \Tasawk\Models\User  $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_cancellation::reason');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \Tasawk\Models\User  $user
     * @param  \Tasawk\Models\CancellationReason  $cancellationReason
     * @return bool
     */
    public function forceDelete(User $user, CancellationReason $cancellationReason): bool
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
     * @param  \Tasawk\Models\CancellationReason  $cancellationReason
     * @return bool
     */
    public function restore(User $user, CancellationReason $cancellationReason): bool
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
     * @param  \Tasawk\Models\CancellationReason  $cancellationReason
     * @return bool
     */
    public function replicate(User $user, CancellationReason $cancellationReason): bool
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
