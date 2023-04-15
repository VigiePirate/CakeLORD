<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Routing\Router;
use Cake\Mailer\Mailer;
use Cake\Mailer\MailerAwareTrait;
use Cake\Chronos\Chronos;
use Cake\Utility\Inflector;
use Cake\Collection\Collection;

/**
* Users Controller
*
* @property \App\Model\Table\UsersTable $Users
*
* @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
*/
class UsersController extends AppController
{

    use MailerAwareTrait;

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions([
            'login',
            'register',
            'activate',
            'lostPassword',
            'resetPassword',
            'confirmEmail',
            'autocomplete'
        ]);
    }

    public function login() {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['get', 'post']);

        // check first if user is blocked or too many failed attempts
        if ($this->request->is('post')) {
            $query = $this->Users->findByEmail($this->request->getData('email'));
            $user = $query->first();
            if (!empty($user)) {
                if ($user->is_locked) {
                    $this->Authentication->logout();
                    return $this->Flash->error(__('Your account is locked, please activate it or contact an administrator.'));
                } else {
                    if ($user->failed_login_attempts > 5 && $user->failed_login_last_date->wasWithinLast('15 minutes')) {
                        $user->failed_login_last_date = Chronos::now();
                        return $this->Flash->error(__('You have failed too many times to log in recently. Please wait 15 minutes before retry.'));
                    }
                }
            }
        }

        $result = $this->Authentication->getResult();

        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $authService = $this->Authentication->getAuthenticationService();

            // get user
            $user = $this->Users->get($this->Authentication->getIdentityData('id'), ['contain' => 'Roles']);

            // update last login fields
            $user->successful_login_last_date = Chronos::now();
            $user->failed_login_attempts = 0;
            $user->failed_login_last_date = null;

            // check if password needs a rehash
            if ($authService->identifiers()->get('Password')->needsPasswordRehash()) {
                // Rehash happens on save.
                $user->password = $this->request->getData('password');
                $this->Users->save($user);
                $this->Flash->set(__('Your password has been rehashed.'));
            } else { // just save user for last login updates
                $this->Users->save($user);
            }

            $this->loadModel('Rats');

            // check user role: if staff, execute routines (zombie killing, rattery closing, etc.)
            if ($user->role->is_staff) {

                $rat_count = $this->Rats->killZombies();

                $this->loadModel('Ratteries');
                $rattery_count = $this->Ratteries->pauseZombies();

                if ($rat_count > 0) {
                    $this->Flash->success($rat_count . __(' rats who were too old have just been automatically set as presumably dead.'));
                }

                if ($rattery_count > 0) {
                    $this->Flash->success($rattery_count . __(' ratteries which had no litter for a long time have just been automatically set as inactive.'));
                }

                // blame sheets in needs_user_action state for too long
                $this->loadModel('Litters');
                $neglected_count = $this->Rats->blameNeglected($this->Rats)
                    + $this->Ratteries->blameNeglected($this->Ratteries)
                    + $this->Litters->blameNeglected($this->Litters);
                if ($neglected_count > 0) {
                    $this->Flash->warning($neglected_count . __(' sheets neglected by users have just been escalated to back-office.'));
                }

                // delete old unused passkeys and accounts never activated
                $this->Users->removeExpiredPasskeys();

                $action_needed = (
                    $this->Rats->find('needsUser')->where(['owner_user_id' => $user->id])->count()
                    + $this->Ratteries->find('needsUser')->where(['owner_user_id' => $user->id])->count()
                    + $this->Litters->find('needsUser')->where(['creator_user_id' => $user->id])->count()
                );
                if ($action_needed > 0) {
                    $this->Flash->error(__('You have {0} sheets to correct! Please, check rats, litters and ratteries from your dashboard and take action soon.', $action_needed));
                }
            }

            $target = $this->Authentication->getLoginRedirect();
            if (! $target) {
                $target = [
                    'controller' => 'Users',
                    'action' => 'home',
                ];
            }

            return $this->redirect($target);
        }

        // display error if user submitted and authentication failed
        if ( $this->request->is('post') && !$result->isValid() ) {
            $this->Flash->error(__('Invalid username or password'));
            // $this->log($result->getStatus());

            // if user exists but invalid password, update failed login fields
            $query = $this->Users->findByEmail($this->request->getData('email'));
            $user = $query->first();
            if (!empty($user)) {
                ++$user->failed_login_attempts;
                $user->failed_login_last_date = Chronos::now();
                $this->Users->save($user);
            }
        }
    }

    public function logout()
    {
        $this->Authorization->skipAuthorization();
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            return $this->redirect($this->Authentication->logout());
        }
    }

    /**
     * Registration methods
     *
     **/

    public function register()
    {
        $this->Authorization->skipAuthorization();

        // regardless of anything, redirect if user is logged in
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Flash->error('You already have an account, on which you are logged in.');
            return $this->redirect(['controller' => 'users', 'action' => 'my']);
        }

        if ($this->request->is('post')) {

            // check captcha
            //FIXME: place captcha question/answer in app local config
            $user = $this->Users->newEmptyEntity();
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if (strtolower($this->request->getData('captcha')) == 'rat' || strtolower($this->request->getData('captcha')) == 'rats') {
                $passkey = uniqid('', true);
                $user->passkey = $passkey;
                $user->is_locked = true;
                $user->failed_login_last_date = Chronos::now();
                $user->failed_login_attempts = 1;

                if ($this->Users->save($user)) {
                    $url = Router::Url(['controller' => 'users', 'action' => 'activate'], true) . '/' . $passkey;
                    $mailer = $this->getMailer('User')->send('sendActivationEmail', [$url, $user]);
                    if ($mailer) {
                        $this->Flash->success(__('Your account has been created, but must be activated before you can log in. Check your email for your activation link.'));
                    } else {
                        $this->set(compact('user'));
                        $this->Flash->error(__('Error sending email! Please contact an administrator.')); // . $email->smtpError);
                    }
                    return $this->redirect(['action' => 'login']);
                } else {
                    $this->set(compact('user'));
                    $this->Flash->error(__('Something went wrong. Please, try again or contact an administrator.'));
                    // return $this->redirect(['action' => 'register']);
                }
            } else {
                $this->set(compact('user'));
                $this->Flash->error(__('This was not the expected answer! Please, retry if you are not a Replicant.'));
            }
        }
    }

    public function activate($passkey = null)
    {
        $this->Authorization->skipAuthorization();

        if (empty($passkey)) {
            $this->Flash->error('Invalid activation link. Please check your email or try again');
            return $this->redirect(['action' => 'register']);
        } else {
            $query = $this->Users->findByPasskey($passkey);
            $user = $query->first();

            if (empty($user)) {
                $this->Flash->error('Invalid activation link. Please check your email or try again');
                return $this->redirect(['action' => 'register']);
            } else {
                // check if activation link is expired; if so, delete account
                if (!$user->failed_login_last_date->wasWithinLast('24 hours')) {
                    $this->Users->delete($user);
                    $this->Flash->error('Expired activation link. Your account has been deleted. Please, register again and check your email right away.');
                    return $this->redirect(['action' => 'register']);
                } else {
                    // activate
                    $user->is_locked = 0;
                    $user->passkey = null;
                    $user->failed_login_attempts = 0;
                    $user->failed_login_last_date = null;
                    if($this->Users->save($user)) {
                        $this->Flash->success('Your account has been activated. You can now log in and complete your profile. Welcome on LORD!');
                        return $this->redirect(['action' => 'login']);
                    } else {
                        return $this->Flash->error(__('Something went wrong. Please, try again or contact an administrator.'));
                    }
                }
            }
        }
    }

    /**
     * Home method
     *
     * @param null
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function home()
    {
        $user = $this->Users->get($this->Authentication->getIdentity()->get('id'), [
            'contain' => ['Roles', 'Conversations'],
        ]);
        $this->Authorization->authorize($user);

        $rat_count = $user->countRats(['owner_user_id' => $user->id]);
        $female_count = $user->countRats(['owner_user_id' => $user->id, 'sex' => 'F']);
        $male_count = $user->countRats(['owner_user_id' => $user->id, 'sex' => 'M']);
        $alive_rat_count = $user->countRats(['owner_user_id' => $user->id, 'is_alive' => true]);
        $alive_female_count = $user->countRats(['owner_user_id' => $user->id, 'is_alive' => true, 'sex' => 'F']);
        $alive_male_count = $user->countRats(['owner_user_id' => $user->id, 'is_alive' => true, 'sex' => 'M']);
        $managed_rat_count = $user->countRats(['creator_user_id' => $user->id, 'owner_user_id !=' => $user->id]);
        $alive_managed_rat_count = $user->countRats(['creator_user_id' => $user->id, 'owner_user_id !=' => $user->id, 'is_alive' => true]);

        $avg_lifespan = $user->roundLifespan(['owner_user_id' => $user->id]);
        $female_avg_lifespan = $user->roundLifespan(['owner_user_id' => $user->id, 'sex' => 'F']);
        $male_avg_lifespan = $user->roundLifespan(['owner_user_id' => $user->id, 'sex' => 'M']);

        $not_infant_lifespan = $user->roundLifespan(['owner_user_id' => $user->id, 'DeathPrimaryCauses.is_infant IS' => false]);
        $not_infant_female_lifespan = $user->roundLifespan(['owner_user_id' => $user->id,'sex' => 'F', 'DeathPrimaryCauses.is_infant IS' => false]);
        $not_infant_male_lifespan = $user->roundLifespan(['owner_user_id' => $user->id,'sex' => 'M', 'DeathPrimaryCauses.is_infant IS' => false]);

        $not_accident_lifespan = $user->roundLifespan(['owner_user_id' => $user->id, 'DeathPrimaryCauses.is_infant IS' => false,'DeathPrimaryCauses.is_accident IS' => false]);
        $not_accident_female_lifespan = $user->roundLifespan(['owner_user_id' => $user->id, 'sex' => 'F', 'DeathPrimaryCauses.is_infant IS' => false,'DeathPrimaryCauses.is_accident IS' => false]);
        $not_accident_male_lifespan = $user->roundLifespan(['owner_user_id' => $user->id, 'sex' => 'M', 'DeathPrimaryCauses.is_infant IS' => false,'DeathPrimaryCauses.is_accident IS' => false]);

        $champion = $user->findChampion(['Rats.owner_user_id' => $user->id]);
        if(!empty($champion)) {
            $champion = $this->loadModel('Rats')->get($champion->id, ['contain' => ['Ratteries','BirthLitters']]);
        }

        $now = \Cake\I18n\FrozenTime::now();
        $today = $now->i18nFormat([\IntlDateFormatter::FULL, \IntlDateFormatter::NONE]);
        $hour = $now->i18nFormat([\IntlDateFormatter::NONE, \IntlDateFormatter::SHORT]);

        $this->set(compact('user', 'today', 'hour',
            'rat_count', 'female_count', 'male_count',
            'alive_rat_count', 'alive_female_count', 'alive_male_count',
            'managed_rat_count', 'alive_managed_rat_count',
            'avg_lifespan','female_avg_lifespan','male_avg_lifespan',
            'not_infant_lifespan', 'not_infant_female_lifespan', 'not_infant_male_lifespan',
            'not_accident_lifespan', 'not_accident_female_lifespan', 'not_accident_male_lifespan',
            'champion'
        ));
    }

    /**
     * My method
     *
     * Detailed sheet of user
     *
     * @param null
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function my()
    {
        $user = $this->Users->get($this->Authentication->getIdentity()->get('id'), [
            'contain' => ['Roles', 'Ratteries'],
        ]);
        $this->Authorization->authorize($user);

        $this->set('user', $user);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $this->paginate = [
            'contain' => ['Roles'],
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [
                'Roles', 'Conversations',
                'Ratteries', 'Ratteries.States','Ratteries.Countries',
                'OwnerRats' => function($q) {
                    return $q
                    ->order('OwnerRats.modified DESC')
                    ->limit(10);
                },
                'OwnerRats.States', 'OwnerRats.DeathPrimaryCauses', 'OwnerRats.DeathSecondaryCauses',
                'OwnerRats.Ratteries', 'OwnerRats.BirthLitters', 'OwnerRats.BirthLitters.Contributions'
            ]
        ]);
        $this->Authorization->authorize($user);

        $rat_count = $user->countRats(['owner_user_id' => $user->id]);
        $female_count = $user->countRats(['owner_user_id' => $user->id, 'sex' => 'F']);
        $male_count = $user->countRats(['owner_user_id' => $user->id, 'sex' => 'M']);
        $alive_rat_count = $user->countRats(['owner_user_id' => $user->id, 'is_alive' => true]);
        $alive_female_count = $user->countRats(['owner_user_id' => $user->id, 'is_alive' => true, 'sex' => 'F']);
        $alive_male_count = $user->countRats(['owner_user_id' => $user->id, 'is_alive' => true, 'sex' => 'M']);
        $managed_rat_count = $user->countRats(['creator_user_id' => $user->id, 'owner_user_id !=' => $user->id]);
        $alive_managed_rat_count = $user->countRats(['creator_user_id' => $user->id, 'owner_user_id !=' => $user->id, 'is_alive' => true]);

        $avg_lifespan = $user->roundLifespan(['owner_user_id' => $user->id]);
        $female_avg_lifespan = $user->roundLifespan(['owner_user_id' => $user->id, 'sex' => 'F']);
        $male_avg_lifespan = $user->roundLifespan(['owner_user_id' => $user->id, 'sex' => 'M']);

        $not_infant_lifespan = $user->roundLifespan(['owner_user_id' => $user->id, 'DeathPrimaryCauses.is_infant IS' => false]);
        $not_infant_female_lifespan = $user->roundLifespan(['owner_user_id' => $user->id,'sex' => 'F', 'DeathPrimaryCauses.is_infant IS' => false]);
        $not_infant_male_lifespan = $user->roundLifespan(['owner_user_id' => $user->id,'sex' => 'M', 'DeathPrimaryCauses.is_infant IS' => false]);

        $not_accident_lifespan = $user->roundLifespan(['owner_user_id' => $user->id, 'DeathPrimaryCauses.is_infant IS' => false,'DeathPrimaryCauses.is_accident IS' => false]);
        $not_accident_female_lifespan = $user->roundLifespan(['owner_user_id' => $user->id, 'sex' => 'F', 'DeathPrimaryCauses.is_infant IS' => false,'DeathPrimaryCauses.is_accident IS' => false]);
        $not_accident_male_lifespan = $user->roundLifespan(['owner_user_id' => $user->id, 'sex' => 'M', 'DeathPrimaryCauses.is_infant IS' => false,'DeathPrimaryCauses.is_accident IS' => false]);

        $champion = $user->findChampion(['Rats.owner_user_id' => $user->id]);
        if(!empty($champion)) {
            $champion = $this->loadModel('Rats')->get($champion->id, ['contain' => ['Ratteries','BirthLitters']]);
        }

        $identity = $this->request->getAttribute('identity');
        $show_staff = ! is_null($identity) && $identity->can('edit', $user);

        $this->set(compact('user',
            'rat_count', 'female_count', 'male_count',
            'alive_rat_count', 'alive_female_count', 'alive_male_count',
            'managed_rat_count', 'alive_managed_rat_count',
            'avg_lifespan','female_avg_lifespan','male_avg_lifespan',
            'not_infant_lifespan', 'not_infant_female_lifespan', 'not_infant_male_lifespan',
            'not_accident_lifespan', 'not_accident_female_lifespan', 'not_accident_male_lifespan',
            'champion', 'identity', 'show_staff'
        ));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $conversations = $this->Users->Conversations->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles', 'conversations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Roles'],
        ]);
        $this->Authorization->authorize($user);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'view', $user->id]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list')->order('id ASC');
        $identity = $this->request->getAttribute('identity');
        $this->set(compact('user', 'roles', 'identity'));
    }

    /**
     * ChangePicture method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changePicture($id = null)
    // this change is authorized to user and staff
    {
        $user = $this->Users->get($id);
        $this->Authorization->authorize($user);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user, ['checkRules' => false])) {
                $this->Flash->success(__('The user’s new avatar has been saved.'));
                return $this->redirect(['action' => 'view', $user->id]);
            }
            $this->Flash->error(__('The user’s new picture could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /* switch newsletter preferences */
    public function switchNewsletter($id = null) {
        $user = $this->Users->get($id);
        $this->Authorization->authorize($user);

        $user->wants_newsletter = ! $user->wants_newsletter;
        if ($this->Users->save($user)) {
            $this->Flash->success('Your newsletter preferences have been updated.');
        } else {
            $this->Flash->error('We could not update your newsletter preferences. Please try again.');
        }
        return $this->redirect(['action' => 'my']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //FIXME: deal with belongsToMany associations if any (there are not at the moment, but...)
        //$belongsToManyAssociations = $this->Users->associations()->getByType('belongsToMany');
        $hasManyAssociations = $this->Users->associations()->getByType('hasMany');
        $associations = $hasManyAssociations;
        $contain = [];
        foreach ($associations as $association) {
            $relatedModel = $association->getTarget();
            $contain[] = $relatedModel->getAlias();
        }
        $user = $this->Users->get($id, ['contain' => $contain]);
        $this->Authorization->authorize($user);

        $count = 0;
        foreach ($associations as $association) {
            $relatedModel = $association->getTarget();
            $count += $this->Users->{$relatedModel->getAlias()}->find()
                ->where([$association->getForeignKey() => $id])
                ->count();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {

            // if user has no related entries, it can be deleted
            if ($count == 0) {
                if ($this->Users->delete($user)) {
                    $this->Flash->success(__('The user has been deleted.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The user could not be deleted. Please, try again.'));
                    return $this->redirect(['action' => 'delete', $user->id]);
                }
            }

            // if user has related entries, they have to be given to a new user before delete
            // NB: we don't check user existence in database, since new_user_id was fetched by ajax
            if ($this->request->getData('new_user_id')) {
                $new_user_id = $this->request->getData('new_user_id');
                $connection = $this->Users->getConnection();
                $connection->begin();

                try {
                     foreach ($associations as $association) {
                        $relatedModel = $association->getTarget();
                        $query = $this->Users->{$relatedModel->getAlias()}->query();
                        $query->update()
                             ->set([$association->getForeignKey() => $new_user_id])
                             ->where([$association->getForeignKey() => $id])
                             ->execute();
                     }
                } catch (Exception $e) {
                    $connection->rollback();
                    $this->Flash->error(__('The user’s associated entries could not be transferred to the new user. Please, try again.'));
                    $this->set(compact('new_user'));
                }

                // reload old user to remove entities which are not his property anymore
                // but still try to contain them as a sanity check!
                $user = $this->Users->get($id, ['contain' => $contain]);

                if ($this->Users->delete($user)) {
                    $connection->commit();
                    $this->Flash->success(__('The user has been deleted. All associated entries were transferred to the user below.'));
                    return $this->redirect(['action' => 'view', $new_user->id]);
                } else {
                    $connection->rollback();
                    $this->Flash->error(__('The user could not be deleted. Please, try again.'));
                    return $this->redirect(['action' => 'delete', $user->id]);
                }

            } else {
                $this->Flash->error(__('The user’s heir could not be found. Please, try again.'));
                return $this->redirect(['action' => 'delete', $user->id]);
            }
        }

        if (! isset($errors)) {
            if ($count != 0) {
                $this->Flash->warning(__('This user is related to existing database entries. You MUST specify below an existing user to inherit these entries.'));
            } else {
                $this->Flash->default(__('This user is not related to any existing database entries and can be safely deleted. Beware, this operation is irreversible!'));
            }
        }

        $identity = $this->request->getAttribute('identity');
        $show_staff = ! is_null($identity) && $identity->can('edit', $user);

        $this->set(compact('user', 'identity', 'count'));
    }

    /**
     *
     * Series of functions to deal with forgotten passwords
     */

    public function lostPassword($email = null)
        // fixme: add check for is_locked account (if locked, do not sent mail)
    {
        $this->Authorization->skipAuthorization();

        // regardless of anything, redirect if user is logged in
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Flash->default('You are logged in, you can change your password directly from here.');
            return $this->redirect(['controller' => 'users', 'action' => 'changePassword']);
        }

        if ($this->request->is('post')) {
            $query = $this->Users->findByEmail($this->request->getData('email'));
            $user = $query->first();
            //$user = $query->firstOrFail();
            if (empty($user)) {
                return $this->Flash->error('Email address does not exist. Please try again');
            } else {

                if ($user->is_locked) {
                    $this->Flash->error('Your account is locked. Please activate it or contact an administrator');
                    return $this->redirect(['action' => 'login']); //FIXME: redirect to a contact form
                }

                $passkey = uniqid('', true);
                $url = Router::Url(['controller' => 'users', 'action' => 'resetPassword'], true) . '/' . $passkey;
                if ($this->Users->updateAll(
                    ['passkey' => $passkey,
                    'failed_login_attempts' => ++$user->failed_login_attempts,
                    'failed_login_last_date' => Chronos::now()],
                    ['id' => $user->id]
                )
                ) {

                    $mailer = $this->getMailer('User')->send('sendResetEmail', [$url, $user]);
                    if ($mailer) {
                        $this->Flash->success(__('Check your email for your reset password link'));
                    } else {
                        $this->Flash->error(__('Error sending email: ')); // . $email->smtpError);
                    }
                    return $this->redirect(['action' => 'login']);
                }
            }
        }
    }

    /* Reset lost password */
    public function resetPassword($passkey = null) {

        $this->Authorization->skipAuthorization();

        // regardless of anything, redirect if user is logged in
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Flash->default('You are logged in, you can change your password directly from here.');
            return $this->redirect(['controller' => 'users', 'action' => 'changePassword']);
        }

        if (empty($passkey)) {
            $this->Flash->error('Invalid passkey. Please check your email or try again.');
            return $this->redirect(['action' => 'lostPassword']);
        }

        // no logged user and there is a passkey : proceed!
        $query = $this->Users->findByPasskey($passkey);
        $user = $query->first();
        // check if user exists
        if (empty($user)) {
            $this->Flash->error('Invalid passkey. Please check your email or try again');
            return $this->redirect(['action' => 'lostPassword']);
        } else {
            // check if user is locked
            if ($user->is_locked) {
                $this->Flash->error('Your account is locked. Please contact an administrator');
                return $this->redirect(['action' => 'login']); // fixme: redirect to a contact form
            }
            // check if passkey is expired
            if (! $user->failed_login_last_date->wasWithinLast('24 hours')) {
                $this->Flash->error('Expired passkey. Please generate a new one, check your email and try again');
                return $this->redirect(['action' => 'lostPassword']);
            }

            // check if passwords were sent by submit button
            if ($this->request->is('post')) {
                $newPassword = $this->request->getData('new_password');
                $confirmPassword = $this->request->getData('confirm_password');
                // check if the two passwords are identical
                if ($newPassword != $confirmPassword) {
                    $this->Flash->error('Passwords are different. Please retry.');
                    return $this->redirect(['action' => 'resetPassword', $passkey]);
                } else {
                    $user->password = $newPassword;
                    $user->passkey = null;
                    $this->Users->save($user);
                    $this->Flash->success('Your password has been updated.');
                    return $this->redirect(['action' => 'login']);
                }
            }
        }
    }

    /* change your password when logged */
    public function changePassword() {
        // check if user is logged

        $user = $this->Users->get($this->Authentication->getIdentity()->get('id'));
        $this->Authorization->authorize($user, 'my');

        if (! is_null($user)) {
            if ($this->request->is('post')) {
                $oldPassword = $this->request->getData('password');
                $newPassword = $this->request->getData('new_password');
                $confirmPassword = $this->request->getData('confirm_password');
                // check if old password is correct for security
                $authenticator = $this->Authentication->getAuthenticationService()->loadAuthenticator('Authentication.Form');
                $result = $authenticator->authenticate($this->request);
                if (! $result->isValid()) {
                    $this->Flash->error('We could not confirm your identity (incorrect old password). Please retry.');
                    return $this->redirect(['action' => 'changePassword']);
                }
                // check if the two passwords are identical
                if ($newPassword != $confirmPassword) {
                    $this->Flash->error('Passwords are different. Please retry.');
                    return $this->redirect(['action' => 'changePassword']);
                } else {
                    $user->password = $newPassword;
                    $user->passkey = null;
                    if ($this->Users->save($user)) {
                        $this->Flash->success('Your password has been updated.');
                        return $this->redirect(['action' => 'my']);
                    } else {
                        $this->Flash->error('Your password could not be updated. Please, retry or contact an administrator.');
                        return $this->redirect(['action' => 'changePassword']);
                    }
                }
            } else {
                $this->set(compact('user'));
            }
        } else {
            $this->Flash->error('You must be logged in to use this feature.');
            return $this->redirect(['action' => 'login']);
        }
    }

    public function changeEmail() {
        $result = $this->Authentication->getResult();
        $user = $this->Users->get($this->Authentication->getIdentity()->get('id'));
        if ($result->isValid()) {
            $this->Authorization->authorize($user);
            if ($this->request->is('post')) {
                // check password, save user, send activation email and redirect
                $password = $this->request->getData('password');
                $new_email = $this->request->getData('new_email');
                $confirm_email = $this->request->getData('confirm_email');
                // check if old password is correct for security
                $authenticator = $this->Authentication->getAuthenticationService()->loadAuthenticator('Authentication.Form');
                $result = $authenticator->authenticate($this->request);
                if (! $result->isValid()) {
                    $this->Flash->error('We could not confirm your identity (incorrect old password). Please retry.');
                    return $this->redirect(['action' => 'changeEmail']);
                }
                // check if the two emails are identical
                if ($new_email != $confirm_email) {
                    $this->Flash->error('Emails are different. Please, check your entry and retry.');
                    return $this->redirect(['action' => 'changeEmail']);
                } else {
                    // update user and send activation link
                    $user->email = $new_email;
                    $user->passkey = uniqid('', true);
                    $user->is_locked = true;
                    $user->failed_login_last_date = Chronos::now();
                    $user->failed_login_attempts = 1;

                    if ($this->Users->save($user)) {
                        $url = Router::Url(['controller' => 'users', 'action' => 'confirm-email'], true) . '/' . $user->passkey;
                        $mailer = $this->getMailer('User')->send('sendConfirmationEmail', [$url, $user]);
                        if ($mailer) {
                            $this->Flash->warning(__('Your email has been modified. Your accound must now be reactivated. Please, check your new email for your confirmation link.'));
                            $this->Authentication->logout();
                        } else {
                            $this->Flash->error(__('Error sending email: ')); // . $email->smtpError);
                        }
                        return $this->redirect(['action' => 'login']);
                    } else {
                        $this->Flash->error(__('Something went wrong. Please, try again or contact an administrator.'));
                        return $this->redirect(['action' => 'changeEmail']);
                    }
                }
            } else {
                $this->set(compact('user'));
            }
        }
    }

    public function confirmEmail($passkey = null) {
        $this->Authorization->skipAuthorization();
        $identity = $this->request->getAttribute('identity');
        if (empty($passkey)) {
            $this->Flash->error('Invalid activation link. Please check your email or try again');
            return $this->redirect(['action' => 'register']);
        } else {
           // check passkey and unlock user
           $query = $this->Users->findByPasskey($passkey);
           $user = $query->first();

           // if a user is connected but try the activation link from another account email, we must fail!
           if (empty($user) || (! is_null($identity) && $user->id != $identity->id)) {
               $this->Flash->error('Invalid confirmation link. Please, check your email inbox or contact an administrator.');
               return $this->redirect(['action' => 'login']);
           } else {
               // check if activation link is expired
               if (!$user->failed_login_last_date->wasWithinLast('24 hours')) {
                   $this->Users->delete($user);
                   $this->Flash->error('Expired confirmation link. Please, contact an administrator to unlock your account.');
                   return $this->redirect(['action' => 'register']);
               } else {
                   // activate
                   $user->is_locked = 0;
                   $user->passkey = null;
                   $user->failed_login_attempts = 0;
                   $user->failed_login_last_date = null;
                   if($this->Users->save($user)) {
                       if (! is_null($identity)) {
                           $this->Authentication->logout();
                       }
                       $this->Flash->success('Your email change has been confirmed. You can now log in with your new credentials.');
                       return $this->redirect(['action' => 'login']);
                   } else {
                       return $this->Flash->error(__('Something went wrong. Please, try again or contact an administrator.'));
                   }
               }
           }
       }
   }


    /**
     * Lock method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function lock($id = null) {
        $this->request->allowMethod(['get', 'post']);
        $user = $this->Users->get($id);
        $this->Authorization->authorize($user);
        if ($user->is_locked) {
            $this->Flash->warning('This user was already locked.');
        } else {
            $user->is_locked = true;
            if ($this->Users->save($user)) {
                $this->Flash->success('This user is now locked.');
            } else {
                $this->Flash->error('This user could not be locked. Please try again.');
            }
        }

        return $this->redirect(['action' => 'view', $user->id]);
    }

    /**
     * Unlock method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function unlock($id = null) {
        $this->request->allowMethod(['get', 'post']);
        $user = $this->Users->get($id);
        $this->Authorization->authorize($user, 'lock');
        if (! $user->is_locked) {
            $this->Flash->warning('This user was already unlocked.');
        } else {
            $user->is_locked = false;
            if ($this->Users->save($user)) {
                $this->Flash->success('This user is now unlocked.');
            } else {
                $this->Flash->error('This user could not be unlocked. Please try again.');
            }
        }

        return $this->redirect(['action' => 'view', $user->id]);
    }

    /**
    * Finders *
    **/

    public function autocomplete() {
        $this->Authorization->skipAuthorization();
        if ($this->request->is(['ajax'])) {
            $items = $this->Users->find('all')
                ->select(['id', 'value' => 'username', 'label' => 'username'])
                ->where([
                            'username LIKE' => '%' . $this->request->getQuery('searchkey') . '%',
                        ])
                ->order(['username' => 'ASC'])
            ;
            $this->set('items', $items);
            $this->viewBuilder()->setOption('serialize', ['items']);
        }
    }

    public function named()
    {
        $names = $this->request->getParam('pass');

        $users = $this->Users->find('named', [
            'names' => $names
        ]);

        // Pass variables into the view template context.
        $this->paginate = [
            'contain' => ['Ratteries', 'Roles'],
        ];
        $users = $this->paginate($users);

        $this->set([
            'users' => $users,
            'names' => $names
        ]);
    }
}
