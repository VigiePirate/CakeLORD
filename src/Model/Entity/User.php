<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string|null $sex
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string $username
 * @property \Cake\I18n\FrozenDate|null $birth_date
 * @property bool $wants_newsletter
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $role_id
 * @property bool $is_locked
 * @property int $failed_login_attempts
 * @property \Cake\I18n\FrozenTime $failed_login_last_date
 * @property string $about_me
 * @property string $staff_comments
 * @property string $avatar
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Rattery[] $ratteries
 * @property \App\Model\Entity\Rat[] $owned_rats
 * @property \App\Model\Entity\Rat[] $created_rats
 * @property \App\Model\Entity\Message[] $messages
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
        'sex' => true,
        'firstname' => true,
        'lastname' => true,
        'username' => true,
        'birth_date' => true,
        'wants_newsletter' => true,
        'created' => true,
        'modified' => true,
        'role_id' => true,
        'is_locked' => true,
        'failed_login_attempts' => true,
        'failed_login_last_date' => true,
        'about_me' => true,
        'staff_comments' => true,
        'avatar' => true,
        'role' => true,
        'ratteries' => true,
        'owned_rats' => true,
        'created_rats' => true,
        'messages' => true,
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
}
