<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Singularities;
use Authorization\IdentityInterface;

/**
 * Singularities policy
 */
class SingularitiesPolicy
{
    /**
     * Check if $user can create Singularities
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Singularities $singularities
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Singularities $singularities)
    {
    }

    /**
     * Check if $user can update Singularities
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Singularities $singularities
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Singularities $singularities)
    {
    }

    /**
     * Check if $user can delete Singularities
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Singularities $singularities
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Singularities $singularities)
    {
    }

    /**
     * Check if $user can view Singularities
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Singularities $singularities
     * @return bool
     */
    public function canView(IdentityInterface $user, Singularities $singularities)
    {
    }
}
