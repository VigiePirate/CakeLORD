<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Rattery;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Rattery policy
 */
class RatteryPolicy implements BeforePolicyInterface
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

        // Frozen sheets are restricted
        if ($resource->state->is_frozen && ! $user->role->can_edit_frozen) {
            return false;
        }
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

    public function canSeePrivate(IdentityInterface $user, Rattery $rattery)
    {
        return $this->isOwner($user, $rattery) || $user->role->is_staff;
    }

    /**
     * Check if $user can edit Rattery whatever role
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rattery $rattery
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Rattery $rattery)
    {
        return $this->canOwnerEdit($user, $rattery) || $this->canStaffEdit($user, $rattery);
    }

    /**
     * Check if $user can edit Rattery as a user
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rattery $rattery
     * @return bool
     */
    public function canOwnerEdit(IdentityInterface $user, Rattery $rattery)
    {
        return ! $rattery->state->needs_staff_action && $this->isOwner($user, $rattery);
    }

    /**
     * Check if $user can edit Rattery as a staff member
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rattery $rattery
     * @return bool
     */
    public function canStaffEdit(IdentityInterface $user, Rattery $rattery)
    {
        return $rattery->state->needs_staff_action && $user->role->can_edit_others;
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
        return (! $rattery->state->needs_staff_action && $this->isOwner($user, $rattery))
            || ($rattery->state->needs_staff_action && $user->role->can_edit_others);
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
        return $rattery->state->is_frozen && ! $rattery->state->is_reliable && $user->role->can_delete;
    }

    /**
     * Check if $user can restore rat from snapshot
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rattery $rat
     * @return bool
     */
    public function canRestore(IdentityInterface $user, Rattery $rattery)
    {
        return $user->role->can_restore;
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
