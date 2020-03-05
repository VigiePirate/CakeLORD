<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Rattery;
use Authorization\IdentityInterface;

/**
 * Rattery policy
 */
class RatteryPolicy
{
    /**
     * Check if $user can create Rattery
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rattery $rattery
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Rattery $rattery)
    {
    }

    /**
     * Check if $user can update Rattery
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rattery $rattery
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Rattery $rattery)
    {
    }

    /**
     * Check if $user can delete Rattery
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rattery $rattery
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Rattery $rattery)
    {
    }

    /**
     * Check if $user can view Rattery
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Rattery $rattery
     * @return bool
     */
    public function canView(IdentityInterface $user, Rattery $rattery)
    {
    }
}
