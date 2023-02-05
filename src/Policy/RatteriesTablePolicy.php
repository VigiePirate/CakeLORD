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
     * Check if $user can list rats by state
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Table\LittersTable $litters
     * @return bool
     */
    public function canInState(IdentityInterface $user, RatteriesTable $litters)
    {
        return $user->role->can_change_state;
    }

    public function canRegister(IdentityInterface $user, RatteriesTable $litters)
    {
        return true;
    }
}
