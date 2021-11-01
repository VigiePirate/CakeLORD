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
        $this->Authentication->addUnauthenticatedActions(['index', 'view','autocomplete']);
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
            'Litters', 'Litters.Sire', 'Litters.Dam', 'Litters.States', 'Litters.Ratteries',
            'Litters.Sire.BirthLitters.Ratteries', 'Litters.Dam.BirthLitters.Ratteries',
            'Litters.Sire.BirthLitters.Contributions', 'Litters.Dam.BirthLitters.Contributions',
            'Rats','Rats.States',
            'Rats.Ratteries', 'Rats.BirthLitters', 'Rats.BirthLitters.Contributions',
            'Rats.DeathPrimaryCauses','Rats.DeathSecondaryCauses',
            'RatterySnapshots'],
        ]);

        // fixme: for statistics, probably does not belong here
        // $count = $rattery->Rats->find('all')->count();
        // $this->set('count', $count);

        // $stats = ($rattery->is_generic) ? $rattery->rat_stat : $rattery->health_stat;
        $stats = $rattery->health_stat;
        $champion = $rattery->champion;

        $offspringsQuery = $this->Ratteries->Rats
                                ->find('all', ['contain' => ['States', 'DeathPrimaryCauses','DeathSecondaryCauses']])
                                ->matching('Ratteries', function (\Cake\ORM\Query $query) use ($rattery) {
                                    return $query->where([
                                        'Ratteries.id' => $rattery->id
                                    ]);
                                });
        $offsprings = $this->paginate($offspringsQuery);

        // debug new statistics
        // $lifetime = $rattery->lifetime;
        // $this->set(compact('lifetime'));

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

        $this->set(compact('rattery','stats','champion','offsprings'));
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
            // check if user has an alive rattery
            $query = $this->Ratteries->find()
                ->where(['owner_user_id' => $user, 'is_alive' => true])
                ->toList();
            if( count($query) !=0 ) {
                $this->Flash->error(__('You already have an active rattery. Declare your previous ratteries as inactive if you want to register a new one.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $rattery = $this->Ratteries->newEmptyEntity();
                $this->Authorization->authorize($rattery, 'create');
                if ($this->request->is('post')) {
                    // fill non form-controlled info
                    $rattery->owner_user_id = $this->Authentication->getIdentityData('id');
                    $rattery->is_alive = false;
                    $rattery->is_generic = false;
                    $rattery->state_id = 3; // to be replaced by the is_default state
                    // process and save picture (rough prototype)
                    // should probably also be in a validator/rules instead
                    $picture = $this->request->getData('picture_file');
                    if($picture->getClientFilename() != '') { // there should be a better test than that when no file has been uploaded
                        $type = $picture->getClientMediaType();
                        if( $type != 'image/jpeg' ){ // other file types should be accepted (at least png)
                            $this->Flash->error(__('Your picture cannot be processed. Please, try with another picture in jpeg format.'));
                        } else {
                            // process image with GD
                            $name = $picture->getClientFilename();
                            $size = $picture->getSize();
                            $tmpName = $picture->getStream()->getMetadata('uri');
                            $img = imagecreatefromjpeg($tmpName);
                            $sizes = getimagesize($tmpName);
                            // determine final size to respect aspect ratio and maximal dimensions
                            $maxWidth = 600;
                            $maxHeight = 400;
                            $newWidth = (int)$sizes[0];
                            $newHeight = (int)$sizes[1];
                            $aspectRatio = $sizes[0]/$sizes[1];
                            if($sizes[0]>$maxWidth) {
                                $newWidth = $maxWidth;
                                $newHeight = (int)round($newWidth/$aspectRatio);
                            }
                            if($sizes[1]>$maxHeight) {
                                $newHeight = $maxHeight;
                                $newWidth = (int)round($newHeight*$aspectRatio);
                            }
                            $new_img = imagecreatetruecolor($newWidth,$newHeight);
                            $final = imagecopyresampled($new_img,$img,0,0,0,0,$newWidth,$newHeight,$sizes[0],$sizes[1]);
                            $picture_name = 'Rattery_' . $this->request->getData('prefix') . '.jpg';
                            $dest = UPLOADS . $picture_name;
                            imagejpeg($new_img,$dest,90);
                            $rattery->picture = $picture_name;
                        }
                    } else {
                        $rattery->picture = 'Unknown.png';
                    }
                    // save rattery
                    $rattery = $this->Ratteries->patchEntity($rattery, $this->request->getData());
                    if ($this->Ratteries->save($rattery)) {
                        $this->Flash->warning(__('The rattery has been saved. Please note it will be validated only once you have recorded a rat, a litter, or a litter contribution under this prefix.'));
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error(__('The rattery could not be saved. Please, try again.'));
                    }
                }
                // $litters = $this->Ratteries->Litters->find('list', ['limit' => 200]);
                $countries = $this->Ratteries->Countries->find('list', ['limit' => 200]);
                $this->set(compact('rattery', 'countries')); //'litters'));
            }
        } else {
            $this->Flash->error(__('Only registered users are allowed to register a new rattery. Please sign in or sign up before proceeding.')); // . $email->smtpError);
            return $this->redirect(['action' => 'login']);
        }
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

    // Functions for statistics
    // Compute the number of rats born in the rattery
    // not used and probably bugged
    public function countRats()
    {
        $this->Rats->find('all')->count();
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
}
