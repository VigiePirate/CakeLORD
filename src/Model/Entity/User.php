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
 * @property string|null $password
 * @property string|null $sex
 * @property string|null $name_first
 * @property string|null $name_last
 * @property string|null $login
 * @property \Cake\I18n\FrozenDate|null $date_birth
 * @property bool|null $newsletter
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $role_id
 * @property bool|null $is_locked
 * @property int|null $failed_login_attempts
 *
 * @property \App\Model\Entity\Role $role
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
        'sex' => true,
        'name_first' => true,
        'name_last' => true,
        'login' => true,
        'date_birth' => true,
        'newsletter' => true,
        'created' => true,
        'modified' => true,
        'role_id' => true,
        'is_locked' => true,
        'failed_login_attempts' => true,
        'role' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    protected function _setPassword(string $password) : ?string
    {
      if (strlen($password) > 0) {
         return (new DefaultPasswordHasher())->hash($password);
      }
    }
}
