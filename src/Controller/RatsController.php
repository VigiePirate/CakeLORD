<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Rats Controller
 *
 * @property \App\Model\Table\RatsTable $Rats
 *
 * @method \App\Model\Entity\Rat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RatsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['OwnerUsers', 'Ratteries', 'MotherRats', 'FatherRats', 'Litters', 'MotherRatteries', 'FatherRatteries', 'Colors', 'Eyecolors', 'Dilutions', 'Markings', 'Earsets', 'Coats', 'DeathPrimaryCauses', 'DeathSecondaryCauses', 'Users', 'States'],
        ];
        $rats = $this->paginate($this->Rats);

        $this->set(compact('rats'));
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
        $rat = $this->Rats->get($id, [
            'contain' => ['OwnerUsers', 'Ratteries', 'MotherRats', 'FatherRats', 'Litters', 'MotherRatteries', 'FatherRatteries', 'Colors', 'Eyecolors', 'Dilutions', 'Markings', 'Earsets', 'Coats', 'DeathPrimaryCauses', 'DeathSecondaryCauses', 'Users', 'States', 'Singularities', 'Rats', 'FChildrenRats', 'MotherLitters', 'FatherLitters', 'Conversations', 'RatSnapshots'],
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
        $motherRats = $this->Rats->MotherRats->find('list', ['limit' => 200]);
        $fatherRats = $this->Rats->FatherRats->find('list', ['limit' => 200]);
        $litters = $this->Rats->Litters->find('list', ['limit' => 200]);
        $motherRatteries = $this->Rats->MotherRatteries->find('list', ['limit' => 200]);
        $fatherRatteries = $this->Rats->FatherRatteries->find('list', ['limit' => 200]);
        $colors = $this->Rats->Colors->find('list', ['limit' => 200]);
        $eyecolors = $this->Rats->Eyecolors->find('list', ['limit' => 200]);
        $dilutions = $this->Rats->Dilutions->find('list', ['limit' => 200]);
        $markings = $this->Rats->Markings->find('list', ['limit' => 200]);
        $earsets = $this->Rats->Earsets->find('list', ['limit' => 200]);
        $coats = $this->Rats->Coats->find('list', ['limit' => 200]);
        $deathPrimaryCauses = $this->Rats->DeathPrimaryCauses->find('list', ['limit' => 200]);
        $deathSecondaryCauses = $this->Rats->DeathSecondaryCauses->find('list', ['limit' => 200]);
        $users = $this->Rats->Users->find('list', ['limit' => 200]);
        $states = $this->Rats->States->find('list', ['limit' => 200]);
        $singularities = $this->Rats->Singularities->find('list', ['limit' => 200]);
        $this->set(compact('rat', 'ownerUsers', 'ratteries', 'motherRats', 'fatherRats', 'litters', 'motherRatteries', 'fatherRatteries', 'colors', 'eyecolors', 'dilutions', 'markings', 'earsets', 'coats', 'deathPrimaryCauses', 'deathSecondaryCauses', 'users', 'states', 'singularities'));
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
            'contain' => ['Singularities'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rat = $this->Rats->patchEntity($rat, $this->request->getData());
            if ($this->Rats->save($rat)) {
                $this->Flash->success(__('The rat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rat could not be saved. Please, try again.'));
        }
        $ownerUsers = $this->Rats->OwnerUsers->find('list', ['limit' => 200]);
        $ratteries = $this->Rats->Ratteries->find('list', ['limit' => 200]);
        $motherRats = $this->Rats->MotherRats->find('list', ['limit' => 200]);
        $fatherRats = $this->Rats->FatherRats->find('list', ['limit' => 200]);
        $litters = $this->Rats->Litters->find('list', ['limit' => 200]);
        $motherRatteries = $this->Rats->MotherRatteries->find('list', ['limit' => 200]);
        $fatherRatteries = $this->Rats->FatherRatteries->find('list', ['limit' => 200]);
        $colors = $this->Rats->Colors->find('list', ['limit' => 200]);
        $eyecolors = $this->Rats->Eyecolors->find('list', ['limit' => 200]);
        $dilutions = $this->Rats->Dilutions->find('list', ['limit' => 200]);
        $markings = $this->Rats->Markings->find('list', ['limit' => 200]);
        $earsets = $this->Rats->Earsets->find('list', ['limit' => 200]);
        $coats = $this->Rats->Coats->find('list', ['limit' => 200]);
        $deathPrimaryCauses = $this->Rats->DeathPrimaryCauses->find('list', ['limit' => 200]);
        $deathSecondaryCauses = $this->Rats->DeathSecondaryCauses->find('list', ['limit' => 200]);
        $users = $this->Rats->Users->find('list', ['limit' => 200]);
        $states = $this->Rats->States->find('list', ['limit' => 200]);
        $singularities = $this->Rats->Singularities->find('list', ['limit' => 200]);
        $this->set(compact('rat', 'ownerUsers', 'ratteries', 'motherRats', 'fatherRats', 'litters', 'motherRatteries', 'fatherRatteries', 'colors', 'eyecolors', 'dilutions', 'markings', 'earsets', 'coats', 'deathPrimaryCauses', 'deathSecondaryCauses', 'users', 'states', 'singularities'));
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
        if ($this->Rats->delete($rat)) {
            $this->Flash->success(__('The rat has been deleted.'));
        } else {
            $this->Flash->error(__('The rat could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
