<?php

namespace Tasawk\Policies;

use Tasawk\Models\User;
use Tasawk\Models\CaseParty;
use Illuminate\Auth\Access\HandlesAuthorization;

class CasePartyPolicy
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
        return $user->can('view_any_case::party');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Tasawk\Models\User  $user
     * @param  \Tasawk\Models\CaseParty  $caseParty
     * @return bool
     */
    public function view(User $user, CaseParty $caseParty): bool
    {
        return $user->can('view_case::party');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Tasawk\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_case::party');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Tasawk\Models\User  $user
     * @param  \Tasawk\Models\CaseParty  $caseParty
     * @return bool
     */
    public function update(User $user, CaseParty $caseParty): bool
    {
        return $user->can('update_case::party');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Tasawk\Models\User  $user
     * @param  \Tasawk\Models\CaseParty  $caseParty
     * @return bool
     */
    public function delete(User $user, CaseParty $caseParty): bool
    {
        return $user->can('delete_case::party');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \Tasawk\Models\User  $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_case::party');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \Tasawk\Models\User  $user
     * @param  \Tasawk\Models\CaseParty  $caseParty
     * @return bool
     */
    public function forceDelete(User $user, CaseParty $caseParty): bool
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
     * @param  \Tasawk\Models\CaseParty  $caseParty
     * @return bool
     */
    public function restore(User $user, CaseParty $caseParty): bool
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
     * @param  \Tasawk\Models\CaseParty  $caseParty
     * @return bool
     */
    public function replicate(User $user, CaseParty $caseParty): bool
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