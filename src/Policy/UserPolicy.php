<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * User policy
 */
class UserPolicy implements BeforePolicyInterface
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
     * Check if $user can see its home
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canHome(IdentityInterface $user, User $resource)
    {
        // Can see self home
        return $user->get('id') === $resource->get('id');
    }

    /**
     * Check if $user can add User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canAdd(IdentityInterface $user, User $resource)
    {
        // User can't add new users
        return false;
    }

    /**
     * Check if $user can update User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, User $resource)
    {
        return $this->isSelf($user, $resource) || $user->role->can_edit_others;
    }

    public function canMy(IdentityInterface $user, User $resource)
    {
        return $this->isSelf($user, $resource);
    }

    /**
     * Check if $user can delete User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, User $resource)
    {
        // User can't delete users
        return $user->role->can_delete;
    }

    /**
     * Check if $user can view User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, User $resource)
    {
        // User can view users
        return true;
    }

    /**
     * Check if $user can see private sheet part about User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canSeePrivate(IdentityInterface $user, User $resource)
    {
        return $this->isSelf($user, $resource) || $user->role->is_staff;
    }

    /**
     * Check if $user can see confidential comment about User
     * DO NOT AUTHORIZE User!!
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canSeeStaffOnly(IdentityInterface $user, User $resource)
    {
        return $user->role->is_staff;
    }

    /**
     * Check if $user can access personal info about User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canAccessPersonal(IdentityInterface $user, User $resource)
    {
        return $this->isSelf($user, $resource) || $user->role->can_access_personal;
    }

    /**
     * Check if $user can lock or unlock a User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canLock(IdentityInterface $user, User $resource)
    {
        return $user->role->is_staff;
    }

    /**
     * Check if $user can change avatar of the User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canChangePicture(IdentityInterface $user, User $resource)
    {
        return $this->isSelf($user, $resource) || $user->role->can_edit_others;
    }

    /**
     * Check if $user can change newsletter settings of the User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canSwitchNewsletter(IdentityInterface $user, User $resource)
    {
        return $this->isSelf($user, $resource) || $user->role->can_edit_others;
    }

    /**
     * Check if $user can change the role of the User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canPromote(IdentityInterface $user, User $resource)
    {
        return $user->role->can_configure;
    }

    /**
     * Check if $user can change the role of the User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canChangeEmail(IdentityInterface $user, User $resource)
    {
        return $this->isSelf($user, $resource) || $user->role->can_edit_others;
    }


    /**
     * Auxiliaries
     */
    protected function isSelf(IdentityInterface $user,  User $resource)
    {
        return $resource->id == $user->getIdentifier();
    }
}
