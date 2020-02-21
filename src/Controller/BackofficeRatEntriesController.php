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
            'contain' => ['Rats', 'DeathCausesPrimary', 'DeathCausesSecondary', 'Ratteries', 'BackofficeRatEntries', 'Users', 'Colors', 'Earsets', 'Eyecolors', 'Dilutions', 'Coats', 'Markings'],
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
            'contain' => ['Rats', 'DeathCausesPrimary', 'DeathCausesSecondary', 'Ratteries', 'BackofficeRatEntries', 'Users', 'Colors', 'Earsets', 'Eyecolors', 'Dilutions', 'Coats', 'Markings', 'BackofficeRatMessages'],
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
        $deathCausesPrimary = $this->BackofficeRatEntries->DeathCausesPrimary->find('list', ['limit' => 200]);
        $deathCausesSecondary = $this->BackofficeRatEntries->DeathCausesSecondary->find('list', ['limit' => 200]);
        $ratteries = $this->BackofficeRatEntries->Ratteries->find('list', ['limit' => 200]);
        $backofficeRatEntries = $this->BackofficeRatEntries->BackofficeRatEntries->find('list', ['limit' => 200]);
        $users = $this->BackofficeRatEntries->Users->find('list', ['limit' => 200]);
        $colors = $this->BackofficeRatEntries->Colors->find('list', ['limit' => 200]);
        $earsets = $this->BackofficeRatEntries->Earsets->find('list', ['limit' => 200]);
        $eyecolors = $this->BackofficeRatEntries->Eyecolors->find('list', ['limit' => 200]);
        $dilutions = $this->BackofficeRatEntries->Dilutions->find('list', ['limit' => 200]);
        $coats = $this->BackofficeRatEntries->Coats->find('list', ['limit' => 200]);
        $markings = $this->BackofficeRatEntries->Markings->find('list', ['limit' => 200]);
        $this->set(compact('backofficeRatEntry', 'rats', 'deathCausesPrimary', 'deathCausesSecondary', 'ratteries', 'backofficeRatEntries', 'users', 'colors', 'earsets', 'eyecolors', 'dilutions', 'coats', 'markings'));
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
            'contain' => [],
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
        $deathCausesPrimary = $this->BackofficeRatEntries->DeathCausesPrimary->find('list', ['limit' => 200]);
        $deathCausesSecondary = $this->BackofficeRatEntries->DeathCausesSecondary->find('list', ['limit' => 200]);
        $ratteries = $this->BackofficeRatEntries->Ratteries->find('list', ['limit' => 200]);
        $backofficeRatEntries = $this->BackofficeRatEntries->BackofficeRatEntries->find('list', ['limit' => 200]);
        $users = $this->BackofficeRatEntries->Users->find('list', ['limit' => 200]);
        $colors = $this->BackofficeRatEntries->Colors->find('list', ['limit' => 200]);
        $earsets = $this->BackofficeRatEntries->Earsets->find('list', ['limit' => 200]);
        $eyecolors = $this->BackofficeRatEntries->Eyecolors->find('list', ['limit' => 200]);
        $dilutions = $this->BackofficeRatEntries->Dilutions->find('list', ['limit' => 200]);
        $coats = $this->BackofficeRatEntries->Coats->find('list', ['limit' => 200]);
        $markings = $this->BackofficeRatEntries->Markings->find('list', ['limit' => 200]);
        $this->set(compact('backofficeRatEntry', 'rats', 'deathCausesPrimary', 'deathCausesSecondary', 'ratteries', 'backofficeRatEntries', 'users', 'colors', 'earsets', 'eyecolors', 'dilutions', 'coats', 'markings'));
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
