<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\RatterySnapshot;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * RatterySnapshot policy
 */
class RatterySnapshotPolicy implements BeforePolicyInterface
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
     * Check if $user can view RatterySnapshot
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\RatterySnapshot $ratterySnapshot
     * @return bool
     */
    public function canDiff(IdentityInterface $user, RatterySnapshot $ratterySnapshot)
    {
        return $user->role->can_change_state;
    }
}
