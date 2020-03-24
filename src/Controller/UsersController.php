<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Routing\Router;
use Cake\Mailer\Mailer;
use Cake\Mailer\MailerAwareTrait;
use Cake\Chronos\Chronos;

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
        $this->Authentication->addUnauthenticatedActions(['login']);
        $this->Authentication->addUnauthenticatedActions(['lostPassword']);
        $this->Authentication->addUnauthenticatedActions(['resetPassword']);
    }

    public function login() {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $authService = $this->Authentication->getAuthenticationService();
            // check if password needs a rehash
            if ($authService->identifiers()->get('Password')->needsPasswordRehash()) {
                // Rehash happens on save.
                $user = $this->Users->get($this->Authentication->getIdentityData('id'));
                $user->password = $this->request->getData('password');
                $this->Users->save($user);
                $this->Flash->set(__('Your password has been rehashed.'));
            }
            //$redirect = $this->request->getQuery('redirect', [
            //   'controller' => 'Pages',
            //    'action' => 'display',
            //]);
            //return $this->redirect($redirect);

            $target = $this->Authentication->getLoginRedirect();
            if (! $target) {
                $target = [
                    'controller' => 'Pages',
                    'action' => 'display',
                ];
            }
            return $this->redirect($target);
        }

        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
            // $this->log($result->getStatus());
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
            'contain' => ['Roles', 'Conversations', 'OwnerRats', 'CreatorRats', 'Ratteries'],
        ]);
        $this->Authorization->authorize($user);

        $this->set('user', $user);
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
            'contain' => ['Conversations'],
        ]);
        $this->Authorization->authorize($user);
        if ($this->request->is(['patch', 'post', 'put'])) {
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
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $this->Authorization->authorize($user);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
    *
    * Series of functions to deal with forgotten passwords
    */

    public function lostPassword($email = null)
    // fixme: add check for is_locked account (if locked, do not sent mail)
        {
            $this->Authorization->skipAuthorization();

            if ($this->request->is('post')) {
                $query = $this->Users->findByEmail($this->request->getData('email'));
                $user = $query->first();
                //$user = $query->firstOrFail();
                if (empty($user)) {
                    return $this->Flash->error('Email address does not exist. Please try again');
                } else {
                    /* return $this->Flash->success('We have found your email address'); */
                    $passkey = uniqid('', true);
                    $url = Router::Url(['controller' => 'users', 'action' => 'resetPassword'], true) . '/' . $passkey;
                    if ($this->Users->updateAll(
                      ['passkey' => $passkey,
                      'failed_login_attempts' => ++$user->failed_login_attempts,
                      'failed_login_last_date' => Chronos::now()],
                      ['id' => $user->id]
                      )
                    ) {

                    // $mailer = $this->getMailer('User');//->sendResetEmail($url,$user);
                    // $mailer = $this->getMailer('User')->send('sendResetEmail', [$url, $user]);
                    if ($this->getMailer('User')->send('sendResetEmail', [$url, $user])) {
                          $this->Flash->success(__('Check your email for your reset password link'));
                      } else {
                          $this->Flash->error(__('Error sending email: ')); // . $email->smtpError);
                      }
                      return $this->redirect(['action' => 'login']);
                    }
                    else {
                        return $this->Flash->error('Error saving reset passkey');
                    }
                }
            }
        }

    public function resetPassword($passkey = null) {

        $this->Authorization->skipAuthorization();

        if (empty($passkey)) {
          $this->Flash->error('Invalid or expired passkey. Please check your email or try again');
          // $this->redirect(['action' => 'lostPassword']);
        } else {
          $query = $this->Users->findByPasskey($passkey);
          $user = $query->first();

          if (empty($user)) {
            $this->Flash->error('Invalid or expired passkey. Please check your email or try again');
            $this->redirect(['action' => 'lostPassword']);
          } else {
            // check if user is locked
            if ($user->is_locked) {
              $this->Flash->error('Your account is locked. Please contact an administrator');
            } else {
              // check if passwords were sent by submit button
              if ($this->request->is('post')) {
                $newPassword = $this->request->getData('password');
                $confirmPassword = $this->request->getData('confirm_password');
                // check if the two passwords are identical
                if (strcmp($newPassword,$confirmPassword)) {
                  $this->Flash->error('Passwords are different. Please retry.');
                  $this->redirect('/users/reset-password/' . $passkey);
                } else {
                  $user->password = $newPassword;
                  $user->passkey = null;
                  $this->Users->save($user);
                  $this->Flash->success('Your password has been updated.');
                  $this->redirect(['action' => 'login']);
                  }
              }
            }
          }
        }
      }
}
