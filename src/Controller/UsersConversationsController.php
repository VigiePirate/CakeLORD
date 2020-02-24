<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * UsersConversations Controller
 *
 *
 * @method \App\Model\Entity\UsersConversation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersConversationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $usersConversations = $this->paginate($this->UsersConversations);

        $this->set(compact('usersConversations'));
    }

    /**
     * View method
     *
     * @param string|null $id Users Conversation id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersConversation = $this->UsersConversations->get($id, [
            'contain' => [],
        ]);

        $this->set('usersConversation', $usersConversation);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usersConversation = $this->UsersConversations->newEmptyEntity();
        if ($this->request->is('post')) {
            $usersConversation = $this->UsersConversations->patchEntity($usersConversation, $this->request->getData());
            if ($this->UsersConversations->save($usersConversation)) {
                $this->Flash->success(__('The users conversation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users conversation could not be saved. Please, try again.'));
        }
        $this->set(compact('usersConversation'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Conversation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usersConversation = $this->UsersConversations->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersConversation = $this->UsersConversations->patchEntity($usersConversation, $this->request->getData());
            if ($this->UsersConversations->save($usersConversation)) {
                $this->Flash->success(__('The users conversation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users conversation could not be saved. Please, try again.'));
        }
        $this->set(compact('usersConversation'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Conversation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersConversation = $this->UsersConversations->get($id);
        if ($this->UsersConversations->delete($usersConversation)) {
            $this->Flash->success(__('The users conversation has been deleted.'));
        } else {
            $this->Flash->error(__('The users conversation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
