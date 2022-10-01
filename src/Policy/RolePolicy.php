<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Role;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Role policy
 */
class RolePolicy
{
    /**
     * Open all for admin
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @param ?? $action
     * @return bool
     */
     public function before($user, $resource, $action)
     {
         if ($user->getOriginalData()->is_root || $user->getOriginalData()->is_staff) {
             return true;
         };
     }

     /**
      * Check if $user can create Role
      *
      * @param Authorization\IdentityInterface $user The user.
      * @param App\Model\Entity\Role $role
      * @return bool
      */
     public function canConfigure(IdentityInterface $user, Role $role)
     {
         return $user->can_configure;
     }
