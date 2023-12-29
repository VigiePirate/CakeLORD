<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * RatMessages Controller
 *
 * @property \App\Model\Table\RatMessagesTable $RatMessages
 * @method \App\Model\Entity\RatMessage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RatMessagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $this->paginate = [
            'contain' => [
                'Rats',
                'Rats.Ratteries',
                'Rats.CreatorUsers',
                'Rats.OwnerUsers',
                'Rats.BirthLitters',
                'Rats.BirthLitters.Contributions',
                // in order to know if each message is the last one for this rat
                'Rats.RatMessages' =>  function($q) {
                    return $q
                    ->order('RatMessages.created DESC')
                    ->limit(1);
                },
                'Rats.States',
                'Users'
            ]
        ];

        $ratMessages = $this->paginate($this->RatMessages);

        $this->set(compact('ratMessages'));
    }

    /**
     * View method
     *
     * @param string|null $id Rat Message id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();

        $ratMessage = $this->RatMessages->get($id, [
            'contain' => ['Rats', 'Users'],
        ]);

        $this->set(compact('ratMessage'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ratMessage = $this->RatMessages->newEmptyEntity();
        if ($this->request->is('post')) {
            $ratMessage = $this->RatMessages->patchEntity($ratMessage, $this->request->getData());
            if ($this->RatMessages->save($ratMessage)) {
                $this->Flash->success(__('The rat message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rat message could not be saved. Please, try again.'));
        }
        $rats = $this->RatMessages->Rats->find('list', ['limit' => 200])->all();
        $users = $this->RatMessages->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('ratMessage', 'rats', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rat Message id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ratMessage = $this->RatMessages->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ratMessage = $this->RatMessages->patchEntity($ratMessage, $this->request->getData());
            if ($this->RatMessages->save($ratMessage)) {
                $this->Flash->success(__('The rat message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rat message could not be saved. Please, try again.'));
        }
        $rats = $this->RatMessages->Rats->find('list', ['limit' => 200])->all();
        $users = $this->RatMessages->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('ratMessage', 'rats', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rat Message id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ratMessage = $this->RatMessages->get($id);
        if ($this->RatMessages->delete($ratMessage)) {
            $this->Flash->success(__('The rat message has been deleted.'));
        } else {
            $this->Flash->error(__('The rat message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * My method
     *
     * @return \Cake\Http\Response|null
     */
    public function my()
    {
        $user = $this->Authentication->getIdentity();
        $this->Authorization->skipAuthorization();
        $this->paginate = [
            'contain' => [
                'Rats',
                'Rats.Ratteries',
                'Rats.BirthLitters',
                'Rats.BirthLitters.Contributions',
                'Rats.States',
                'Users',
            ],
        ];

        $ratMessages = $this->RatMessages->find('entitled', ['user_id' => $user->id]);

        $this->paginate($ratMessages);

        $this->set(compact('ratMessages'));
    }
}
