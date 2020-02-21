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
    public function canAdd(IdentityInterface $user, Singularity $singularity)
    {
      // All logged in users can create articles.
        return true;
    }

    /**
     * Check if $user can update Singularity
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Singularity $singularity
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Singularity $singularity)
    {
      // logged in users can edit their own articles.
        return $this->isAuthor($user, $article);
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
      // logged in users can delete their own articles.
        return $this->isAuthor($user, $article);
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
      // All logged in users can create articles.
        return true;
    }

    protected function isAuthor(IdentityInterface $user, Article $article)
    {
        return $article->user_id === $user->getIdentifier();
    }
}
