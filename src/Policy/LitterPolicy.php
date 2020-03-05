<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Litter;
use Authorization\IdentityInterface;

/**
 * Litter policy
 */
class LitterPolicy
{
    /**
     * Check if $user can create Litter
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Litter $litter
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Litter $litter)
    {
    }

    /**
     * Check if $user can update Litter
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Litter $litter
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Litter $litter)
    {
    }

    /**
     * Check if $user can delete Litter
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Litter $litter
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Litter $litter)
    {
    }

    /**
     * Check if $user can view Litter
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Litter $litter
     * @return bool
     */
    public function canView(IdentityInterface $user, Litter $litter)
    {
    }
}
