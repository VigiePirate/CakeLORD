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
 * @property string|null $locale
 * @property string|null $localization
 * @property string $avatar
 * @property string|null $about_me
 * @property bool $wants_newsletter
 * @property int $role_id
 * @property int $failed_login_attempts
 * @property \Cake\I18n\FrozenTime|null $failed_login_last_date
 * @property \Cake\I18n\FrozenTime|null $successful_login_last_date
 * @property \Cake\I18n\FrozenTime|null $successful_login_previous_date
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
        'locale' => true,
        'localization' => true,
        'avatar' => true,
        'about_me' => true,
        'wants_newsletter' => true,
        'role_id' => true,
        'failed_login_attempts' => true,
        'failed_login_last_date' => true,
        'successful_login_last_date' => true,
        'successful_login_previous_date' => true,
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
    public function getRoleId()
    {
        return $this->role_id;
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
        $ratteries = new Collection($this->ratteries);
        $alive = $ratteries->match(['is_alive' => true]);

        if (! $alive->isEmpty()) {
            return $alive->max('created');
        } else {
            return $ratteries->max('created');
        }
    }

    protected function _getMainRatteryName()
    {
        $rattery = $this->main_rattery;
        if (! empty($rattery)) {
            return $rattery->full_name;
        }
    }

    public function _getDashboardTitle()
    {
        $vowels = ['a', 'à', 'e', 'è', 'é', 'ê', 'ë', 'i', 'î', 'ï', 'o', 'ô', 'u', 'ù', 'y', 'ÿ',
                    'A', 'À', 'E', 'È', 'É' ,'Ê', 'Ë', 'I', 'Î', 'Ï', 'O', 'Ô', 'U', 'Û', 'Ü', 'Y'];

        if (in_array(substr($this->username, 0, 1), $vowels)) {
            return __x('élision', '{0}’s dashboard', [$this->username]);
        }

        if (in_array(substr($this->username, 0, 3), ['le ', 'Le '])) {
            return __x('contraction (du)', '{0}’s dashboard', [substr($this->username, 3)]);
        }

        if (in_array(substr($this->username, 0, 4), ['les ', 'Les '])) {
            return __x('contraction (des)', '{0}’s dashboard', [substr($this->username, 4)]);
        }

        return __x('pas de flexion', '{0}’s dashboard', [$this->username]);

    }

    public function _getWelcomeString()
    {
        if (
            ! empty($this->birth_date)
            && $this->birth_date->month == FrozenTime::now()->month
            && $this->birth_date->day == FrozenTime::now()->day
        ) {
            return '<b>' . __('Happy birthday to you!') . '</b>';
        }

        if ($this->created->modify('-1 day')->wasWithinLast('1 month')) {
            $rookie = __(
                'Recent member? Need for a guided tour? Read our <b><a href="{0}"> ▶ LORD STARTER KIT ◀</a></b>',
                [\Cake\Routing\Router::Url(['controller' => 'Articles', 'action' => 'view', 1])]
            );
            return $rookie;
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
        // don't show to rookies (for better visibility of the starter kit link)
        if ($this->created->wasWithinLast('1 month')) {
            return '';
        }

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
        return ($this->is_locked ? '✗' : '');
    }

    protected function _getSexString()
    {
        if ($this->sex == 'F') {
            return  __x('grammar', 'Feminine');
        }

        if ($this->sex == 'M') {
            return  __x('grammar', 'Masculine');
        }

        if ($this->sex == '') {
            return  __x('grammar', 'Custom');
        }
    }

}
