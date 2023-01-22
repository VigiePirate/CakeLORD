<?php
declare(strict_types=1);

namespace App\Policy;
use Authorization\IdentityInterface;
use Cake\Datasource\EntityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Description policy (umbrella for physical traits, death causes, countries, etc.)
 */
class DescriptionPolicy implements BeforePolicyInterface
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
     * @param Cake\Datasource\EntityInterface $entity the entity
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
    public function canAdd(IdentityInterface $user)
    {
        return $user->role->can_document;
    }

    /**
     * Check if $user can edit entity
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @return bool
     */
    public function canEdit(IdentityInterface $user)
    {
        return $user->role->can_document;
    }

    /**
     * Check if $user can delete entity
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @return bool
     */
    public function canDelete(IdentityInterface $user)
    {
        return $user->role->can_delete;
    }
}
