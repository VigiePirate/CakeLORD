<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * BackofficeRatEntries Controller
 *
 * @property \App\Model\Table\BackofficeRatEntriesTable $BackofficeRatEntries
 *
 * @method \App\Model\Entity\BackofficeRatEntry[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BackofficeRatEntriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Rats', 'PrimaryDeathCauses', 'SecondaryDeathCauses', 'MotherRatteries', 'FatherRatteries', 'MotherRats', 'FatherRats', 'OwnerUsers', 'Colors', 'Earsets', 'Eyecolors', 'Dilutions', 'Coats', 'Markings', 'CreatorUsers', 'States'],
        ];
        $backofficeRatEntries = $this->paginate($this->BackofficeRatEntries);

        $this->set(compact('backofficeRatEntries'));
    }

    /**
     * View method
     *
     * @param string|null $id Backoffice Rat Entry id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $backofficeRatEntry = $this->BackofficeRatEntries->get($id, [
            'contain' => ['Rats', 'PrimaryDeathCauses', 'SecondaryDeathCauses', 'MotherRatteries', 'FatherRatteries', 'MotherRats', 'FatherRats', 'OwnerUsers', 'Colors', 'Earsets', 'Eyecolors', 'Dilutions', 'Coats', 'Markings', 'CreatorUsers', 'States', 'Singularities', 'BackofficeRatMessages'],
        ]);

        $this->set('backofficeRatEntry', $backofficeRatEntry);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $backofficeRatEntry = $this->BackofficeRatEntries->newEmptyEntity();
        if ($this->request->is('post')) {
            $backofficeRatEntry = $this->BackofficeRatEntries->patchEntity($backofficeRatEntry, $this->request->getData());
            if ($this->BackofficeRatEntries->save($backofficeRatEntry)) {
                $this->Flash->success(__('The backoffice rat entry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The backoffice rat entry could not be saved. Please, try again.'));
        }
        $rats = $this->BackofficeRatEntries->Rats->find('list', ['limit' => 200]);
        $primaryDeathCauses = $this->BackofficeRatEntries->PrimaryDeathCauses->find('list', ['limit' => 200]);
        $secondaryDeathCauses = $this->BackofficeRatEntries->SecondaryDeathCauses->find('list', ['limit' => 200]);
        $motherRatteries = $this->BackofficeRatEntries->MotherRatteries->find('list', ['limit' => 200]);
        $fatherRatteries = $this->BackofficeRatEntries->FatherRatteries->find('list', ['limit' => 200]);
        $motherRats = $this->BackofficeRatEntries->MotherRats->find('list', ['limit' => 200]);
        $fatherRats = $this->BackofficeRatEntries->FatherRats->find('list', ['limit' => 200]);
        $ownerUsers = $this->BackofficeRatEntries->OwnerUsers->find('list', ['limit' => 200]);
        $colors = $this->BackofficeRatEntries->Colors->find('list', ['limit' => 200]);
        $earsets = $this->BackofficeRatEntries->Earsets->find('list', ['limit' => 200]);
        $eyecolors = $this->BackofficeRatEntries->Eyecolors->find('list', ['limit' => 200]);
        $dilutions = $this->BackofficeRatEntries->Dilutions->find('list', ['limit' => 200]);
        $coats = $this->BackofficeRatEntries->Coats->find('list', ['limit' => 200]);
        $markings = $this->BackofficeRatEntries->Markings->find('list', ['limit' => 200]);
        $creatorUsers = $this->BackofficeRatEntries->CreatorUsers->find('list', ['limit' => 200]);
        $states = $this->BackofficeRatEntries->States->find('list', ['limit' => 200]);
        $singularities = $this->BackofficeRatEntries->Singularities->find('list', ['limit' => 200]);
        $this->set(compact('backofficeRatEntry', 'rats', 'primaryDeathCauses', 'secondaryDeathCauses', 'motherRatteries', 'fatherRatteries', 'motherRats', 'fatherRats', 'ownerUsers', 'colors', 'earsets', 'eyecolors', 'dilutions', 'coats', 'markings', 'creatorUsers', 'states', 'singularities'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Backoffice Rat Entry id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $backofficeRatEntry = $this->BackofficeRatEntries->get($id, [
            'contain' => ['Singularities'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $backofficeRatEntry = $this->BackofficeRatEntries->patchEntity($backofficeRatEntry, $this->request->getData());
            if ($this->BackofficeRatEntries->save($backofficeRatEntry)) {
                $this->Flash->success(__('The backoffice rat entry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The backoffice rat entry could not be saved. Please, try again.'));
        }
        $rats = $this->BackofficeRatEntries->Rats->find('list', ['limit' => 200]);
        $primaryDeathCauses = $this->BackofficeRatEntries->PrimaryDeathCauses->find('list', ['limit' => 200]);
        $secondaryDeathCauses = $this->BackofficeRatEntries->SecondaryDeathCauses->find('list', ['limit' => 200]);
        $motherRatteries = $this->BackofficeRatEntries->MotherRatteries->find('list', ['limit' => 200]);
        $fatherRatteries = $this->BackofficeRatEntries->FatherRatteries->find('list', ['limit' => 200]);
        $motherRats = $this->BackofficeRatEntries->MotherRats->find('list', ['limit' => 200]);
        $fatherRats = $this->BackofficeRatEntries->FatherRats->find('list', ['limit' => 200]);
        $ownerUsers = $this->BackofficeRatEntries->OwnerUsers->find('list', ['limit' => 200]);
        $colors = $this->BackofficeRatEntries->Colors->find('list', ['limit' => 200]);
        $earsets = $this->BackofficeRatEntries->Earsets->find('list', ['limit' => 200]);
        $eyecolors = $this->BackofficeRatEntries->Eyecolors->find('list', ['limit' => 200]);
        $dilutions = $this->BackofficeRatEntries->Dilutions->find('list', ['limit' => 200]);
        $coats = $this->BackofficeRatEntries->Coats->find('list', ['limit' => 200]);
        $markings = $this->BackofficeRatEntries->Markings->find('list', ['limit' => 200]);
        $creatorUsers = $this->BackofficeRatEntries->CreatorUsers->find('list', ['limit' => 200]);
        $states = $this->BackofficeRatEntries->States->find('list', ['limit' => 200]);
        $singularities = $this->BackofficeRatEntries->Singularities->find('list', ['limit' => 200]);
        $this->set(compact('backofficeRatEntry', 'rats', 'primaryDeathCauses', 'secondaryDeathCauses', 'motherRatteries', 'fatherRatteries', 'motherRats', 'fatherRats', 'ownerUsers', 'colors', 'earsets', 'eyecolors', 'dilutions', 'coats', 'markings', 'creatorUsers', 'states', 'singularities'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Backoffice Rat Entry id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $backofficeRatEntry = $this->BackofficeRatEntries->get($id);
        if ($this->BackofficeRatEntries->delete($backofficeRatEntry)) {
            $this->Flash->success(__('The backoffice rat entry has been deleted.'));
        } else {
            $this->Flash->error(__('The backoffice rat entry could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
