<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Lord;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Lord policy
 */
class LordPolicy implements BeforePolicyInterface
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
     * Check if $user can access back-office dashboard
     *
     * @param Authorization\IdentityInterface $user The user.
     * @return bool
     */
    public function canMy(IdentityInterface $user)
    {
        return $user->is_staff;
    }
}
