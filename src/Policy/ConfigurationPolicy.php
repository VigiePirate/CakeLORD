<?php
declare(strict_types=1);

namespace App\Policy;
use Authorization\IdentityInterface;
use Cake\Datasource\EntityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Configuration policy (roles, states...)
 */
class ConfigurationPolicy implements BeforePolicyInterface
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
    public function canView(IdentityInterface $user, EntityInterface $entity)
    {
        return true;
    }

    /**
     * Check if $user can add entity
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @return bool
     */
    public function canAdd(IdentityInterface $user, EntityInterface $entity)
    {
        return $user->role->can_configure;
    }

    /**
     * Check if $user can edit entity
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @return bool
     */
    public function canEdit(IdentityInterface $user, EntityInterface $entity)
    {
        return $user->role->is_staff;
    }

    /**
     * Check if $user can delete entity
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Coat $coat
     * @return bool
     */
    public function canDelete(IdentityInterface $user, EntityInterface $entity)
    {
        return $user->role->can_delete;
    }

     /**
      * Check if $user can create Role
      *
      * @param Authorization\IdentityInterface $user The user.
      * @param App\Model\Entity\Role $role
      * @return bool
      */
     public function canConfigure(IdentityInterface $user, EntityInterface $entity)
     {
         return $user->role->can_configure;
     }

     /**
      * Check if $user can act on State
      *
      * @param \Authorization\IdentityInterface $user The user.
      * @param \App\Model\Entity\State $state
      * @return bool
      */
     public function canAct(IdentityInterface $user, EntityInterface $entity)
     {
         return $user->getOriginalData()->can_change_state;
     }

}
