<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Rat;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Rat policy
 */
class RatPolicy implements BeforePolicyInterface
{
    /**
     * Open all for admin
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @param ?? $action
     * @return bool
     */
    public function before($user, $resource, $action)
    {
        return $user->getOriginalData()->is_admin;
    }

    /**
     * Check if $user can add Rat
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rat $rat
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Rat $rat)
    {
        return true;
    }

    /**
     * Check if $user can create Rat
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rat $rat
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Rat $rat)
    {
        return true;
    }

    /**
     * Check if $user can edit Rat
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rat $rat
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Rat $rat)
    {
        return $user->getOriginalData()->is_admin;
    }

    /**
     * Check if $user can update Rat
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rat $rat
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Rat $rat)
    {
        if ($user->getOriginalData()->is_staff) {
            return true;
        }
        // Can update owned rats
        return ($user->get('id') === $resource->get('owner_user_id')) || ($user->get('id') === $resource->get('creator_user_id'));
    }

    /**
     * Check if $user can delete Rat
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rat $rat
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Rat $rat)
    {
        return $user->getOriginalData()->is_staff;
    }

    /**
     * Check if $user can view Rat
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rat $rat
     * @return bool
     */
    public function canView(IdentityInterface $user, Rat $rat)
    {
        return true;
    }
}
