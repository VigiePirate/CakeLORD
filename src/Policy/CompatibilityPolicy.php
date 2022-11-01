<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Compatibility;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Compatibility policy
 */
class CompatibilityPolicy implements BeforePolicyInterface
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
     * Check if $user can add Compatibility
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Compatibility $compatibility
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Compatibility $compatibility)
    {
    }

    /**
     * Check if $user can edit Compatibility
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Compatibility $compatibility
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Compatibility $compatibility)
    {
    }

    /**
     * Check if $user can delete Compatibility
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Compatibility $compatibility
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Compatibility $compatibility)
    {
    }

    /**
     * Check if $user can view Compatibility
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Compatibility $compatibility
     * @return bool
     */
    public function canView(IdentityInterface $user, Compatibility $compatibility)
    {
    }
}
