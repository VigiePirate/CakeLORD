<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * BackofficeRatteryMessages Controller
 *
 * @property \App\Model\Table\BackofficeRatteryMessagesTable $BackofficeRatteryMessages
 *
 * @method \App\Model\Entity\BackofficeRatteryMessage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BackofficeRatteryMessagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Ratteries', 'Users'],
        ];
        $backofficeRatteryMessages = $this->paginate($this->BackofficeRatteryMessages);

        $this->set(compact('backofficeRatteryMessages'));
    }

    /**
     * View method
     *
     * @param string|null $id Backoffice Rattery Message id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $backofficeRatteryMessage = $this->BackofficeRatteryMessages->get($id, [
            'contain' => ['Ratteries', 'Users'],
        ]);

        $this->set('backofficeRatteryMessage', $backofficeRatteryMessage);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $backofficeRatteryMessage = $this->BackofficeRatteryMessages->newEmptyEntity();
        if ($this->request->is('post')) {
            $backofficeRatteryMessage = $this->BackofficeRatteryMessages->patchEntity($backofficeRatteryMessage, $this->request->getData());
            if ($this->BackofficeRatteryMessages->save($backofficeRatteryMessage)) {
                $this->Flash->success(__('The backoffice rattery message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The backoffice rattery message could not be saved. Please, try again.'));
        }
        $ratteries = $this->BackofficeRatteryMessages->Ratteries->find('list', ['limit' => 200]);
        $users = $this->BackofficeRatteryMessages->Users->find('list', ['limit' => 200]);
        $this->set(compact('backofficeRatteryMessage', 'ratteries', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Backoffice Rattery Message id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $backofficeRatteryMessage = $this->BackofficeRatteryMessages->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $backofficeRatteryMessage = $this->BackofficeRatteryMessages->patchEntity($backofficeRatteryMessage, $this->request->getData());
            if ($this->BackofficeRatteryMessages->save($backofficeRatteryMessage)) {
                $this->Flash->success(__('The backoffice rattery message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The backoffice rattery message could not be saved. Please, try again.'));
        }
        $ratteries = $this->BackofficeRatteryMessages->Ratteries->find('list', ['limit' => 200]);
        $users = $this->BackofficeRatteryMessages->Users->find('list', ['limit' => 200]);
        $this->set(compact('backofficeRatteryMessage', 'ratteries', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Backoffice Rattery Message id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $backofficeRatteryMessage = $this->BackofficeRatteryMessages->get($id);
        if ($this->BackofficeRatteryMessages->delete($backofficeRatteryMessage)) {
            $this->Flash->success(__('The backoffice rattery message has been deleted.'));
        } else {
            $this->Flash->error(__('The backoffice rattery message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
