<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\Table;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Documentations policy
 */
class MessagesTablePolicy implements BeforePolicyInterface
{
    /**
     * Open all for admin
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Issue $resource
     * @param ?? $action
     * @return bool
     */
    public function before($user, $resource, $action)
    {
        if (! is_null($user) && $user->getOriginalData()->is_root) {
            return true;
        };
    }

    // from IssuesTablePolicy for inspiration
    // public function scopeIndex($user, $query)
    // {
    //     if ($user->role->can_edit_others) {
    //         return $query;
    //     } else {
    //         return $query->where(['from_user_id' => $user->getIdentifier()]);
    //     }
    // }

    /**
     * Check if $user can see complete list of descriptions
     *
     * @param Authorization\IdentityInterface $user The user.
     * @return bool
     */
    public function canIndex(IdentityInterface $user)
    {
        return true;
    }

    public function canAdd(IdentityInterface $user)
    {
        return true;
    }
}
