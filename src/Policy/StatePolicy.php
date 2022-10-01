<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\State;
use Authorization\IdentityInterface;

/**
 * State policy
 */
class StatePolicy
{
    /**
     * Check if $user can act on State
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\State $state
     * @return bool
     */
    public function canAct(IdentityInterface $user, State $state)
    {
        return $user->getOriginalData()->can_change_state;
    }
}
