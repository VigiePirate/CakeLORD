<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\UsersTable;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Users policy
 */
class UsersTablePolicy implements BeforePolicyInterface
{
    /**
     * Open all for admin
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Table\UsersTable $resource
     * @param ?? $action
     * @return bool
     */
    public function before($user, $resource, $action)
    {
        if ($user->getOriginalData()->is_root) {
            return true;
        };
    }

    /**
     * Check if $user can see lists of users
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Table\UsersTable $users The users table.
     * @return bool
     */
    public function canIndex(IdentityInterface $user, UsersTable $users)
    {
        return true;
    }

    /**
     * Check if $user can see lists of users with personal information
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Table\UsersTable $users The users table.
     * @return bool
     */
    public function canPrivate(IdentityInterface $user, UsersTable $users)
    {
        return $user->role->can_access_personal;
    }
}
