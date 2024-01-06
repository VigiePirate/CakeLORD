<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * RatteryMessages Controller
 *
 * @property \App\Model\Table\RatteryMessagesTable $RatteryMessages
 * @method \App\Model\Entity\RatteryMessage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RatteryMessagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $ratteryMessages = $this->paginate($this->RatteryMessages->find()->contain(['Ratteries', 'Users']));
        $this->set(compact('ratteryMessages'));
    }

    /**
     * View method
     *
     * @param string|null $id Rattery Message id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ratteryMessage = $this->RatteryMessages->get($id, [
            'contain' => ['Ratteries', 'Users'],
        ]);

        $this->set(compact('ratteryMessage'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ratteryMessage = $this->RatteryMessages->newEmptyEntity();
        if ($this->request->is('post')) {
            $ratteryMessage = $this->RatteryMessages->patchEntity($ratteryMessage, $this->request->getData());
            if ($this->RatteryMessages->save($ratteryMessage)) {
                $this->Flash->success(__('The rattery message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rattery message could not be saved. Please, try again.'));
        }
        $ratteries = $this->RatteryMessages->Ratteries->find('list', ['limit' => 200])->all();
        $users = $this->RatteryMessages->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('ratteryMessage', 'ratteries', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rattery Message id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ratteryMessage = $this->RatteryMessages->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ratteryMessage = $this->RatteryMessages->patchEntity($ratteryMessage, $this->request->getData());
            if ($this->RatteryMessages->save($ratteryMessage)) {
                $this->Flash->success(__('The rattery message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rattery message could not be saved. Please, try again.'));
        }
        $ratteries = $this->RatteryMessages->Ratteries->find('list', ['limit' => 200])->all();
        $users = $this->RatteryMessages->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('ratteryMessage', 'ratteries', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rattery Message id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ratteryMessage = $this->RatteryMessages->get($id);
        if ($this->RatteryMessages->delete($ratteryMessage)) {
            $this->Flash->success(__('The rattery message has been deleted.'));
        } else {
            $this->Flash->error(__('The rattery message could not be deleted. Please, try again.'));
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
            'order' => [
                'created' => 'desc',
            ],
            'sortableFields' => [
                'created',
                'is_staff_request',
                'is_automatically_generated',
                'Ratteries.prefix',
                'Users.username',
            ]
        ];
        $ratteryMessages = $this->RatteryMessages
            ->find('entitled', ['user_id' => $user->id])
            ->contain([
                'Ratteries',
                'Ratteries.RatteryMessages' => ['sort' => 'RatteryMessages.created DESC'],
                'Ratteries.States',
                'Users',
            ]);

        $this->paginate($ratteryMessages, $settings);

        $this->set(compact('ratteryMessages'));
    }
}
