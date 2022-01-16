<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Rattery;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Rattery policy
 */
class RatteryPolicy
{
    /**
     * Open all for admin
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rattery $resource
     * @param ?? $action
     * @return bool
     */
    public function before($user, $resource, $action)
    {
        return $user->getOriginalData()->is_admin;
    }

    /**
     * Check if $user can create Rattery
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rattery $rattery
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Rattery $rattery)
    {
        return true;
    }

    /**
     * Check if $user can edit Rattery
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rattery $rattery
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Rattery $rattery)
    {
        return $user->getOriginalData()->is_admin;
    }

    /**
     * Check if $user can update Rattery
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rattery $rattery
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Rattery $rattery)
    {
        if ($user->getOriginalData()->is_staff) {
            return true;
        }
        // Can update owned rats
        return $user->get('id') === $resource->get('owner_user_id');
    }

    /**
     * Check if $user can delete Rattery
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rattery $rattery
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Rattery $rattery)
    {
        return $user->getOriginalData()->is_staff;
    }

    /**
     * Check if $user can view Rattery
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rattery $rattery
     * @return bool
     */
    public function canView(IdentityInterface $user, Rattery $rattery)
    {
        return true;
    }

    /**
     * Check if $user can relocate Rattery
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rattery $rattery
     * @return bool
     */
    public function canRelocate(IdentityInterface $user, Rattery $rattery)
    {
        return true;
    }
}
