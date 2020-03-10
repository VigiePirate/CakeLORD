<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Litters Controller
 *
 * @property \App\Model\Table\LittersTable $Litters
 *
 * @method \App\Model\Entity\Litter[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LittersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['index', 'view']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $this->paginate = [
            'contain' => ['Users', 'States'],
        ];
        $litters = $this->paginate($this->Litters);

        $this->set(compact('litters'));
    }

    /**
     * View method
     *
     * @param string|null $id Litter id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $litter = $this->Litters->get($id, [
            'contain' => ['Users', 'States', 'OffspringRats', 'ParentRats', 'Ratteries', 'Conversations', 'LitterSnapshots'],
        ]);

        $this->set('litter', $litter);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $litter = $this->Litters->newEmptyEntity();
        $this->Authorization->authorize($litter);
        if ($this->request->is('post')) {
            $litter = $this->Litters->patchEntity($litter, $this->request->getData());
            if ($this->Litters->save($litter)) {
                $this->Flash->success(__('The litter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The litter could not be saved. Please, try again.'));
        }
        $users = $this->Litters->Users->find('list', ['limit' => 200]);
        $states = $this->Litters->States->find('list', ['limit' => 200]);
        $parentRats = $this->Litters->ParentRats->find('list', ['limit' => 200]);
        $ratteries = $this->Litters->Ratteries->find('list', ['limit' => 200]);
        $this->set(compact('litter', 'users', 'states', 'parentRats', 'ratteries'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Litter id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $litter = $this->Litters->get($id, [
            'contain' => ['ParentRats', 'Ratteries'],
        ]);
        $this->Authorization->authorize($litter);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $litter = $this->Litters->patchEntity($litter, $this->request->getData());
            if ($this->Litters->save($litter)) {
                $this->Flash->success(__('The litter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The litter could not be saved. Please, try again.'));
        }
        $users = $this->Litters->Users->find('list', ['limit' => 200]);
        $states = $this->Litters->States->find('list', ['limit' => 200]);
        $parentRats = $this->Litters->ParentRats->find('list', ['limit' => 200]);
        $ratteries = $this->Litters->Ratteries->find('list', ['limit' => 200]);
        $this->set(compact('litter', 'users', 'states', 'parentRats', 'ratteries'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Litter id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $litter = $this->Litters->get($id);
        $this->Authorization->authorize($litter);
        if ($this->Litters->delete($litter)) {
            $this->Flash->success(__('The litter has been deleted.'));
        } else {
            $this->Flash->error(__('The litter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
