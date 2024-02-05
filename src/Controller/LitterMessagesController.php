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

        $query = $this->LitterMessages
            ->find()
            ->contain([
                'Litters',
                'Litters.Sire',
                'Litters.Dam',
                'Litters.Users',
                'Litters.States',
                'Users'
            ]);

        $settings = [
            'sortableFields' => [
                'created',
                'is_staff_request',
                'is_automatically_generated',
                'Litters.birth_date',
                'Users.username',
            ]
        ];

        $litterMessages = $this->paginate($query, $settings);
        $this->set(compact('litterMessages'));
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
             'contain' => [
                 'Users',
                 'Litters',
                 'Litters.Sire',
                 'Litters.Dam',
             ],
         ]);

         $this->Authorization->authorize($litterMessage);

         if ($this->request->is(['patch', 'post', 'put'])) {
             $litterMessage = $this->LitterMessages->patchEntity($litterMessage, $this->request->getData());
             if ($this->LitterMessages->save($litterMessage)) {
                 $this->Flash->success(__('The message has been saved.'));

                 return $this->redirect(['action' => 'index']);
             }
             $this->Flash->error(__('The message could not be saved. Please, try again.'));
         }
         $identity = $this->request->getAttribute('identity');
         $this->set(compact('litterMessage', 'identity'));
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
        $this->Authorization->authorize($litterMessage);
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
        $this->Authorization->authorize($this->LitterMessages);

        $litters = $this->fetchModel('Litters')->find('entitledBy', ['user_id' => $user->id]);
        $query = $this->LitterMessages
            ->find()
            ->where(['litter_id IN' => $litters])
            ->contain([
                'Litters',
                'Litters.Contributions',
                'Litters.Sire',
                'Litters.Sire.BirthLitters.Contributions',
                'Litters.Dam',
                'Litters.Dam.BirthLitters.Contributions',
                'Litters.Users',
                'Litters.States',
                'Users',
            ]);

        $settings = [
            'sortableFields' => [
                'created',
                'is_staff_request',
                'is_automatically_generated',
                'Litters.birth_date',
                'Users.username',
            ]
        ];

        $litterMessages = $this->paginate($query, $settings);
        $this->set(compact('litterMessages'));
    }
}
