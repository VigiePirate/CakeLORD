<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * BackofficeRatMessages Controller
 *
 * @property \App\Model\Table\BackofficeRatMessagesTable $BackofficeRatMessages
 *
 * @method \App\Model\Entity\BackofficeRatMessage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BackofficeRatMessagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['BackofficeRatEntries', 'Users'],
        ];
        $backofficeRatMessages = $this->paginate($this->BackofficeRatMessages);

        $this->set(compact('backofficeRatMessages'));
    }

    /**
     * View method
     *
     * @param string|null $id Backoffice Rat Message id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $backofficeRatMessage = $this->BackofficeRatMessages->get($id, [
            'contain' => ['BackofficeRatEntries', 'Users'],
        ]);

        $this->set('backofficeRatMessage', $backofficeRatMessage);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $backofficeRatMessage = $this->BackofficeRatMessages->newEmptyEntity();
        if ($this->request->is('post')) {
            $backofficeRatMessage = $this->BackofficeRatMessages->patchEntity($backofficeRatMessage, $this->request->getData());
            if ($this->BackofficeRatMessages->save($backofficeRatMessage)) {
                $this->Flash->success(__('The backoffice rat message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The backoffice rat message could not be saved. Please, try again.'));
        }
        $backofficeRatEntries = $this->BackofficeRatMessages->BackofficeRatEntries->find('list', ['limit' => 200]);
        $users = $this->BackofficeRatMessages->Users->find('list', ['limit' => 200]);
        $this->set(compact('backofficeRatMessage', 'backofficeRatEntries', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Backoffice Rat Message id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $backofficeRatMessage = $this->BackofficeRatMessages->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $backofficeRatMessage = $this->BackofficeRatMessages->patchEntity($backofficeRatMessage, $this->request->getData());
            if ($this->BackofficeRatMessages->save($backofficeRatMessage)) {
                $this->Flash->success(__('The backoffice rat message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The backoffice rat message could not be saved. Please, try again.'));
        }
        $backofficeRatEntries = $this->BackofficeRatMessages->BackofficeRatEntries->find('list', ['limit' => 200]);
        $users = $this->BackofficeRatMessages->Users->find('list', ['limit' => 200]);
        $this->set(compact('backofficeRatMessage', 'backofficeRatEntries', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Backoffice Rat Message id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $backofficeRatMessage = $this->BackofficeRatMessages->get($id);
        if ($this->BackofficeRatMessages->delete($backofficeRatMessage)) {
            $this->Flash->success(__('The backoffice rat message has been deleted.'));
        } else {
            $this->Flash->error(__('The backoffice rat message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
