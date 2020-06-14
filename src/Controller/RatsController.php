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
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['index','view','named', 'fromRattery', 'ownedBy', 'sex']);
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
            'contain' => ['OwnerUsers', 'Ratteries', 'BirthLitters','BirthLitters.Ratteries','Colors', 'Eyecolors', 'Dilutions', 'Markings', 'Earsets', 'Coats', 'DeathPrimaryCauses', 'DeathSecondaryCauses', 'CreatorUsers', 'States'],
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
            'contain' => ['Ratteries','OwnerUsers', 'States', 'DeathPrimaryCauses', 'DeathSecondaryCauses','BirthLitters','BirthLitters.Ratteries'],
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
            'contain' => ['OwnerUsers', 'CreatorUsers','Ratteries', 'BirthLitters', 'BirthLitters.Ratteries',
            'BirthLitters.Sire','BirthLitters.Dam','BirthLitters.Sire.BirthLitters.Ratteries','BirthLitters.Dam.BirthLitters.Ratteries',
            'Colors', 'Eyecolors', 'Dilutions', 'Markings', 'Earsets', 'Coats', 'DeathPrimaryCauses', 'DeathSecondaryCauses', 'CreatorUsers', 'States',
            'BredLitters','BredLitters.Sire','BredLitters.Dam','BredLitters.OffspringRats','BredLitters.OffspringRats.OwnerUsers','BredLitters.OffspringRats.States','BredLitters.OffspringRats.DeathPrimaryCauses','BredLitters.OffspringRats.DeathSecondaryCauses',
            'Singularities', 'Conversations', 'RatSnapshots'],
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
            'contain' => ['OwnerUsers', 'Ratteries', 'States', 'BirthLitters','BirthLitters.Ratteries'],
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
            'contain' => ['OwnerUsers', 'Ratteries', 'States'],
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
            'contain' => ['OwnerUsers', 'Ratteries', 'States'],
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
            'contain' => ['OwnerUsers', 'Ratteries', 'States'],
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
            'contain' => ['OwnerUsers', 'Ratteries','States'],
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
            'contain' => ['OwnerUsers','Ratteries','States'],
        ];
        $rats = $this->paginate($rats);

        // $this->set(compact('rats', 'birth_dates'));

        $this->set([
            'rats' => $rats,
            'bornAfter' => $bornAfter
        ]);
    }

    public function pedigree($id = null)
    {
        $this->Authorization->skipAuthorization();
        $rat = $this->Rats->get($id, [
            'contain' => ['Ratteries', 'BirthLitters', 'BirthLitters.Ratteries',
            'BirthLitters.Sire','BirthLitters.Dam','BirthLitters.Sire.BirthLitters.Ratteries','BirthLitters.Dam.BirthLitters.Ratteries',
            'Colors', 'Eyecolors', 'Dilutions', 'Markings', 'Earsets', 'Coats', 'DeathPrimaryCauses', 'DeathSecondaryCauses', 'States',
            'BredLitters','BredLitters.Sire','BredLitters.Dam','BredLitters.OffspringRats','BredLitters.OffspringRats.OwnerUsers','BredLitters.OffspringRats.States','BredLitters.OffspringRats.DeathPrimaryCauses','BredLitters.OffspringRats.DeathSecondaryCauses',
            'Singularities'],
        ]);

        $family = [
            'name' => $rat->usual_name . $rat->is_alive_symbol,
            'description' => $rat->variety,
            'death' => $rat->short_death_cause . ' (' . $rat->age_string . ')',
            'sex' => 'X', // we want a different color for the root of the tree
            'id' => $rat->pedigree_identifier,
            '_parents' => [],
            '_children' => []
        ];

        $json = json_encode($family);
        $this->set(compact('rat', 'json'));
    }
}
