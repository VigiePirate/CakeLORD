<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\RatteriesTable;
use Authorization\IdentityInterface;

/**
 * Ratteries policy
 */
class RatteriesTablePolicy
{
    /**
     * Check if $user can list ratteries by state
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Table\RatteriesTable $ratteries
     * @return bool
     */
    public function canInState(IdentityInterface $user, RatteriesTable $ratteries)
    {
        return $user->role->can_change_state;
    }

    /**
     * Check if $user can list rats by state
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Table\RatteriesTable $ratteries
     * @return bool
     */
    public function canFilterByState(IdentityInterface $user, RatteriesTable $ratteries)
    {
        return $user->role->can_change_state;
    }

    public function canRegister(IdentityInterface $user, RatteriesTable $ratteries)
    {
        return true;
    }

    /**
     * Check if $user can add a new Rattery (not necessarily their own; staff reserved)
     *
     * @param Authorization\IdentityInterface $user The user.
     * @return bool
     */
    public function canAdd(IdentityInterface $user)
    {
        return $user->role->can_edit_others;
    }
}
