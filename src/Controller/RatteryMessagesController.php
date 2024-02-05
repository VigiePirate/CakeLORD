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
        $this->Authorization->authorize($this->RatteryMessages);

        $query = $this->RatteryMessages
            ->find()
            ->contain([
                'Ratteries',
                'Ratteries.Users',
                'Ratteries.States',
                'Users'
            ]);

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

        $ratteryMessages = $this->paginate($query, $settings);
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
        $this->Authorization->skipAuthorization();

        $ratteryMessage = $this->RatteryMessages->get($id, [
            'contain' => ['Ratteries', 'Users'],
        ]);

        $this->set(compact('ratteryMessage'));
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
             'contain' => [
                 'Users',
                 'Ratteries'
             ],
         ]);

         $this->Authorization->authorize($ratteryMessage);

         if ($this->request->is(['patch', 'post', 'put'])) {
             $ratteryMessage = $this->RatteryMessages->patchEntity($ratteryMessage, $this->request->getData());
             if ($this->RatteryMessages->save($ratteryMessage)) {
                 $this->Flash->success(__('The message has been saved.'));

                 return $this->redirect(['action' => 'index']);
             }
             $this->Flash->error(__('The message could not be saved. Please, try again.'));
         }
         $identity = $this->request->getAttribute('identity');
         $this->set(compact('ratteryMessage', 'identity'));
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
        $this->Authorization->authorize($ratteryMessage);
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
        $this->Authorization->authorize($this->RatteryMessages);

        $ratteryMessages = $this->RatteryMessages
            ->find('entitled', ['user_id' => $user->id])
            ->contain([
                'Ratteries',
                'Ratteries.RatteryMessages' => ['sort' => 'RatteryMessages.created DESC'],
                'Ratteries.States',
                'Users',
            ]);

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

        $this->paginate($ratteryMessages, $settings);

        $this->set(compact('ratteryMessages'));
    }
}
