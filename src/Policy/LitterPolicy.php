<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Litter;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Litter policy
 */
class LitterPolicy implements BeforePolicyInterface
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

        // Frozen sheets are restricted
        if ($resource->state->is_frozen && ! $user->role->can_edit_frozen) {
            return false;
        }
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

    public function canSeePrivate(IdentityInterface $user, Litter $litter)
    {
        return $this->isCreator($user, $litter)
            || $this->isContributor($user, $litter)
            || $user->role->is_staff;
    }

    /**
     * Check if $user can create Litter
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Litter $litter
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Litter $litter)
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
        return (! $litter->state->needs_user_action && $user->role->can_edit_others)
            || (! $litter->state->needs_staff_action && $this->isCreator($user, $litter));
    }

    public function canAddRat(IdentityInterface $user, Litter $litter)
    {
        return true;
    }

    public function canManageContributions(IdentityInterface $user, Litter $litter)
    {
        return (! $litter->state->needs_staff_action && $this->isCreator($user, $litter))
            || (! $litter->state->needs_staff_action && $this->isContributor($user, $litter))
            || (! $litter->state->needs_user_action && $user->role->can_edit_others);
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
        return true;
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
        return $litter->state->is_frozen && ! $litter->state->is_reliable && $user->role->can_delete;
    }

    /**
     * Check if $user can alter a sheet state (except frozen sheets)
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rat $rat
     * @return bool
     */
    public function canChangeState(IdentityInterface $user, Litter $litter)
    {
        return $user->role->can_change_state;
    }

    /**
     * Check if $user can alter a frozen sheet state
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rat $rat
     * @return bool
     */
    public function canEditFrozen(IdentityInterface $user, Litter $litter)
    {
        return $user->role->can_edit_frozen;
    }

    /**
     * Auxiliaries
     */
    protected function isCreator(IdentityInterface $user, Litter $litter)
    {
        return $litter->owner_user_id == $user->getIdentifier();
    }

    // contributors are owners of contributing ratteries and owners of parents
    protected function isContributor(IdentityInterface $user, Litter $litter)
    {
        $contributions = $litter->contributions;
        foreach ($contributions as $contribution) {
            $owner_id = $contribution->rattery->owner_user_id;
            if ($owner_id == $user->getIdentifier()) {
                return true;
            }
        }

        if ($litter->sire[0]->owner_user_id == $user->getIdentifier()
            || $litter->dam[0]->owner_user_id == $user->getIdentifier())
        {
            return true;
        }

        return false;
    }
}
