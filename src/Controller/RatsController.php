<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Chronos\Chronos;

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
        $this->loadComponent('Security');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['index','view','named', 'fromRattery', 'ownedBy', 'sex']);
        $this->Security->setConfig('unlockedActions', ['transferOwnership']);
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
            'contain' => ['OwnerUsers', 'Ratteries', 'BirthLitters','BirthLitters.Contributions','BirthLitters.Ratteries','Colors', 'Eyecolors', 'Dilutions', 'Markings', 'Earsets', 'Coats', 'DeathPrimaryCauses', 'DeathSecondaryCauses', 'CreatorUsers', 'States'],
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
        $rats = $this->paginate($this->Rats->find()->where(['Rats.owner_user_id' => $user->id]));

        $this->set(compact('rats', 'user'));
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
            'BredLitters.OffspringRats','BredLitters.OffspringRats.Ratteries',
            'BredLitters.OffspringRats.BirthLitters', 'BredLitters.OffspringRats.BirthLitters.Contributions',
            'BredLitters.OffspringRats.OwnerUsers', 'BredLitters.OffspringRats.States', 'BredLitters.OffspringRats.DeathPrimaryCauses', 'BredLitters.OffspringRats.DeathSecondaryCauses',
             'Conversations', 'RatSnapshots'],
        ]);

        $this->set('rat', $rat);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rat = $this->Rats->newEmptyEntity();
        $this->Authorization->authorize($rat);
        if ($this->request->is('post')) {
            $rat = $this->Rats->patchEntity($rat, $this->request->getData());
            if ($this->Rats->save($rat)) {
                $this->Flash->success(__('The rat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rat could not be saved. Please, try again.'));
        }
        $ownerUsers = $this->Rats->OwnerUsers->find('list', ['limit' => 200]);
        $ratteries = $this->Rats->Ratteries->find('list', ['limit' => 200]);
        $birthLitters = $this->Rats->BirthLitters->find('list', ['limit' => 200, 'contain' => 'ParentRats']);
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
        $bredLitters = $this->Rats->BredLitters->find('list', ['limit' => 200, 'contain' => 'ParentRats']);
        $singularities = $this->Rats->Singularities->find('list', ['limit' => 200]);
        $this->set(compact('rat', 'ownerUsers', 'ratteries', 'birthLitters','colors', 'eyecolors', 'dilutions', 'markings', 'earsets', 'coats', 'deathPrimaryCauses', 'deathSecondaryCauses', 'creatorUsers', 'states', 'bredLitters', 'singularities'));
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
            'contain' => ['BirthLitters', 'BredLitters', 'Singularities', 'Ratteries'],
        ]);
        $this->Authorization->authorize($rat);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rat = $this->Rats->patchEntity($rat, $this->request->getData());
            // Force setting pedigree_identifier to save the computed value
            $rat->set('pedigree_identifier', $this->request->getData('pedigree_identifier'));
            if ($this->Rats->save($rat)) {
                $this->Flash->success(__('The rat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rat could not be saved. Please, try again.'));
        }
        $ownerUsers = $this->Rats->OwnerUsers->find('list', ['limit' => 200]);
        $ratteries = $this->Rats->Ratteries->find('list', ['limit' => 200]);
        $birthLitters = $this->Rats->BirthLitters->find('list', ['limit' => 200, 'contain' => 'ParentRats']);
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
        $bredLitters = $this->Rats->BredLitters->find('list', ['limit' => 200, 'contain' => 'ParentRats']);
        $singularities = $this->Rats->Singularities->find('list', ['limit' => 200]);
        $this->set(compact('rat', 'ownerUsers', 'ratteries', 'birthLitters', 'colors', 'eyecolors', 'dilutions', 'markings', 'earsets', 'coats', 'deathPrimaryCauses', 'deathSecondaryCauses', 'creatorUsers', 'states', 'bredLitters', 'singularities'));
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
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $bornBefore = $this->request->getParam('pass');
        // $bornBefore = $bornBefore . " 00:00:00.000";
        // $bornBefore = new Chronos::Chronos($bornBeforeString);
        //
        // Use the RatsTable to find named rats.
        $rats = $this->Rats->find('bornBefore', [
            'bornBefore' => $bornBefore
        ]);

        // Pass variables into the view template context.
        $this->paginate = [
            'contain' => ['OwnerUsers', 'Ratteries', 'BirthLitters', 'BirthLitters.Contributions', 'States'],
        ];
        $rats = $this->paginate($rats);

        // $this->set(compact('rats', 'birth_dates'));

        $this->set([
            'rats' => $rats,
            'bornBefore' => $bornBefore
        ]);
    }

    public function bornAfter()
    {
        $bornAfter = $this->request->getParam('pass');

        // Use the RatsTable to find named rats.
        $rats = $this->Rats->find('bornAfter', [
            'bornAfter' => $bornAfter
        ]);

        // Pass variables into the view template context.
        $this->paginate = [
            'contain' => ['OwnerUsers','Ratteries', 'BirthLitters', 'BirthLitters.Contributions', 'States'],
        ];
        $rats = $this->paginate($rats);

        // $this->set(compact('rats', 'birth_dates'));

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

        // Pass variables into the view template context.
        $this->paginate = [
            'contain' => ['OwnerUsers','Ratteries', 'BirthLitters', 'BirthLitters.Contributions', 'States'],
        ];
        $rats = $this->paginate($rats);

        // $this->set(compact('rats', 'birth_dates'));

        $this->set([
            'rats' => $rats,
            'inState' => $inState
        ]);
    }

    public function pedigree($id = null)
    {
        $this->Authorization->skipAuthorization();
        $rat = $this->Rats->get($id, [
            'contain' => ['Ratteries', 'BirthLitters', 'BirthLitters.Ratteries', 'BirthLitters.Contributions',
            'BirthLitters.Sire', 'BirthLitters.Sire.BirthLitters', 'BirthLitters.Sire.BirthLitters.Contributions',
            'BirthLitters.Dam', 'BirthLitters.Dam.BirthLitters', 'BirthLitters.Dam.BirthLitters.Contributions',
            'BirthLitters.Dam.DeathPrimaryCauses','BirthLitters.Dam.DeathSecondaryCauses',
            'Colors', 'Eyecolors', 'Dilutions', 'Markings', 'Earsets', 'Coats', 'DeathPrimaryCauses', 'DeathSecondaryCauses', 'States',
            'BredLitters','BredLitters.Sire','BredLitters.Dam','BredLitters.OffspringRats','BredLitters.OffspringRats.OwnerUsers','BredLitters.OffspringRats.States','BredLitters.OffspringRats.DeathPrimaryCauses','BredLitters.OffspringRats.DeathSecondaryCauses',
            'Singularities'],
        ]);

        /* TEMPORARY : build parents and children subarrays */
        // should be in the model with recursive calls to build all ascendants and descendants
        // append id with some unique string (generation or path, like 0101 for mother's father's mother's father, for instance)
        $parents = [
            '0' => [
                'id' => '0' . $rat->birth_litter->dam[0]->pedigree_identifier, // should be modified to be unique in the tree
                'name' => $rat->birth_litter->dam[0]->usual_name,
                'sex' => 'F',
                'description' => '', // should be $dam->variety
                'death'=> '', // should be short_death_cause + age_string
                '_parents' => [] // will call dam's parents in recursive implementation
            ],
            '1' => [
                'id' => '1' . $rat->birth_litter->sire[0]->pedigree_identifier, // should be modified to be unique in the tree
                'name' => $rat->birth_litter->sire[0]->usual_name,
                'sex' => 'M',
                '_parents' => []
            ]
        ];

        $children = [];
        $child_no = 0;
        foreach($rat->bred_litters as $litter) {
            foreach ($litter->offspring_rats as $offspring) {
                $children[$child_no] = [
                    'id' => $child_no . '_' . $offspring->pedigree_identifier, // should be modified to be unique in the tree
                    'name' => $offspring->name, // should be $offspring->usual_name when double prefix is repaired
                    'sex' => $offspring->sex,
                    'description' => '', // should be $offspring->variety
                    'death' => '', // should be $offspring->main or short_death_cause
                    '_children' => [] // will call child's children in recursive implementation
                ];
                $child_no++;
            }
        }
        /* END TEMPORARY */

        /* assemble complete array */
        $family = [
            'id' => $rat->pedigree_identifier,
            'name' => $rat->usual_name,
            'sex' => 'X', // we want a different color for the root of the tree
            'description' => $rat->variety,
            'death' => $rat->short_death_cause . ' (' . $rat->age_string . ')',
            '_parents' => $parents,
            '_children' => $children
        ];

        $json = json_encode($family);
        $this->set(compact('rat', 'json'));
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
            'contain' => ['CreatorUsers','OwnerUsers','States','Ratteries','BirthLitters','BirthLitters.Contributions'],
        ]);
        $this->Authorization->authorize($rat);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rat = $this->Rats->patchEntity($rat, $this->request->getData());
            if ($this->Rats->save($rat)) {
                $this->Flash->success(__('The rat has been saved.'));
                return $this->redirect(['action' => 'view', $rat->id]);
            }
            $this->Flash->error(__('The rat could not be saved. Please, try again.'));
        }
        $this->set(compact('rat'));
    }
}
