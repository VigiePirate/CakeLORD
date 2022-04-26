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
        $user = $this->Authentication->getIdentity();
        $this->paginate = [
            'contain' => ['Users', 'Countries', 'States'],
        ];
        $ratteries = $this->paginate($this->Ratteries->find()->where([
            'owner_user_id' => $user->id,
            'is_alive' => true,
        ]));
        $closed_ratteries = $this->paginate($this->Ratteries->find()->where([
            'owner_user_id' => $user->id,
            'is_alive' => false,
        ]));


        $this->set(compact('ratteries', 'closed_ratteries', 'user'));
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

        $this->set(compact('rattery','champion', 'stats')); // 'offsprings'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rattery = $this->Ratteries->newEmptyEntity();
        $this->Authorization->authorize($rattery, 'create');
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
        $states = $this->Ratteries->States->find('list', ['limit' => 200]);
        $litters = $this->Ratteries->Litters->find('list', ['limit' => 500, 'contain' => ['Dam', 'Sire']]);
        $this->set(compact('rattery', 'users', 'countries', 'states', 'litters'));
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
            'contain' => ['Litters', 'Litters.Sire', 'Litters.Dam'],
        ]);
        $this->Authorization->authorize($rattery);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rattery = $this->Ratteries->patchEntity($rattery, $this->request->getData());
            if ($this->Ratteries->save($rattery)) {
                $this->Flash->success(__('The rattery has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rattery could not be saved. Please, try again.'));
        }
        $users = $this->Ratteries->Users->find('list', ['limit' => 500]);
        $countries = $this->Ratteries->Countries->find('list', ['limit' => 200]);
        $states = $this->Ratteries->States->find('list', ['limit' => 200]);
        $litters = $this->Ratteries->Litters->find('list', ['limit' => 500, 'contain' => ['Dam', 'Sire']]);
        $this->set(compact('rattery', 'users', 'countries', 'states', 'litters'));
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
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $user = $this->Authentication->getIdentityData('id');

            /* Check if user has an active rattery */
            $query = $this->Ratteries->find()
                ->where(['owner_user_id' => $user, 'is_alive' => true])
                ->toList();
            if (count($query) != 0) {
                $this->Flash->error(__('You already have an active rattery. Declare your previous ratteries as inactive if you want to register a new one.'));
                return $this->redirect(['action' => 'my']);
            }

            /* Else : process form */
            $rattery = $this->Ratteries->newEmptyEntity();
            $this->Authorization->authorize($rattery, 'create');

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

    /* see all active ratteries on a Googlemap + highlight one if $id is not null */
    public function locate()
    {
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
            'contain' => ['Countries'],
        ]);
        $this->Authorization->authorize($rattery);
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
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $names = $this->request->getParam('pass');

        // Use the RatteriesTable to find prefixed ratteries.
        $ratteries = $this->Ratteries->find('named', [
            'names' => $names
        ]);

        // Pass variables into the view template context.
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
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $users = $this->request->getParam('pass');
        //
        // Use the RatsTable to find named rats.
        $ratteries = $this->Ratteries->find('ownedBy', [
            'users' => $users
        ]);

        // Pass variables into the view template context.
        $this->paginate = [
            'contain' => ['Users', 'States','Countries'],
        ];
        $ratteries = $this->paginate($ratteries);

        $this->set(compact('ratteries', 'users'));
    }

    public function inState()
    {
        $inState = $this->request->getParam('pass');
        $ratteries = $this->Ratteries->find('inState', [
            'inState' => $inState
        ]);

        // Pass variables into the view template context.
        $this->paginate = [
            'contain' => ['Users', 'States','Countries'],
        ];
        $ratteries = $this->paginate($ratteries);

        // $this->set(compact('rats', 'birth_dates'));

        $this->set([
            'ratteries' => $ratteries,
            'inState' => $inState
        ]);
    }

    public function autocomplete() {
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
        $this->Authorization->authorize($rattery);
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
        $this->Authorization->authorize($rattery);
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
        $this->Authorization->authorize($rattery);
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
        $this->Authorization->authorize($rattery);
        if ($this->Ratteries->blame($rattery) && $this->Ratteries->save($rattery, ['checkRules' => false])) {
            $this->Flash->success(__('This rat sheet has been unapproved.'));
        } else {
            $this->Flash->error(__('We could not unapprove the sheet. Please retry or contact an administrator.'));
        }
        return $this->redirect(['action' => 'view', $rattery->id]);
    }
}
