<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\RatSnapshot;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * RatSnapshot policy
 */
class RatSnapshotPolicy implements BeforePolicyInterface
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
     * Check if $user can view RatSnapshot
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\RatSnapshot $ratSnapshot
     * @return bool
     */
    public function canDiff(IdentityInterface $user, RatSnapshot $ratSnapshot)
    {
        return $user->role->can_change_state;
    }
}
