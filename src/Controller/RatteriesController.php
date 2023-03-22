<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Ratteries Controller
 *
 * @property \App\Model\Table\RatteriesTable $Ratteries
 *
 * @method \App\Model\Entity\Rattery[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RatteriesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // No authentication needed on consultation
        $this->Authentication->addUnauthenticatedActions(['index', 'view', 'autocomplete']);
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
            'contain' => ['Users', 'Countries', 'States'],
        ];
        $ratteries = $this->paginate($this->Ratteries);

        $this->set(compact('ratteries'));
    }

    /**
     * My method
     *
     * @return \Cake\Http\Response|null
     */
    public function my()
    {
        $this->Authorization->skipAuthorization();
        $user = $this->Authentication->getIdentity();
        $this->paginate = [
            'contain' => ['Users', 'Countries', 'States'],
        ];
        $alive_ratteries = $this->paginate($this->Ratteries->find()->where([
                'owner_user_id' => $user->id,
                'is_alive' => true,
            ])->order('Ratteries.created DESC')
        );
        $closed_ratteries = $this->paginate($this->Ratteries->find()->where([
                'owner_user_id' => $user->id,
                'is_alive' => false,
            ])->order('Ratteries.created DESC')
        );
        $this->set(compact('alive_ratteries', 'closed_ratteries', 'user'));
    }

    /* rattery sheet for all users, including statistics */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $rattery = $this->Ratteries->get($id, [
            'contain' => ['Users', 'Countries', 'States',
                'Litters' => function($q) {
                    return $q
                    ->order('birth_date DESC')
                    ->limit(10);
                },
                'Litters.States',
                'Litters.Sire', 'Litters.Dam', 'Litters.Contributions',
                'Litters.Sire.BirthLitters.Contributions', 'Litters.Dam.BirthLitters.Contributions',
                'Rats' => function($q) {
                    return $q
                    ->order('Rats.modified DESC')
                    ->limit(10);
                },
                'Rats.States',
                'Rats.Ratteries', 'Rats.BirthLitters', 'Rats.BirthLitters.Contributions',
                'Rats.DeathPrimaryCauses','Rats.DeathSecondaryCauses',
                'RatterySnapshots'],
        ]);

        $stats = $rattery->wrapStatistics();

        if (! $rattery->is_generic && $stats['deadRatCount'] > 0) {
            $rats = $this->loadModel('Rats');
            $champion = $rattery->findChampion(['rattery_id' => $rattery->id]);
            if(! is_null($champion)) {
                $champion = $rats->get($champion->id, ['contain' => ['Ratteries', 'BirthLitters', 'BirthLitters.Ratteries', 'BirthLitters.Contributions']]);
            }
        } else {
            $champion = null;
        }

        // $offspringsQuery = $this->Ratteries->Rats
        //                         ->find('all', ['contain' => ['States', 'DeathPrimaryCauses','DeathSecondaryCauses']])
        //                         ->matching('Ratteries', function (\Cake\ORM\Query $query) use ($rattery) {
        //                             return $query->where([
        //                                 'Ratteries.id' => $rattery->id
        //                             ]);
        //                         });
        // $offsprings = $this->paginate($offspringsQuery);

        /* statebar */
        $this->loadModel('States');
        if($rattery->state->is_frozen) {
            $next_thawed_state = $this->States->get($rattery->state->next_thawed_state_id);
            $this->set(compact('next_thawed_state'));
        }
        else {
            $next_ko_state = $this->States->get($rattery->state->next_ko_state_id);
            $next_ok_state = $this->States->get($rattery->state->next_ok_state_id);
            if( !empty($rattery->state->next_frozen_state_id) ) {
                $next_frozen_state = $this->States->get($rattery->state->next_frozen_state_id);
                $this->set(compact('next_frozen_state'));
            }
            $this->set(compact('next_ko_state','next_ok_state'));
        };

        $user = $this->request->getAttribute('identity');

        $this->set(compact('rattery', 'champion', 'stats', 'user')); // 'offsprings'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rattery = $this->Ratteries->newEmptyEntity();
        $this->Authorization->authorize($this->Ratteries);
        if ($this->request->is('post')) {
            $rattery = $this->Ratteries->patchEntity($rattery, $this->request->getData());
            if ($this->Ratteries->save($rattery)) {
                $this->Flash->success(__('The rattery has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rattery could not be saved. Please, try again.'));
        }

        $users = $this->Ratteries->Users->find('list', ['limit' => 200]);
        $countries = $this->Ratteries->Countries->find('list', ['limit' => 200]);
        $states = $this->Ratteries->States->find('list')->order('id');
        $this->set(compact('rattery', 'users', 'countries', 'states'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rattery id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rattery = $this->Ratteries->get($id, [
            'contain' => ['Litters', 'Litters.Sire', 'Litters.Dam', 'States'],
        ]);
        $this->Authorization->authorize($rattery);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rattery = $this->Ratteries->patchEntity($rattery, $this->request->getData());
            if ($this->Ratteries->save($rattery)) {
                $this->Flash->warning(__('The rattery has been saved. Modifications still have to be validated by staff.'));
                return $this->redirect(['action' => 'view', $rattery->id]);
            }
            $this->Flash->error(__('The rattery could not be saved. Please, try again.'));
        }
        $users = $this->Ratteries->Users->find('list', ['limit' => 500]);
        $countries = $this->Ratteries->Countries->find('list', ['limit' => 200]);
        $states = $this->Ratteries->States->find('list', ['limit' => 200]);
        $litters = $this->Ratteries->Litters->find('list', ['limit' => 500, 'contain' => ['Dam', 'Sire']]);

        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('staffEdit', $rattery);
        $this->set(compact('rattery', 'users', 'countries', 'states', 'litters', 'user', 'show_staff'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rattery id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rattery = $this->Ratteries->get($id);
        $this->Authorization->authorize($rattery);
        if ($this->Ratteries->delete($rattery)) {
            $this->Flash->success(__('The rattery has been deleted.'));
        } else {
            $this->Flash->error(__('The rattery could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Restore method
     *
     * Restores a Rattery from a previous snapshot.
     *
     * @param string|null $id Rattery id.
     * @param string|null $snapshot_id RatterySnapshot id.
     * @return \Cake\Http\Response|null Redirects to view.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function restore($id = null, $snapshot_id = null)
    {
        $rattery = $this->Ratteries->get($id);
        $this->Authorization->authorize($rattery);
        if ($this->Ratteries->snapRestore($rattery, $snapshot_id)) {
            $this->Flash->success(__('The snapshot has been restored.'));
        } else {
            $this->Flash->error(__('The snapshot could not be loaded. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', $rattery->id]);
    }


    /* create a rattery, reserved to logged in users (with any role) */
    public function register($id = null)
    {
        $this->Authorization->authorize($this->Ratteries);

        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $user = $this->Authentication->getIdentityData('id');

            /* Check if user has an active rattery */
            $query = $this->Ratteries->find()
                ->where(['owner_user_id' => $user, 'is_alive' => true])
                ->all()->toList();
            if (count($query) != 0) {
                $this->Flash->error(__('You already have an active rattery. Declare your previous ratteries as inactive if you want to register a new one.'));
                return $this->redirect(['action' => 'my']);
            }

            /* Else : process form */
            $rattery = $this->Ratteries->newEmptyEntity();

            if ($this->request->is('post')) {

                /* Fill non form-controlled info */
                $rattery->owner_user_id = $this->Authentication->getIdentityData('id');
                $rattery->is_alive = false;
                $rattery->is_generic = false;

                /* save rattery */
                $rattery = $this->Ratteries->patchEntity($rattery, $this->request->getData());
                if ($this->Ratteries->save($rattery)) {
                    $this->Flash->warning(__('The rattery has been saved. Please note it will be validated only once you have recorded a rat, a litter, or a litter contribution under this prefix.'));
                    return $this->redirect(['action' => 'my']);
                } else {
                    $this->Flash->error(__('The rattery could not be saved. Please, try again.'));
                }
            }

            $countries = $this->Ratteries->Countries->find('list', ['limit' => 200]);
            $this->set(compact('rattery', 'countries'));
        } else {
            $this->Flash->error(__('Only registered users are allowed to register a new rattery. Please sign in or sign up before proceeding.')); // . $email->smtpError);
            return $this->redirect(['action' => 'login']);
        }
    }

    /* declare a rattery as inactive */
    public function pause($id = null) {
        $rattery = $this->Ratteries->get($id, ['contain' => 'States']);
        $this->Authorization->authorize($rattery, 'microEdit');

        if (! $rattery->is_alive) {
            $this->Flash->warning('This rattery was already inactive.');
        } else {
            $rattery->is_alive = false;
            if ($this->Ratteries->save($rattery)) {
                $this->Flash->success('This rattery is now officially inactive.');
            } else {
                $this->Flash->error('This rattery could not be declared inactive. Please try again.');
            }
        }

        return $this->redirect(['action' => 'view', $rattery->id]);
    }

    /* declare a rattery as active */
    /* FIXME: some checks should be in the model */
    public function reopen($id = null) {
        $rattery = $this->Ratteries->get($id, ['contain' => [
            'States',
            'Contributions',
            'Users',
            'Users.Ratteries'
        ]]);
        $this->Authorization->authorize($rattery, 'microEdit');

        if ($rattery->is_alive) {
            $this->Flash->warning('This rattery was already declared active.');
        } else {
            // check other ratteries (rule: 0 or 1 active rattery per user)
            $sisters = $rattery->user->ratteries;
            foreach ($sisters as $sister) {
                if ($sister->id != $rattery->id && $sister->is_alive) {
                    $this->Flash->error('You already have an active rattery. If you want to reopen another, you have to pause your current rattery first.');
                    return $this->redirect(['action' => 'view', $sister->id]);
                }
            }
            // check last litter; if too old, fail and require a litter recording
            $recent = $rattery->countLitters(['rattery_id' => $rattery->id, 'DATEDIFF(NOW(), birth_date) <=' => \App\Model\Table\RatteriesTable::MAXIMAL_INACTIVITY]);
            if ($recent == 0) {
                $this->Flash->error('This rattery had no litter for a long time and cannot be manually reopened. Record a litter with it first, and it will be automatically reopened.');
            } else {
                $rattery->is_alive = true;
                if ($this->Ratteries->save($rattery)) {
                    $this->Flash->success('This rattery is now officially active.');
                } else {
                    $this->Flash->error('This rattery could not be declared active. Please try again.');
                }
            }
        }

        return $this->redirect(['action' => 'view', $rattery->id]);
    }

    /* switch rattery statistics preferences */
    public function switchStats($id = null) {
        $rattery = $this->Ratteries->get($id, ['contain' => 'States']);
        $this->Authorization->authorize($rattery, 'microEdit');

        $rattery->wants_statistic = ! $rattery->wants_statistic;
        if ($this->Ratteries->save($rattery)) {
            $this->Flash->success('Your statistics settings have been updated.');
        } else {
            $this->Flash->error('We could not update your statistics preferences. Please try again.');
        }
        return $this->redirect(['action' => 'my']);
    }


    /**
     * ChangePicture method
     *
     * @param string|null $id Rattery id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changePicture($id = null)
    // this change is authorized to owner and staff
    {
        $rattery = $this->Ratteries->get($id, ['contain' => 'States']);
        $this->Authorization->authorize($rattery, 'microEdit');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rattery = $this->Ratteries->patchEntity($rattery, $this->request->getData());
            if ($this->Ratteries->save($rattery, ['checkRules' => false])) {
                $this->Flash->success(__('The rattery’s new picture has been saved.'));
                return $this->redirect(['action' => 'view', $rattery->id]);
            }
            $this->Flash->error(__('The rattery’s new picture could not be saved. Please, try again.'));
        }
        $this->set(compact('rattery'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rattery id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editComment($id = null)
    {
        $rattery = $this->Ratteries->get($id, [
            'contain' => ['Litters', 'Litters.Sire', 'Litters.Dam', 'States'],
        ]);

        $this->Authorization->authorize($rattery, 'microEdit');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rattery = $this->Ratteries->patchEntity($rattery, $this->request->getData());
            if ($this->Ratteries->save($rattery)) {
                $this->Flash->warning(__('Your new comment about the rattery has been saved.'));
                return $this->redirect(['action' => 'view', $rattery->id]);
            }
            $this->Flash->error(__('Your new comment about the rattery could not be saved. Please, try again.'));
        }

        $user = $this->request->getAttribute('identity');
        $show_staff = ! is_null($user) && $user->can('staffEdit', $rattery);

        $this->set(compact('rattery', 'user', 'show_staff'));
    }

    /* see all active ratteries on a Googlemap + highlight one if $id is not null */
    public function locate()
    {
        $this->Authorization->skipAuthorization();

        $ratteries = $this->Ratteries->find('located', ['contain' => ['Users']]);

        $id = $this->request->getParam('pass');
        if (! empty($id)) {
            $rattery = $this->Ratteries->get($id, ['contain' => ['Users']]);
            $this->set(compact('rattery'));
        }

        $map_options = [
            'zoom' => 'auto',
            'type' => 'R',
            'geolocate' => true,
            'div' => ['id' => 'ratterymap'],
            'map' => [
                'navOptions' => ['style' => 'SMALL'],
                'typeOptions' => [
                    'style' => 'HORIZONTAL_BAR',
                    'pos' => 'LEFT_TOP'
                ],
                'defaultLat' => isset($rattery) ? $rattery->latitude : null,
                'defaultLng' => isset($rattery) ? $rattery->longitude : null,
            ]
        ];

        if (! empty($id)) {
            $map_options['zoom'] = 7;
            $map_options['geolocate'] = false;
        }

        $this->set(compact('ratteries', 'map_options'));
    }

    /* change country, zipcode and/or other location indications */
    /* latitude/longitude will be updated through Geocoder behaviour if configured */
    public function relocate($id = null)
    {
        $rattery = $this->Ratteries->get($id, [
            'contain' => ['Countries', 'States'],
        ]);
        $this->Authorization->authorize($rattery, 'microEdit');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rattery = $this->Ratteries->patchEntity($rattery, $this->request->getData());
            if ($this->Ratteries->save($rattery)) {
                $this->Flash->success(__('The new location of your rattery has been recorded.'));
                return $this->redirect(['action' => 'view', $rattery->id]);
            }
            $this->Flash->error(__('Your rattery’s new location could not be recorded. Please, try again.'));
        } else {
            $this->Flash->default(__('Please fill the information below to record your rattery new location. Country is mandatory.
            If you do not live in France and wish to appear on the map, it is recommended that you add optional localization information.'));
        }
        $countries = $this->Ratteries->Countries->find('list');
        $this->set(compact('countries', 'rattery'));
    }

    /** Search methods **/

    /**
    * Prefix method (search rattery by prefix)
    **/

    public function named()
    {
        $this->Authorization->skipAuthorization();

        $names = $this->request->getParam('pass');

        $ratteries = $this->Ratteries->find('named', [
            'names' => $names
        ]);

        $this->paginate = [
            'contain' => ['Users', 'Countries', 'States'],
        ];
        $ratteries = $this->paginate($ratteries);

        $this->set([
            'ratteries' => $ratteries,
            'names' => $names
        ]);
    }

    /**
     * ownedBy method
     *
     * Search ratteries by owners.
     *
     * @param
     * @return
     */
    public function ownedBy()
    {
        $this->Authorization->skipAuthorization();
        $users = $this->request->getParam('pass');

        $ratteries = $this->Ratteries->find('ownedBy', [
            'users' => $users
        ]);

        $this->paginate = [
            'contain' => ['Users', 'States','Countries'],
        ];
        $ratteries = $this->paginate($ratteries);

        $this->set(compact('ratteries', 'users'));
    }

    public function inState()
    {
        $this->Authorization->authorize($this->Ratteries);

        $inState = $this->request->getParam('pass');
        $ratteries = $this->Ratteries->find('inState', [
            'inState' => $inState
        ]);

        $this->paginate = [
            'contain' => ['Users', 'States','Countries'],
        ];
        $ratteries = $this->paginate($ratteries);

        $this->set([
            'ratteries' => $ratteries,
            'inState' => $inState
        ]);
    }

    public function autocomplete() {

        $this->Authorization->skipAuthorization();
        if ($this->request->is(['ajax'])) {
            $searchkey = $this->request->getQuery('searchkey');
            $items = $this->Ratteries->find('named', ['names' => [$searchkey]] )
                ->select(['id', 'value' => "concat(prefix,' – ',name)", 'label' => "concat(prefix,' – ',name)"])
            ;
            $this->set('items', $items);
            $this->viewBuilder()->setOption('serialize', ['items']);
        }
    }

    /* State changes */

    public function freeze($id)
    {
        $this->request->allowMethod(['get', 'freeze']);
        $rattery = $this->Ratteries->get($id, ['contain' => ['States']]);
        $this->Authorization->authorize($rattery, 'changeState');
        if ($this->Ratteries->freeze($rattery) && $this->Ratteries->save($rattery, ['checkRules' => false])) {
            $this->Flash->success(__('This rat sheet is now frozen.'));
        } else {
            $this->Flash->error(__('We could not freeze the sheet. Please retry or contact an administrator.'));
        }
        return $this->redirect(['action' => 'view', $rattery->id]);
    }

    public function thaw($id)
    {
        $this->request->allowMethod(['get', 'thaw']);
        $rattery = $this->Ratteries->get($id, ['contain' => ['States']]);
        $this->Authorization->authorize($rattery, 'editFrozen');
        if ($this->Ratteries->thaw($rattery) && $this->Ratteries->save($rattery, ['checkRules' => false])) {
            $this->Flash->success(__('This rat sheet is now unfrozen.'));
        } else {
            $this->Flash->error(__('We could not thaw the sheet. Please retry or contact an administrator.'));
        }
        return $this->redirect(['action' => 'view', $rattery->id]);
    }

    public function approve($id)
    {
        $this->request->allowMethod(['get', 'approve']);
        $rattery = $this->Ratteries->get($id, ['contain' => ['States']]);
        $this->Authorization->authorize($rattery, 'changeState');
        if ($this->Ratteries->approve($rattery) && $this->Ratteries->save($rattery, ['checkRules' => false])) {
            $this->Flash->success(__('This rat sheet has been approved.'));
        } else {
            $this->Flash->error(__('We could not approve the sheet. Please retry or contact an administrator.'));
        }
        return $this->redirect(['action' => 'view', $rattery->id]);
    }

    public function blame($id)
    {
        $this->request->allowMethod(['get', 'blame']);
        $rattery = $this->Ratteries->get($id, ['contain' => ['States']]);
        $this->Authorization->authorize($rattery, 'changeState');
        if ($this->Ratteries->blame($rattery) && $this->Ratteries->save($rattery, ['checkRules' => false])) {
            $this->Flash->success(__('This rat sheet has been unapproved.'));
        } else {
            $this->Flash->error(__('We could not unapprove the sheet. Please retry or contact an administrator.'));
        }
        return $this->redirect(['action' => 'view', $rattery->id]);
    }

    public function blameNeglected() {
        return $this->Ratteries->blameNeglected($this->Ratteries);
    }
}
