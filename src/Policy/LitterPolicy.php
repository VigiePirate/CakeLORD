<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Litter;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Litter policy
 */
class LitterPolicy
{
    /**
     * Open all for admin
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Litter $resource
     * @param ?? $action
     * @return bool
     */
    public function before($user, $resource, $action)
    {
        return $user->getOriginalData()->is_admin;
    }

    /**
     * Check if $user can create Litter
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Litter $litter
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Litter $litter)
    {
        return true;
    }

    /**
     * Check if $user can edit Litter
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Litter $litter
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Litter $litter)
    {
        return $user->getOriginalData()->is_admin;
    }

    /**
     * Check if $user can update Litter
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Litter $litter
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Litter $litter)
    {
        if ($user->getOriginalData()->is_staff) {
            return true;
        }
        // Can update owned litters
        return $user->get('id') === $resource->get('creator_user_id');
    }

    /**
     * Check if $user can list own Litters
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Litter $litter
     * @return bool
     */
    public function canMy(IdentityInterface $user, Litter $litter)
    {
        return $user->get('id') === $resource->get('creator_user_id');
    }

    /**
     * Check if $user can delete Litter
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Litter $litter
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Litter $litter)
    {
        return $user->getOriginalData()->is_staff;
    }

    /**
     * Check if $user can view Litter
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Litter $litter
     * @return bool
     */
    public function canView(IdentityInterface $user, Litter $litter)
    {
        return true;
    }
}
