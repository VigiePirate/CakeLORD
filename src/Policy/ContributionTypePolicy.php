<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\ContributionType;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * ContributionType policy
 */
class ContributionTypePolicy implements BeforePolicyInterface
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
     * Check if $user can add ContributionType
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\ContributionType $contributionType
     * @return bool
     */
    public function canAdd(IdentityInterface $user, ContributionType $contributionType)
    {
    }

    /**
     * Check if $user can edit ContributionType
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\ContributionType $contributionType
     * @return bool
     */
    public function canEdit(IdentityInterface $user, ContributionType $contributionType)
    {
    }

    /**
     * Check if $user can delete ContributionType
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\ContributionType $contributionType
     * @return bool
     */
    public function canDelete(IdentityInterface $user, ContributionType $contributionType)
    {
    }

    /**
     * Check if $user can view ContributionType
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\ContributionType $contributionType
     * @return bool
     */
    public function canView(IdentityInterface $user, ContributionType $contributionType)
    {
    }
}
