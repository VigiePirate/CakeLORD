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
        $this->Authorization->authorize($this->RatMessages);

        $query = $this->RatMessages
            ->find()
            ->contain([
                'Rats',
                'Rats.Ratteries',
                'Rats.CreatorUsers',
                'Rats.OwnerUsers',
                'Rats.BirthLitters',
                'Rats.BirthLitters.Contributions',
                'Rats.States',
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
                'Rats.pedigree_identifier',
                'Users.username',
            ]
        ];

        $ratMessages = $this->paginate($query, $settings);

        $this->set(compact('ratMessages'));
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
            'contain' => [
                'Users',
                'Rats',
                'Rats.Ratteries',
                'Rats.BirthLitters',
                'Rats.BirthLitters.Contributions',
            ],
        ]);

        $this->Authorization->authorize($ratMessage);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $ratMessage = $this->RatMessages->patchEntity($ratMessage, $this->request->getData());
            if ($this->RatMessages->save($ratMessage)) {
                $this->Flash->success(__('The message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message could not be saved. Please, try again.'));
        }
        $identity = $this->request->getAttribute('identity');
        $this->set(compact('ratMessage', 'identity'));
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
        $this->Authorization->authorize($ratMessage);
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
        $this->Authorization->authorize($this->RatMessages);

        $rats = $this->fetchModel('Rats')->find('entitledBy', ['user_id' => $user->id, 'level' => 2]);
        $query = $this->RatMessages
            ->find()
            ->contain([
                'Rats.Ratteries',
                'Rats.BirthLitters',
                'Rats.BirthLitters.Contributions',
                'Rats.States',
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
                    'Rats.pedigree_identifier',
                    'Users.username',
                ]
            ];

        $ratMessages = $this->paginate($query, $settings);

        $this->set(compact('ratMessages'));
    }
}
