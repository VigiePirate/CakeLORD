<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Message;
use Authorization\IdentityInterface;
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
     * Check if $user can add Message
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Message $message
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Message $message)
    {
    }

    /**
     * Check if $user can edit Message
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Message $message
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Message $message)
    {
    }

    /**
     * Check if $user can delete Message
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Message $message
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Message $message)
    {
    }

    /**
     * Check if $user can view Message
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Message $message
     * @return bool
     */
    public function canView(IdentityInterface $user, Message $message)
    {
    }
}
