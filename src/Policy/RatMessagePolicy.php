<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\RatMessage;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * RatMessage policy
 */
class RatMessagePolicy implements BeforePolicyInterface
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
     * Check if $user can add RatMessage
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\RatMessage $ratMessage
     * @return bool
     */
    public function canAdd(IdentityInterface $user, RatMessage $ratMessage)
    {
    }

    /**
     * Check if $user can edit RatMessage
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\RatMessage $ratMessage
     * @return bool
     */
    public function canEdit(IdentityInterface $user, RatMessage $ratMessage)
    {
    }

    /**
     * Check if $user can delete RatMessage
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\RatMessage $ratMessage
     * @return bool
     */
    public function canDelete(IdentityInterface $user, RatMessage $ratMessage)
    {
        return $user->is_staff;
    }

    /**
     * Check if $user can view RatMessage
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\RatMessage $ratMessage
     * @return bool
     */
    public function canView(IdentityInterface $user, RatMessage $ratMessage)
    {
    }
}
