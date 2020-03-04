<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $username
 * @property string|null $firstname
 * @property string|null $lastname
 * @property \Cake\I18n\FrozenDate|null $birth_date
 * @property string|null $sex
 * @property string|null $localization
 * @property string $avatar
 * @property string|null $about_me
 * @property bool $wants_newsletter
 * @property int $role_id
 * @property int $failed_login_attempts
 * @property \Cake\I18n\FrozenTime|null $failed_login_last_date
 * @property bool $is_locked
 * @property string|null $staff_comments
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Conversation[] $conversations
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'email' => true,
        'password' => true,
        'username' => true,
        'firstname' => true,
        'lastname' => true,
        'birth_date' => true,
        'sex' => true,
        'localization' => true,
        'avatar' => true,
        'about_me' => true,
        'wants_newsletter' => true,
        'role_id' => true,
        'failed_login_attempts' => true,
        'failed_login_last_date' => true,
        'is_locked' => true,
        'staff_comments' => true,
        'created' => true,
        'modified' => true,
        'role' => true,
        'conversations' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    /**
     * Hash passwords with bcrypt.
     *
     */
    protected function _setPassword(string $password) : ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }

    /**
     * We create those fields based upon the numeric value of the role_id field
     * as it enables simple comparisons. The Roles Table is more of a reminder
     * as we don't expect roles to change much.
     *
     * @return bool
     */
    protected function _getIsRoot()
    {
        return $this->role_id === 1;
    }

    protected function _getIsAdmin()
    {
        return $this->role_id <= 2;
    }

    protected function _getIsStaff()
    {
        return $this->role_id <= 3;
    }

}
