<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\LittersTable;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Litters policy. Akso applies to ContributionsTable
 */
class LittersTablePolicy implements BeforePolicyInterface
{
    /**
     * Open all for admin
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Table\LittersTable $resource
     * @param ?? $action
     * @return bool
     */
    public function before($user, $resource, $action)
    {
        if ($user->getOriginalData()->is_root) {
            return true;
        };
    }

    /**
     * Check if $user can
     *
     * @param Authorization\IdentityInterface $user The user.
     * @return bool
     */
    public function canIndex(IdentityInterface $user)
    {
        return $user->role->is_staff;
    }

    /**
     * Check if $user can
     *
     * @param Authorization\IdentityInterface $user The user.
     * @return bool
     */
    public function canFromRattery(IdentityInterface $user)
    {
        return true;
    }

    /**
     * Check if $user can list litters by state
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Table\LittersTable $litters
     * @return bool
     */
    public function canInState(IdentityInterface $user, LittersTable $litters)
    {
        return $user->role->can_change_state;
    }
}
