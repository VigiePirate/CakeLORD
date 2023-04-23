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
     * @param App\Model\Entity\Rat $resource
     * @param ?? $action
     * @return bool
     */
    public function before($user, $resource, $action)
    {
        // Root can do anything, no matter the Roles table
        if ($user->getOriginalData()->is_root) {
            return true;
        }

        // Locked users can't do anything
        if ($user->getOriginalData()->is_locked) {
            return false;
        }

        // Frozen sheets are restricted
        if ($resource->state->is_frozen && ! $user->role->can_edit_frozen) {
            return false;
        }
    }

    /**
     * Check if $user can view his own rats
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rat $rat
     * @return bool
     */
    public function canMy(IdentityInterface $user, Rat $rat)
    {
        return ! $user->is_locked;
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

    public function canSeePrivate(IdentityInterface $user, Rat $rat)
    {
        return $this->isOwner($user, $rat) || $user->role->is_staff;
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
        return ! $user->is_locked;
    }

    /**
     * Check if $user can edit Rat whatever role
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rat $rat
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Rat $rat)
    {
        return $this->canOwnerEdit($user, $rat) || $this->canStaffEdit($user, $rat);
    }

    /**
     * Check if $user can edit Rat as a user
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rat $rat
     * @return bool
     */
    public function canOwnerEdit(IdentityInterface $user, Rat $rat)
    {
        return ! $rat->state->needs_staff_action && $this->isOwner($user, $rat);
    }

    /**
     * Check if $user can edit Rat as a staff member
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rat $rat
     * @return bool
     */
    public function canStaffEdit(IdentityInterface $user, Rat $rat)
    {
        return $rat->state->needs_staff_action && $user->role->can_edit_others;
    }

    /**
     * Check if $user can perform micro edits on rat
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rat $rat
     * @return bool
     */
    public function canMicroEdit(IdentityInterface $user, Rat $rat)
    {
        $staff_condition = $rat->state->needs_staff_action && $user->role->can_edit_others;

        $user_condition = ! $rat->state->needs_staff_action &&
            ($this->isOwner($user, $rat) || $this->isCreator($user, $rat) || $this->isBreeder($user, $rat));

        return $staff_condition || $user_condition ;
    }

    /**
     * Check if $user can delete Rat. Only frozen, unreliable rats can be deleted.
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rat $rat
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Rat $rat)
    {
        return $rat->state->is_frozen && ! $rat->state->is_reliable && $user->role->can_delete;
    }

    /**
     * Check if $user can restore rat from snapshot
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rat $rat
     * @return bool
     */
    public function canRestore(IdentityInterface $user, Rat $rat)
    {
        return $user->role->can_restore;
    }

    /**
     * Check if $user can alter a sheet state (except thawing)
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rat $rat
     * @return bool
     */
    public function canChangeState(IdentityInterface $user, Rat $rat)
    {
        return $user->role->can_change_state;
    }

    public function canEditFrozen(IdentityInterface $user, Rat $rat)
    {
        return $user->role->can_edit_frozen;
    }

    /**
     * Auxiliaries
     */
    protected function isOwner(IdentityInterface $user, Rat $rat)
    {
        return $rat->owner_user_id == $user->getIdentifier();
    }

    protected function isCreator(IdentityInterface $user, Rat $rat)
    {
        return $rat->creator_user_id == $user->getIdentifier();
    }

    protected function isBreeder(IdentityInterface $user, Rat $rat)
    {
        if (! is_null($rat->birth_litter)) {
            $contributions = $rat->birth_litter->contributions;
            foreach ($contributions as $contribution) {
                $owner_id = $contribution->rattery->owner_user_id;
                if ($owner_id == $user->getIdentifier()) {
                    return true;
                }
            }
        }
        // rats with nongeneric prefix but no litter (legacy case)
        else {
           if ($rat->rattery->owner_user_id === $user->getIdentifier()) {
               return true;
           }
        }
        return false;
    }
}
