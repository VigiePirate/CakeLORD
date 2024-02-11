<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\LitterSnapshot;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * LitterSnapshot policy
 */
class LitterSnapshotPolicy implements BeforePolicyInterface
{
    /**
     * Open all for root
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @param ?? $action
     * @return bool
     */
    public function before($user, $resource, $action)
    {
        if ($user->getOriginalData()->is_root) {
            return true;
        }
    }

    /**
     * Check if $user can view diff between Rat and RatSnapshot
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LitterSnapshot $litterSnapshot
     * @return bool
     */
    public function canDiff(IdentityInterface $user, LitterSnapshot $litterSnapshot)
    {
        return $user->role->can_change_state;
    }
}
