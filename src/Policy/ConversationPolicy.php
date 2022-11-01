<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Conversation;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Conversation policy
 */
class ConversationPolicy implements BeforePolicyInterface
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
     * Check if $user can add Conversation
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Conversation $conversation
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Conversation $conversation)
    {
    }

    /**
     * Check if $user can edit Conversation
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Conversation $conversation
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Conversation $conversation)
    {
    }

    /**
     * Check if $user can delete Conversation
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Conversation $conversation
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Conversation $conversation)
    {
    }

    /**
     * Check if $user can view Conversation
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Conversation $conversation
     * @return bool
     */
    public function canView(IdentityInterface $user, Conversation $conversation)
    {
    }
}
