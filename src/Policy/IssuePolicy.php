<?php
declare(strict_types=1);

namespace App\Policy;
use Authorization\IdentityInterface;
use App\Model\Entity\Issue;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Issue policy
 */
class IssuePolicy implements BeforePolicyInterface
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
     * Check if $user can see entity
     *
     * @param Authorization\IdentityInterface $user The user.
     * @return bool
     */
    public function canIndex(IdentityInterface $user, Issue $issue)
    {
        return true;
    }

    /**
     * Check if $user can see entity
     *
     * @param Authorization\IdentityInterface $user The user.
     * @return bool
     */
    public function canView(IdentityInterface $user, Issue $issue)
    {
        return $issue->from_user_id == $user->id || $user->role->can_edit_others;
    }

    /**
     * Check if $user can add entity
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @return bool
     */
    public function canAdd(IdentityInterface $user)
    {
        return true;
    }

    /**
     * Check if $user can edit entity
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @return bool
     */
    public function canEdit(IdentityInterface $user)
    {
        return $user->role->can_edit_others;
    }

    /**
     * Check if $user can delete entity
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Coat $coat
     * @return bool
     */
    public function canDelete(IdentityInterface $user)
    {
        return $user->role->can_delete;
    }
}
