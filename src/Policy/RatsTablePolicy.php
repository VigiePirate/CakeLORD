<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\RatsTable;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Rats policy
 */
class RatsTablePolicy implements BeforePolicyInterface
{
    /**
     * Open all for admin
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rat $resource
     * @param ?? $action
     * @return bool
     */
    public function before($user, $resource, $action)
    {
        if ($user->role->is_root) {
            return true;
        };
    }

    /**
     * Check if $user can list rats by state
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Table\RatsTable $rats
     * @return bool
     */
    public function canFilterByState(IdentityInterface $user, RatsTable $rats)
    {
        return $user->role->can_change_state;
    }
}
