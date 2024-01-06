<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * LitterMessages Controller
 *
 * @property \App\Model\Table\LitterMessagesTable $LitterMessages
 * @method \App\Model\Entity\LitterMessage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LitterMessagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->authorize($this->LitterMessages);
        $litterMessages = $this->paginate($this->LitterMessages->find()->contain(['Litters', 'Users']));
        $this->set(compact('litterMessages'));
    }

    /**
     * View method
     *
     * @param string|null $id Litter Message id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $litterMessage = $this->LitterMessages->get($id, [
            'contain' => ['Litters', 'Users'],
        ]);

        $this->set(compact('litterMessage'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $litterMessage = $this->LitterMessages->newEmptyEntity();
        if ($this->request->is('post')) {
            $litterMessage = $this->LitterMessages->patchEntity($litterMessage, $this->request->getData());
            if ($this->LitterMessages->save($litterMessage)) {
                $this->Flash->success(__('The litter message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The litter message could not be saved. Please, try again.'));
        }
        $litters = $this->LitterMessages->Litters->find('list', ['limit' => 200])->all();
        $users = $this->LitterMessages->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('litterMessage', 'litters', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Litter Message id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $litterMessage = $this->LitterMessages->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $litterMessage = $this->LitterMessages->patchEntity($litterMessage, $this->request->getData());
            if ($this->LitterMessages->save($litterMessage)) {
                $this->Flash->success(__('The litter message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The litter message could not be saved. Please, try again.'));
        }
        $litters = $this->LitterMessages->Litters->find('list', ['limit' => 200])->all();
        $users = $this->LitterMessages->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('litterMessage', 'litters', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Litter Message id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $litterMessage = $this->LitterMessages->get($id);
        if ($this->LitterMessages->delete($litterMessage)) {
            $this->Flash->success(__('The litter message has been deleted.'));
        } else {
            $this->Flash->error(__('The litter message could not be deleted. Please, try again.'));
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

        $settings = [
            'sortableFields' => [
                'created',
                'is_staff_request',
                'is_automatically_generated',
                'Litters.birth_date',
                'Users.username',
            ]
        ];

        $query = $this->LitterMessages
            ->find('entitled', ['user_id' => $user->id])
            ->contain([
                'Litters',
                'Litters.Sire',
                'Litters.Sire.BirthLitters.Contributions',
                'Litters.Dam',
                'Litters.Dam.BirthLitters.Contributions',
                'Litters.LitterMessages' => ['sort' => 'LitterMessages.created DESC'],
                'Litters.States',
                'Users',
            ]);

        $litterMessages = $this->paginate($query, $settings);
        $this->set(compact('litterMessages'));
    }
}
