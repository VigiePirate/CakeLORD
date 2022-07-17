<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Chronos\Chronos;
use Cake\Routing\Router;

/**
 * Rats Controller
 *
 * @property \App\Model\Table\RatsTable $Rats
 *
 * @method \App\Model\Entity\Rat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RatsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        /* $this->loadComponent('Security'); */
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions([
            'index', 'view',
            'named', 'fromRattery', 'ownedBy', 'sex',
            'search','results',
            'pedigree','parentsTree', 'childrenTree'
        ]);
        /* $this->Security->setConfig('unlockedActions', ['transferOwnership, declareDeath']); */
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
            'contain' => ['OwnerUsers', 'Ratteries', 'BirthLitters', 'BirthLitters.Contributions', 'States'],
        ];
        $rats = $this->paginate($this->Rats);
        $this->set(compact('rats'));
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
            'contain' => ['Ratteries','OwnerUsers', 'States', 'DeathPrimaryCauses', 'DeathSecondaryCauses','BirthLitters','BirthLitters.Contributions','BirthLitters.Ratteries'],
        ];
        // $rats = $this->paginate($this->Rats->find()->where(['Rats.owner_user_id' => $user->id]));
        $females = $this->Rats->find()
            ->where(['Rats.owner_user_id' => $user->id, 'Rats.sex' => 'F'])
            ->contain(['Ratteries','OwnerUsers', 'States', 'DeathPrimaryCauses', 'DeathSecondaryCauses','BirthLitters','BirthLitters.Contributions','BirthLitters.Ratteries']);
        $males = $this->Rats->find()
            ->where(['Rats.owner_user_id' => $user->id, 'Rats.sex' => 'M'])
            ->contain(['Ratteries','OwnerUsers', 'States', 'DeathPrimaryCauses', 'DeathSecondaryCauses','BirthLitters','BirthLitters.Contributions','BirthLitters.Ratteries']);
        $alive = $this->Rats->find()
            ->where(['Rats.owner_user_id' => $user->id, 'Rats.is_alive' => true])
            ->contain(['Ratteries','OwnerUsers', 'States', 'DeathPrimaryCauses', 'DeathSecondaryCauses','BirthLitters','BirthLitters.Contributions','BirthLitters.Ratteries']);
        $departed = $this->Rats->find()
            ->where(['Rats.owner_user_id' => $user->id, 'Rats.is_alive' => false])
            ->contain(['Ratteries','OwnerUsers', 'States', 'DeathPrimaryCauses', 'DeathSecondaryCauses','BirthLitters','BirthLitters.Contributions','BirthLitters.Ratteries']);
        $pending = $this->Rats->find()
            ->where(['Rats.owner_user_id' => $user->id, 'Rats.state_id' => '4'])
            ->contain(['Ratteries','OwnerUsers', 'States', 'DeathPrimaryCauses', 'DeathSecondaryCauses','BirthLitters','BirthLitters.Contributions','BirthLitters.Ratteries']);
        $waiting = $this->Rats->find()
            ->where([
                'Rats.owner_user_id' => $user->id,
                'OR' => [['Rats.state_id' => '3'], ['Rats.state_id' => '5']]])
            ->contain(['Ratteries','OwnerUsers', 'States', 'DeathPrimaryCauses', 'DeathSecondaryCauses','BirthLitters','BirthLitters.Contributions','BirthLitters.Ratteries']);
        $okrats = $this->Rats->find()
            ->where(['Rats.owner_user_id' => $user->id, 'Rats.state_id <=' => '2'])
            ->contain(['Ratteries','OwnerUsers', 'States', 'DeathPrimaryCauses', 'DeathSecondaryCauses','BirthLitters','BirthLitters.Contributions','BirthLitters.Ratteries']);

        if(! empty($pending->first())) {
            $this->Flash->error(__('You have rat sheets to correct!'));
        }
        $this->set(compact('females','males','alive','departed','pending','waiting','okrats','user'));
    }

    /**
     * View method
     *
     * @param string|null $id Rat id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $rat = $this->Rats->get($id, [
            'contain' => ['OwnerUsers', 'CreatorUsers', 'Ratteries', 'BirthLitters', 'BirthLitters.Ratteries', 'BirthLitters.Contributions',
            'BirthLitters.Sire', 'BirthLitters.Sire.BirthLitters', 'BirthLitters.Sire.BirthLitters.Contributions',
            'BirthLitters.Dam', 'BirthLitters.Dam.BirthLitters', 'BirthLitters.Dam.BirthLitters.Contributions',
            'Colors', 'Eyecolors', 'Dilutions', 'Markings', 'Earsets', 'Coats', 'Singularities',
            'DeathPrimaryCauses', 'DeathSecondaryCauses', 'States',
            'BredLitters', 'BredLitters.Contributions', 'BredLitters.Ratteries',
            'BredLitters.Sire', 'BredLitters.Sire.BirthLitters', 'BredLitters.Sire.BirthLitters.Contributions',
            'BredLitters.Dam', 'BredLitters.Dam.BirthLitters', 'BredLitters.Dam.BirthLitters.Contributions',
            'BredLitters.OffspringRats', 'BredLitters.OffspringRats.Ratteries',
            'BredLitters.OffspringRats.BirthLitters', 'BredLitters.OffspringRats.BirthLitters.Contributions',
            'BredLitters.OffspringRats.OwnerUsers', 'BredLitters.OffspringRats.States', 'BredLitters.OffspringRats.DeathPrimaryCauses', 'BredLitters.OffspringRats.DeathSecondaryCauses',
            'Conversations', 'RatSnapshots' => ['sort' => ['RatSnapshots.created' => 'DESC']], 'RatSnapshots.States'],
        ]);

        $this->loadModel('States');
        if($rat->state->is_frozen) {
            $next_thawed_state = $this->States->get($rat->state->next_thawed_state_id);
            $this->set(compact('next_thawed_state'));
        }
        else {
            $next_ko_state = $this->States->get($rat->state->next_ko_state_id);
            $next_ok_state = $this->States->get($rat->state->next_ok_state_id);
            if( !empty($rat->state->next_frozen_state_id) ) {
                $next_frozen_state = $this->States->get($rat->state->next_frozen_state_id);
                $this->set(compact('next_frozen_state'));
            }
            $this->set(compact('next_ko_state', 'next_ok_state'));
        };

        $snap_diffs = [];
        foreach ($rat->rat_snapshots as $snapshot) {
            $snap_diffs[$snapshot->id] = $this->Rats->snapCompareAsString($rat, $snapshot->id);
        }

        $this->set(compact('rat', 'snap_diffs'));
    }

    /**
     * Add method
     *
     * FIXME: litter_id as optional input (pre-fill form, read-only fields?)
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rat = $this->Rats->newEmptyEntity();
        $this->Authorization->authorize($rat);
        if ($this->request->is('post')) {
            // process data
            $data = $this->request->getData();
            $rat = $this->Rats->patchEntity($rat, $data);
            if ($this->Rats->save($rat)) {
                $this->Flash->success(__('The rat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rat could not be saved. Please, try again.'));
        } else {
            $this->Flash->default(__('Please record the rat’s information below. When in doubt, please check documentation before entering data.'));
        }
        $colors = $this->Rats->Colors->find('list', ['limit' => 200]);
        $eyecolors = $this->Rats->Eyecolors->find('list', ['limit' => 200]);
        $dilutions = $this->Rats->Dilutions->find('list', ['limit' => 200]);
        $markings = $this->Rats->Markings->find('list', ['limit' => 200]);
        $earsets = $this->Rats->Earsets->find('list', ['limit' => 200]);
        $coats = $this->Rats->Coats->find('list', ['limit' => 200]);
        $singularities = $this->Rats->Singularities->find('list', ['limit' => 200]);
        $states = $this->Rats->States->find('list', ['limit' => 200]);

        $generic = $this->Rats->Ratteries->find()->where(['is_generic IS' => true]);
        $creator = $this->Authentication->getIdentity()->get('id');
        $rattery = $this->Rats->Ratteries->findByOwnerUserId($creator)->where(['is_alive IS' => true]);
        $origins = $generic->all()->append($rattery)->combine('id', 'full_name');

        $this->set(compact(
            'rat',
            'colors',
            'eyecolors',
            'dilutions',
            'markings',
            'earsets',
            'coats',
            'singularities',
            'states',
            'origins',
            'creator'
        ));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rat id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rat = $this->Rats->get($id, [
            'contain' => ['BirthLitters', 'BredLitters', 'Singularities', 'Ratteries', 'DeathPrimaryCauses', 'States'],
        ]);
        $this->Authorization->authorize($rat);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rat = $this->Rats->patchEntity($rat, $this->request->getData());
            // Force setting pedigree_identifier to save the computed value
            $rat->set('pedigree_identifier', $this->request->getData('pedigree_identifier'));
            if ($this->Rats->save($rat)) {
                $this->Flash->success(__('The rat has been saved.'));

                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error(__('The rat could not be saved. Please, try again.'));
        }
        $ownerUsers = $this->Rats->OwnerUsers->find('list', ['limit' => 500]);
        $ratteries = $this->Rats->Ratteries->find('list', ['limit' => 200]);
        //$birthLitters = $this->Rats->BirthLitters->find('list', ['limit' => 200, 'contain' => 'ParentRats']);
        $colors = $this->Rats->Colors->find('list', ['limit' => 200]);
        $eyecolors = $this->Rats->Eyecolors->find('list', ['limit' => 200]);
        $dilutions = $this->Rats->Dilutions->find('list', ['limit' => 200]);
        $markings = $this->Rats->Markings->find('list', ['limit' => 200]);
        $earsets = $this->Rats->Earsets->find('list', ['limit' => 200]);
        $coats = $this->Rats->Coats->find('list', ['limit' => 200]);
        $deathPrimaryCauses = $this->Rats->DeathPrimaryCauses->find('list', ['limit' => 200]);
        $deathSecondaryCauses = $this->Rats->DeathSecondaryCauses->find('list', ['limit' => 200]);
        $creatorUsers = $this->Rats->CreatorUsers->find('list', ['limit' => 200]);
        $states = $this->Rats->States->find('list', ['limit' => 200]);
        //$bredLitters = $this->Rats->BredLitters->find('list', ['limit' => 200, 'contain' => 'ParentRats']);
        $singularities = $this->Rats->Singularities->find('list', ['limit' => 200]);
        //$this->set(compact('rat', 'ownerUsers', 'ratteries', 'birthLitters', 'colors', 'eyecolors', 'dilutions', 'markings', 'earsets', 'coats', 'deathPrimaryCauses', 'deathSecondaryCauses', 'creatorUsers', 'states', 'bredLitters', 'singularities'));
        $this->set(compact('rat', 'ownerUsers', 'ratteries', 'colors', 'eyecolors', 'dilutions', 'markings', 'earsets', 'coats', 'deathPrimaryCauses', 'deathSecondaryCauses', 'creatorUsers', 'states', 'singularities'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rat id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rat = $this->Rats->get($id);
        $this->Authorization->authorize($rat);
        if ($this->Rats->delete($rat)) {
            $this->Flash->success(__('The rat has been deleted.'));
        } else {
            $this->Flash->error(__('The rat could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /** Search functions **/

    /**
     * Search method
     *
     * Search rats by multiple criteria, from a form entry.
     *
     * @param
     * @return
     */

     public function search()
     {
         $this->Authorization->skipAuthorization();
         $rat = $this->Rats->newEmptyEntity();

         $options = $this->request->getQueryParams();

         if( empty($options) ) {
             $new_search = true;
         } else {
             $new_search = false;
             $rats = $this->Rats->find('multisearch', [
                 'options' => $options,
             ]);
             $this->paginate = [
                 'contain' => ['OwnerUsers', 'Ratteries', 'BirthLitters', 'BirthLitters.Contributions', 'BirthLitters.Ratteries', 'States'],
             ];
             $rats = $this->paginate($rats);
             $this->set(compact('rats','options'));
         }
         $this->set(compact('new_search'));

         $colors = $this->Rats->Colors->find('list', ['limit' => 200]);
         $eyecolors = $this->Rats->Eyecolors->find('list', ['limit' => 200]);
         $dilutions = $this->Rats->Dilutions->find('list', ['limit' => 200]);
         $markings = $this->Rats->Markings->find('list', ['limit' => 200]);
         $earsets = $this->Rats->Earsets->find('list', ['limit' => 200]);
         $coats = $this->Rats->Coats->find('list', ['limit' => 200]);
         $states = $this->Rats->States->find('list', ['limit' => 200]);
         $singularities = $this->Rats->Singularities->find('list', ['limit' => 200]);
         $this->set(compact('rat', 'colors', 'eyecolors', 'dilutions', 'markings', 'earsets', 'coats', 'states', 'singularities'));
     }

    public function results() {
        $url['action'] = 'search';
        $options = $this->request->getData();
        $query_string = [];
		foreach ($options as $key => $value){
			if ( $value != '' ) {
                $query_string[$key] = $value;
            }
		}
        $url['?'] = $query_string;
		$this->redirect($url);
    }

    /**
     * Restore method
     *
     * Restores a Rat from a previous snapshot.
     *
     * @param string|null $id Rat id.
     * @param string|null $snapshot_id RatSnapshot id.
     * @return \Cake\Http\Response|null Redirects to view.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function restore($id = null, $snapshot_id = null)
    {
        $rat = $this->Rats->get($id, ['contain' => ['Ratteries']]);
        $this->Authorization->authorize($rat);
        $this->Rats->removeBehavior('State');
        if ($this->Rats->snapRestore($rat, $snapshot_id)) {
            $this->Flash->success(__('The snapshot has been restored.'));
        } else {
            $this->Flash->error(__('The snapshot could not be loaded. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', $rat->id]);
    }

    /**
     * Names method
     *
     * Search rats by name.
     *
     * @param
     * @return
     */
    public function named()
    {
        $this->Authorization->skipAuthorization();

        if($this->request->is(['post']))
        {
            $names = [$this->request->getData('name')];
        } else
            {
                // The 'pass' key is provided by CakePHP and contains all
                // the passed URL path segments in the request.
                $names = $this->request->getParam('pass');
        }

        //
        // Use the RatsTable to find named rats.
        $rats = $this->Rats->find('named', [
            'names' => $names
        ]);

        // Pass variables into the view template context.
        $this->paginate = [
            'contain' => ['OwnerUsers', 'Ratteries', 'States', 'BirthLitters','BirthLitters.Contributions','BirthLitters.Ratteries'],
        ];
        $rats = $this->paginate($rats);

        $this->set(compact('rats', 'names'));
        /*
        $this->set([
            'rats' => $rats,
            'names' => $names
        ]);
         */
    }

    /**
     * fromRattery method
     *
     * Search rats by ratteries.
     *
     * @param
     * @return
     */
    public function fromRattery()
    {
        $this->Authorization->skipAuthorization();
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $ratteries = $this->request->getParam('pass');
        //
        // Use the RatsTable to find named rats.
        $rats = $this->Rats->find('fromRattery', [
            'ratteries' => $ratteries
        ]);

        // Pass variables into the view template context.
        $this->paginate = [
            'contain' => ['OwnerUsers', 'Ratteries', 'BirthLitters', 'BirthLitters.Contributions', 'States'],
        ];
        $rats = $this->paginate($rats);

        $this->set(compact('rats', 'ratteries'));
    }

    /**
     * ownedBy method
     *
     * Search rats by ratteries.
     *
     * @param
     * @return
     */
    public function ownedBy()
    {
        $this->Authorization->skipAuthorization();
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $owners = $this->request->getParam('pass');
        //
        // Use the RatsTable to find named rats.
        $rats = $this->Rats->find('ownedBy', [
            'owners' => $owners
        ]);

        // Pass variables into the view template context.
        $this->paginate = [
            'contain' => ['OwnerUsers', 'Ratteries', 'BirthLitters', 'BirthLitters.Contributions', 'States'],
        ];
        $rats = $this->paginate($rats);

        $this->set(compact('rats', 'owners'));
    }

    /**
     * sex method
     *
     * Search rats by sex.
     *
     * @param
     * @return
     */
    public function sex()
    {
        $this->Authorization->skipAuthorization();
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $sex = $this->request->getParam('pass');
        //
        // Use the RatsTable to find named rats.
        $rats = $this->Rats->find('sex', [
            'sex' => $sex
        ]);

        // Pass variables into the view template context.
        $this->paginate = [
            'contain' => ['OwnerUsers', 'Ratteries', 'BirthLitters', 'BirthLitters.Contributions', 'States'],
        ];
        $rats = $this->paginate($rats);

        $this->set(compact('rats', 'sex'));
    }

    /**
     * bornBefore method
     *
     * Search rats by birthdate.
     *
     * @param
     * @return
     */
    public function bornBefore()
    {
        $bornBefore = $this->request->getParam('pass');
        $rats = $this->Rats->find('bornBefore', [
            'bornBefore' => $bornBefore
        ]);

        // Pass variables into the view template context.
        $this->paginate = [
            'contain' => ['OwnerUsers', 'Ratteries', 'BirthLitters', 'BirthLitters.Contributions', 'States'],
        ];
        $rats = $this->paginate($rats);

        $this->set([
            'rats' => $rats,
            'bornBefore' => $bornBefore
        ]);
    }

    public function bornAfter()
    {
        $bornAfter = $this->request->getParam('pass');

        $rats = $this->Rats->find('bornAfter', [
            'bornAfter' => $bornAfter
        ]);

        $this->paginate = [
            'contain' => ['OwnerUsers','Ratteries', 'BirthLitters', 'BirthLitters.Contributions', 'States'],
        ];
        $rats = $this->paginate($rats);

        $this->set([
            'rats' => $rats,
            'bornAfter' => $bornAfter
        ]);
    }

    public function inState()
    {
        $inState = $this->request->getParam('pass');
        $rats = $this->Rats->find('inState', [
            'inState' => $inState
        ]);

        $this->paginate = [
            'contain' => ['OwnerUsers','Ratteries', 'BirthLitters', 'BirthLitters.Contributions', 'States'],
        ];
        $rats = $this->paginate($rats);

        $this->set([
            'rats' => $rats,
            'inState' => $inState
        ]);
    }

    public function needsStaff()
    {
        $rats = $this->Rats->find('needsStaff');

        $this->paginate = [
            'contain' => ['OwnerUsers','Ratteries', 'BirthLitters', 'BirthLitters.Contributions', 'States'],
        ];
        $rats = $this->paginate($rats);

        $this->set([
            'rats' => $rats
        ]);
    }

    /* Autocomplete for forms function */

    public function autocomplete() {
        if ($this->request->is(['ajax'])) {
            $searchkey = $this->request->getQuery('searchkey');
            $sex = $this->request->getQuery('sex');
            $items = $this->Rats->find('identified',[
                'names' => [$searchkey]])
                ->where(['sex IS' => $sex])
                ->select(['id',
                    'value' => "concat(Rats.name, ' (', pedigree_identifier, ')')",
                    'label' => "concat(Rats.name, ' (', pedigree_identifier, ')')"])
            ;
            $this->set('items', $items);
            $this->viewBuilder()->setOption('serialize', ['items']);
        }
    }

    /* Pedigree functions */

    public function parentsTree($id=null) {
        if ($this->request->is(['ajax'])) {
            $id = $this->request->getQuery('id');
            $rat = $this->Rats->get($id, [
                'contain' => ['Ratteries', 'BirthLitters', 'BirthLitters.Ratteries', 'BirthLitters.Contributions',
                'BirthLitters.Sire', 'BirthLitters.Sire.BirthLitters', 'BirthLitters.Sire.BirthLitters.Contributions',
                'BirthLitters.Dam', 'BirthLitters.Dam.BirthLitters', 'BirthLitters.Dam.BirthLitters.Contributions',
                'BirthLitters.Dam.DeathPrimaryCauses','BirthLitters.Dam.DeathSecondaryCauses',
                'BirthLitters.Sire.Colors', 'BirthLitters.Sire.Dilutions', 'BirthLitters.Sire.Markings', 'BirthLitters.Sire.Earsets', 'BirthLitters.Sire.Coats', 'BirthLitters.Sire.DeathPrimaryCauses', 'BirthLitters.Sire.DeathSecondaryCauses',
                'BirthLitters.Dam.Colors', 'BirthLitters.Dam.Dilutions', 'BirthLitters.Dam.Markings', 'BirthLitters.Dam.Earsets', 'BirthLitters.Dam.Coats', 'BirthLitters.Dam.DeathPrimaryCauses', 'BirthLitters.Dam.DeathSecondaryCauses',
                'States'],
            ]);

            $parents = $rat->parents_array;
            $this->set('_parents', $parents);
            $this->viewBuilder()->setOption('serialize', ['_parents']);
        }
    }

    public function childrenTree(){
        if ($this->request->is(['ajax'])) {
            $id = $this->request->getQuery('id');
            $rat = $this->Rats->get($id, [
                'contain' => ['BredLitters',
                'BredLitters.OffspringRats','BredLitters.OffspringRats.Ratteries',
                'BredLitters.OffspringRats.Coats','BredLitters.OffspringRats.Colors','BredLitters.OffspringRats.Dilutions','BredLitters.OffspringRats.Markings','BredLitters.OffspringRats.Earsets',
                'BredLitters.OffspringRats.DeathPrimaryCauses','BredLitters.OffspringRats.DeathSecondaryCauses',
                'BredLitters.OffspringRats.BirthLitters','BredLitters.OffspringRats.BirthLitters.Contributions'],
            ]);

            $children = $rat->children_array;
            $this->set('_children', $children);
            $this->viewBuilder()->setOption('serialize', ['_children']);
        }
    }

    public function pedigree($id = null)
    {
        $this->Authorization->skipAuthorization();
        $rat = $this->Rats->get($id, [
            'contain' => ['Colors', 'Eyecolors', 'Dilutions', 'Markings', 'Earsets', 'Coats', 'DeathPrimaryCauses', 'DeathSecondaryCauses', 'States', 'Ratteries',
            'BirthLitters', 'BirthLitters.Ratteries', 'BirthLitters.Contributions',
            'BirthLitters.Sire', 'BirthLitters.Sire.BirthLitters', 'BirthLitters.Sire.BirthLitters.Contributions',
            'BirthLitters.Dam', 'BirthLitters.Dam.BirthLitters', 'BirthLitters.Dam.BirthLitters.Contributions',
            'BirthLitters.Dam.DeathPrimaryCauses','BirthLitters.Dam.DeathSecondaryCauses',
            'BirthLitters.Sire.Colors', 'BirthLitters.Sire.Dilutions', 'BirthLitters.Sire.Markings', 'BirthLitters.Sire.Earsets', 'BirthLitters.Sire.Coats', 'BirthLitters.Sire.DeathPrimaryCauses', 'BirthLitters.Sire.DeathSecondaryCauses',
            'BirthLitters.Dam.Colors', 'BirthLitters.Dam.Dilutions', 'BirthLitters.Dam.Markings', 'BirthLitters.Dam.Earsets', 'BirthLitters.Dam.Coats', 'BirthLitters.Dam.DeathPrimaryCauses', 'BirthLitters.Dam.DeathSecondaryCauses',
            'BredLitters',
            'BredLitters.OffspringRats','BredLitters.OffspringRats.Ratteries',
            'BredLitters.OffspringRats.Coats','BredLitters.OffspringRats.Colors','BredLitters.OffspringRats.Dilutions','BredLitters.OffspringRats.Markings','BredLitters.OffspringRats.Earsets',
            'BredLitters.OffspringRats.DeathPrimaryCauses','BredLitters.OffspringRats.DeathSecondaryCauses',
            'BredLitters.OffspringRats.BirthLitters','BredLitters.OffspringRats.BirthLitters.Contributions',
            'Singularities'],
        ]);

        $family = [
            //'id' => $rat->pedigree_identifier,
            'id' => $rat->id,
            'true_id' => $id,
            'name' => $rat->usual_name,
            'sex' => 'X', // we want a different color for the root of the tree
            'description' => $rat->variety,
            'death' => $rat->short_death_cause . ' (' . $rat->age_string . ')',
            '_parents' => $rat->parents_array,
            '_children' => $rat->children_array,
        ];

        $this->loadModel('States');
        if($rat->state->is_frozen) {
            $next_thawed_state = $this->States->get($rat->state->next_thawed_state_id);
            $this->set(compact('next_thawed_state'));
        }
        else {
            $next_ko_state = $this->States->get($rat->state->next_ko_state_id);
            $next_ok_state = $this->States->get($rat->state->next_ok_state_id);
            if( !empty($rat->state->next_frozen_state_id) ) {
                $next_frozen_state = $this->States->get($rat->state->next_frozen_state_id);
                $this->set(compact('next_frozen_state'));
            }
            $this->set(compact('next_ko_state','next_ok_state'));
        };

        $json = json_encode($family);
        $this->set(compact('rat', 'json'));
    }

    public function family($id = null) {
        $this->Authorization->skipAuthorization();
        $rat = $this->Rats->get($id, [
            'contain' => ['States',
                'Ratteries',
                'BirthLitters', 'BirthLitters.Ratteries', 'BirthLitters.Contributions',
                'BredLitters']
        ]);

        $stats = $rat->wrapFamilyStatistics();

        $this->set(compact('rat', 'stats'));
    }

    /**
     * ChangePicture method
     *
     * @param string|null $id Rat id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changePicture($id = null)
    // this change is authorized to owner and staff, and brings rat to next_ok_state
    {
        $rat = $this->Rats->get($id, [
            'contain' => ['States', 'Ratteries', 'BirthLitters', 'BirthLitters.Contributions'],
        ]);
        $this->Authorization->authorize($rat);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rat = $this->Rats->patchEntity($rat, $this->request->getData());
            if ($this->Rats->save($rat, ['checkRules' => false])) {
                $this->Flash->warning(__('The rat’s new picture has been saved. A staff member still has to validate it.'));
                return $this->redirect(['action' => 'view', $rat->id]);
            }
            $this->Flash->error(__('The rat’s new picture could not be saved. Please, try again.'));
        }
        $this->set(compact('rat'));
    }

    /**
     * ChangeOwner method
     *
     * @param string|null $id Rat id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function transferOwnership($id = null)
    // this change is authorized to owner and staff, and brings rat to next_ok_state
    {
        $rat = $this->Rats->get($id, [
            'contain' => ['CreatorUsers', 'OwnerUsers', 'States', 'Ratteries',
            'BirthLitters', 'BirthLitters.Contributions'],
        ]);
        $this->Authorization->authorize($rat);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->request->getData('owner_user_id')) {
                $rat->set('owner_user_id', $this->request->getData('owner_user_id'));
                $rat->set('comments', $this->request->getData('comments'));
            }
            if ($this->Rats->save($rat, ['checkRules' => false])) {
                $this->Flash->success(__('The rat has been transferred to its new owner.'));
                return $this->redirect(['action' => 'view', $rat->id]);
            }
            $this->Flash->error(__('The rat ownership could not be changed. Please, try again.'));
        }
        $this->set(compact('rat'));
    }

    /**
     * DeclareDeath method
     *
     * @param string|null $id Rat id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function declareDeath($id = null)
    // this change is authorized to owner and staff, and brings rat to next_ok_state
    {
        $rat = $this->Rats->get($id, [
            'contain' => [
                'CreatorUsers','OwnerUsers','States','Ratteries','BirthLitters','BirthLitters.Contributions',
                'DeathPrimaryCauses','DeathSecondaryCauses',
            ],
        ]);
        $this->Authorization->authorize($rat);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rat->is_alive = false;
            $rat = $this->Rats->patchEntity($rat, $this->request->getData());
            // load death causes model and append rat association with it for rules on is_oldster/is_infant
            $this->loadModel('DeathPrimaryCauses');
            $rat->death_primary_cause = $this->DeathPrimaryCauses->get($rat->death_primary_cause_id);
            if ($this->Rats->save($rat)) {
                $this->Flash->success(__('Sorry for your loss. Your rat’s death has been recorded.'));
                return $this->redirect(['action' => 'view', $rat->id]);
            }
            $this->Flash->error(__('Your rat’s death could not be recorded. Please, try again.'));
        } else {
            $this->Flash->default(__('We are sorry for your loss. Please fill the information below to record the rat death. Date and primary cause are mandatory.'));
        }
        $deathPrimaryCauses = $this->Rats->DeathPrimaryCauses->find('list')->order(['id' => 'ASC']);
        $this->set(compact('rat','deathPrimaryCauses'));
    }

    /* State changes */

    public function freeze($id)
    {
        $this->request->allowMethod(['get', 'freeze']);
        $rat = $this->Rats->get($id, ['contain' => ['States']]);
        $this->Authorization->authorize($rat);
        if ($this->Rats->freeze($rat) && $this->Rats->save($rat, ['checkRules' => false])) {
            $this->Flash->success(__('This rat sheet is now frozen.'));
        } else {
            $this->Flash->error(__('We could not freeze the sheet. Please retry or contact an administrator.'));
        }
        return $this->redirect(['action' => 'view', $rat->id]);
    }

    public function thaw($id)
    {
        $this->request->allowMethod(['get', 'thaw']);
        $rat = $this->Rats->get($id, ['contain' => ['States']]);
        $this->Authorization->authorize($rat);
        if ($this->Rats->thaw($rat) && $this->Rats->save($rat, ['checkRules' => false])) {
            $this->Flash->success(__('This rat sheet is now unfrozen.'));
        } else {
            $this->Flash->error(__('We could not thaw the sheet. Please retry or contact an administrator.'));
        }
        return $this->redirect(['action' => 'view', $rat->id]);
    }

    public function approve($id)
    {
        $this->request->allowMethod(['get', 'approve']);
        $rat = $this->Rats->get($id, ['contain' => ['States']]);
        $this->Authorization->authorize($rat);
        if ($this->Rats->approve($rat) && $this->Rats->save($rat, ['checkRules' => false])) {
            $this->Flash->success(__('This rat sheet has been approved.'));
        } else {
            $this->Flash->error(__('We could not approve the sheet. Please retry or contact an administrator.'));
        }
        return $this->redirect(['action' => 'view', $rat->id]);
    }

    public function blame($id)
    {
        $this->request->allowMethod(['get', 'blame']);
        $rat = $this->Rats->get($id, ['contain' => ['States']]);
        $this->Authorization->authorize($rat);
        if ($this->Rats->blame($rat) && $this->Rats->save($rat, ['checkRules' => false])) {
            $this->Flash->success(__('This rat sheet has been unapproved.'));
        } else {
            $this->Flash->error(__('We could not unapprove the sheet. Please retry or contact an administrator.'));
        }
        return $this->redirect(['action' => 'view', $rat->id]);
    }
}
