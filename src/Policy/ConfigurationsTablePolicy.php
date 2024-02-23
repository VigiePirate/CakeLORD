<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\Table;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Contributions policy
 */
class ConfigurationsTablePolicy implements BeforePolicyInterface
{
    /**
     * Open all for admin
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Table\ContributionsTable $resource
     * @param ?? $action
     * @return bool
     */
    public function before($user, $resource, $action)
    {
        if ($user->getOriginalData()->is_root) {
            return true;
        };
    }

    /**
     * Check if $user can see complete list of articles, categories or FAQs
     *
     * @param Authorization\IdentityInterface $user The user.
     * @return bool
     */
    public function canIndex(IdentityInterface $user)
    {
        return $user->role->can_configure;
    }
}
