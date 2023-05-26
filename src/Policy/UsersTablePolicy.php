<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\UsersTable;
use Authorization\IdentityInterface;

/**
 * Users policy
 */
class UsersTablePolicy
{
    /**
     * Check if $user can see lists of users
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Table\UsersTable $users The users table.
     * @return bool
     */
    public function canIndex(IdentityInterface $user, UsersTable $users)
    {
        return $user->role->can_access_personal;
    }
}
