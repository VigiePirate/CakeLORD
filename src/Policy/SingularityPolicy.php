<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Singularity;
use Authorization\IdentityInterface;

/**
 * Singularity policy
 */
class SingularityPolicy
{
    /**
     * Check if $user can create Singularity
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Singularity $singularity
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Singularity $singularity)
    {
    }

    /**
     * Check if $user can update Singularity
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Singularity $singularity
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Singularity $singularity)
    {
    }

    /**
     * Check if $user can delete Singularity
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Singularity $singularity
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Singularity $singularity)
    {
    }

    /**
     * Check if $user can view Singularity
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Singularity $singularity
     * @return bool
     */
    public function canView(IdentityInterface $user, Singularity $singularity)
    {
    }
}
