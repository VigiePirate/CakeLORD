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
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Countries', 'States'],
        ];
        $ratteries = $this->paginate($this->Ratteries);

        $this->set(compact('ratteries'));
    }

    /**
     * View method
     *
     * @param string|null $id Rattery id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rattery = $this->Ratteries->get($id, [
            'contain' => ['Users', 'Countries', 'States', 'Conversations', 'Litters', 'Rats', 'MchildrenRats', 'FChildrenRats', 'RatterySnapshots'],
        ]);

        $this->set('rattery', $rattery);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rattery = $this->Ratteries->newEmptyEntity();
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
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
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
        $this->set(compact('rattery', 'users', 'countries', 'states'));
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
        if ($this->Ratteries->delete($rattery)) {
            $this->Flash->success(__('The rattery has been deleted.'));
        } else {
            $this->Flash->error(__('The rattery could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
