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
        // Root can do anything, no matter the Roles table
        if ($user->getOriginalData()->is_root) {
            return true;
        }
    }

    /**
     * Check if $user can add a new Rattery (not necessarily their own; staff reserved)
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rattery $rattery
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Rattery $rattery)
    {
        return $user->role->can_edit_others;
    }

    /**
     * Check if $user can register their Rattery
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rattery $rattery
     * @return bool
     */
    public function canRegister(IdentityInterface $user, Rattery $rattery)
    {
        return true;
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
     * Check if $user can edit Rattery
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rattery $rattery
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Rattery $rattery)
    {
        return $this->isOwner($user, $rattery) || $user->role->can_edit_others;
    }

    /**
     * Check if $user can change picture or relocate the Rattery
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rattery $rattery
     * @return bool
     */
    public function canMicroEdit(IdentityInterface $user, Rattery $rattery)
    {
        return $this->isOwner($user, $rattery) || $user->role->can_edit_others;
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
        return $user->role->can_delete;
    }

    /**
     * Check if $user can alter a sheet state
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rat $rat
     * @return bool
     */
    public function canChangeState(IdentityInterface $user, Rattery $rattery)
    {
        return $user->role->can_change_state;
    }

    public function canEditFrozen(IdentityInterface $user, Rattery $rattery)
    {
        return $user->role->can_edit_frozen;
    }

    /**
     * Auxiliaries
     */
    protected function isOwner(IdentityInterface $user, Rattery $rattery)
    {
        return $rattery->owner_user_id == $user->getIdentifier();
    }
}
