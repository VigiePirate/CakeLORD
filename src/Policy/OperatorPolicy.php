<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Operator;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Operator policy
 */
class OperatorPolicy implements BeforePolicyInterface
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
     * Check if $user can add Operator
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Operator $operator
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Operator $operator)
    {
    }

    /**
     * Check if $user can edit Operator
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Operator $operator
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Operator $operator)
    {
    }

    /**
     * Check if $user can delete Operator
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Operator $operator
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Operator $operator)
    {
    }

    /**
     * Check if $user can view Operator
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Operator $operator
     * @return bool
     */
    public function canView(IdentityInterface $user, Operator $operator)
    {
    }
}
