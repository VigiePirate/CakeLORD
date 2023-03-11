<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Authentication\IdentityInterface;
use Cake\ORM\Entity;
use Cake\Collection\Collection;
use Cake\Datasource\FactoryLocator;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use App\Model\Entity\StatisticsTrait;

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
 * @property string|null $passkey
 * @property string|null $staff_comments
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Conversation[] $conversations
 */
class User extends Entity implements IdentityInterface
{
    use StatisticsTrait;

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
        'passkey' => false,
        'staff_comments' => true,
        'created' => true,
        'modified' => true,
        'role' => true,
        'conversations' => true,
    ];

    /**
     * Authentication\IdentityInterface method
     */
    public function getIdentifier()
    {
        return $this->id;
    }

    /**
     * Authentication\IdentityInterface method
     */
    public function getOriginalData()
    {
        return $this;
    }

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
        'passkey',
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
     * Shortcuts to role properties when Roles was not contained at user hydration
     * @return bool
     */
    protected function _getIsRoot()
    {
        if (! isset($this->role)) {
            $roles = \Cake\Datasource\FactoryLocator::get('Table')->get('Roles');
            $this->role = $roles->get($this->role_id);
        }
        return $this->role->is_root;
    }

    protected function _getIsAdmin()
    {
        if (! isset($this->role)) {
            $roles = \Cake\Datasource\FactoryLocator::get('Table')->get('Roles');
            $this->role = $roles->get($this->role_id);
        }
        return $this->role->is_admin;
    }

    protected function _getIsStaff()
    {
        if (! isset($this->role)) {
            $roles = \Cake\Datasource\FactoryLocator::get('Table')->get('Roles');
            $this->role = $roles->get($this->role_id);
        }
        return $this->role->is_staff;
    }

    protected function _getCanChangeState()
    {
        if (! isset($this->role)) {
            $roles = \Cake\Datasource\FactoryLocator::get('Table')->get('Roles');
            $this->role = $roles->get($this->role_id);
        }
        return $this->role->can_change_state;
    }

    protected function _getCanConfigure()
    {
        if (! isset($this->role)) {
            $roles = \Cake\Datasource\FactoryLocator::get('Table')->get('Roles');
            $this->role = $roles->get($this->role_id);
        }
        return $this->role->can_configure;
    }

    // if user has 1 rattery, return its name even if it is not active
    // if user has more than 1 rattery, return the active one, or the latest one if none is active
    protected function _getMainRattery()
    {
        $rattery_count = $this->countMy('ratteries', 'owner_user');

        if ($rattery_count == 1) {
            return $this->ratteries[0];
        }

        if ($rattery_count > 1) {
            foreach ($this->ratteries as $rattery) {
                if ($rattery->is_alive) {
                    return $rattery;
                }
            }
            // FIXME: should be based on last litter date, not on index
            return end($this->ratteries);
        }
    }

    protected function _getMainRatteryName()
    {
        $rattery = $this->main_rattery;
        if (! empty($rattery)) {
            return h($rattery->full_name);
        }
    }

    public function _getWelcomeString()
    {
        if (
            ! empty($this->birth_date)
            && $this->birth_date->month == FrozenTime::now()->month
            && $this->birth_date->day == FrozenTime::now()->day
        ) {
            return '<b>' . __('Happy birthday to you!') . '</b>';
        } else {
            return '';
        }
    }

    protected function _getRatBirthdayString()
    {
        $today = FrozenTime::now();

        $model = FactoryLocator::get('Table')->get('Rats');
        $query = $model
            ->find()
            ->where([
                'Rats.owner_user_id' => $this->id,
                'is_alive' => true,
                'DAY(Rats.birth_date) ' => $today->day,
                'MONTH(Rats.birth_date) ' => $today->month,
                ])
            ->all();

        $rats = new Collection($query);

        if (! $rats->isEmpty()) {
            $str = $rats->reduce(function ($string, $rats) {
                return $string . $rats->name . ', ';
                },
            '');
            return $str =  __('Happy birthday to ') . trim($str, ', ') . '!';
        } else {
            return '';
        }
    }

    protected function _getComingBirthdayString()
    {
        $model = FactoryLocator::get('Table')->get('Rats');
        $query = $model->find()->where(['Rats.owner_user_id' => $this->id, 'is_alive' => true])->all();
        $rats = new Collection($query);
        $today = FrozenTime::now();

        if ($rats->isEmpty()) {
            return __('You don’t have any rat. Time for adoption?');
        } else {
            $rats = $rats
                ->sortBy('next_birthday', SORT_ASC)
                ->stopWhen(function ($rat) {
                    return ! $rat->next_birthday->isWithinNext('3 months');
                })
                ->take(100);

            $str = $rats->reduce(function ($string, $rats) {
                return $string . $rats->name . ' (' . $rats->next_birthday->i18nFormat('dd/MM') . ')' . ', ';
                },
            '');
            return empty($str) ? __('No rat birthday coming soon') : __('Rat birthdays coming soon: ') . trim($str, ', ');
        }
    }

    protected function _getLockedSymbol()
    {
        return ($this->is_locked ? '✗' : '✓');
    }

}
