<?php
declare(strict_types=1);

namespace App\Policy;

use Authorization\IdentityInterface;
use Cake\Datasource\EntityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Message policy
 */
class MessagePolicy implements BeforePolicyInterface
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
     * Check if $user can edit Message
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param Cake\Datasource\EntityInterface $entity the entity
     * @return bool
     */
    public function canEdit(IdentityInterface $user, EntityInterface $entity)
    {
        return $user->role->is_staff;
    }

    /**
     * Check if $user can delete Message
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param Cake\Datasource\EntityInterface $entity the entity
     * @return bool
     */
    public function canDelete(IdentityInterface $user, EntityInterface $entity)
    {
        return $user->role->can_delete;
    }

    /**
     * Check if $user can view Message
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param Cake\Datasource\EntityInterface $entity the entity
     * @return bool
     */
    public function canView(IdentityInterface $user, EntityInterface $entity)
    {
        return $user->role->is_staff;
    }
}
