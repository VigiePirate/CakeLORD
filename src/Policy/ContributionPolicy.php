<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Contribution;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Contribution policy
 */
class ContributionPolicy implements BeforePolicyInterface
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
     * Check if $user can add Contribution
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Contribution $contribution
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Contribution $contribution)
    {
        return true;
    }

    /**
     * Check if $user can edit Contribution
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Contribution $contribution
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Contribution $contribution)
    {
        return $user->role->can_edit_others
            ||$user->getIdentifier() === $contribution->litter->creator_user_id;
    }

    /**
     * Check if $user can delete Contribution
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Contribution $contribution
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Contribution $contribution)
    {
        return $user->role->can_delete;
    }

    /**
     * Check if $user can view Contribution
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Contribution $contribution
     * @return bool
     */
    public function canView(IdentityInterface $user, Contribution $contribution)
    {
        return $user->role->is_staff;
    }
}
