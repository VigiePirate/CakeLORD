<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Litters Controller
 *
 * @property \App\Model\Table\LittersTable $Litters
 * @method \App\Model\Entity\Litter[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LittersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'States', 'Sire', 'Dam'],
        ];
        $litters = $this->paginate($this->Litters);

        $this->set(compact('litters'));
    }

    /**
     * View method
     *
     * @param string|null $id Litter id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $litter = $this->Litters->get($id, [
            'contain' => ['Users', 'States', 'ParentRats', 'Contributions', 'Conversations', 'LitterSnapshots', 'OffspringRats'],
        ]);

        $this->set('litter', $litter);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $litter = $this->Litters->newEmptyEntity();
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
        $contributions = $this->Litters->Contributions->find('list', ['limit' => 200]);
        $this->set(compact('litter', 'users', 'states', 'parentRats', 'ratteries', 'contributions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Litter id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $litter = $this->Litters->get($id, [
            'contain' => ['ParentRats', 'Ratteries', 'Contributions'],
        ]);
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
        $contributions = $this->Litters->Contributions->find('list', ['limit' => 200]);
        $this->set(compact('litter', 'users', 'states', 'parentRats', 'ratteries', 'contributions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Litter id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $litter = $this->Litters->get($id);
        if ($this->Litters->delete($litter)) {
            $this->Flash->success(__('The litter has been deleted.'));
        } else {
            $this->Flash->error(__('The litter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
