<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Conversations Controller
 *
 * @property \App\Model\Table\ConversationsTable $Conversations
 *
 * @method \App\Model\Entity\Conversation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConversationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Ratteries', 'Litters', 'Rats'],
        ];
        $conversations = $this->paginate($this->Conversations);

        $this->set(compact('conversations'));
    }

    /**
     * View method
     *
     * @param string|null $id Conversation id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $conversation = $this->Conversations->get($id, [
            'contain' => ['Ratteries', 'Litters', 'Rats', 'Users', 'Messages'],
        ]);

        $this->set('conversation', $conversation);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $conversation = $this->Conversations->newEmptyEntity();
        if ($this->request->is('post')) {
            $conversation = $this->Conversations->patchEntity($conversation, $this->request->getData());
            if ($this->Conversations->save($conversation)) {
                $this->Flash->success(__('The conversation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The conversation could not be saved. Please, try again.'));
        }
        $ratteries = $this->Conversations->Ratteries->find('list', ['limit' => 200]);
        $litters = $this->Conversations->Litters->find('list', ['limit' => 200]);
        $rats = $this->Conversations->Rats->find('list', ['limit' => 200]);
        $users = $this->Conversations->Users->find('list', ['limit' => 200]);
        $this->set(compact('conversation', 'ratteries', 'litters', 'rats', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Conversation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $conversation = $this->Conversations->get($id, [
            'contain' => ['Users'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $conversation = $this->Conversations->patchEntity($conversation, $this->request->getData());
            if ($this->Conversations->save($conversation)) {
                $this->Flash->success(__('The conversation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The conversation could not be saved. Please, try again.'));
        }
        $ratteries = $this->Conversations->Ratteries->find('list', ['limit' => 200]);
        $litters = $this->Conversations->Litters->find('list', ['limit' => 200]);
        $rats = $this->Conversations->Rats->find('list', ['limit' => 200]);
        $users = $this->Conversations->Users->find('list', ['limit' => 200]);
        $this->set(compact('conversation', 'ratteries', 'litters', 'rats', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Conversation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $conversation = $this->Conversations->get($id);
        if ($this->Conversations->delete($conversation)) {
            $this->Flash->success(__('The conversation has been deleted.'));
        } else {
            $this->Flash->error(__('The conversation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
