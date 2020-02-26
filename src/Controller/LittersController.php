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
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Ratteries', 'MotherRats', 'FatherRats', 'Users', 'States'],
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
        $litter = $this->Litters->get($id, [
            'contain' => ['Ratteries', 'MotherRats', 'FatherRats', 'Users', 'States', 'Conversations', 'LitterSnapshots', 'Rats'],
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
        if ($this->request->is('post')) {
            $litter = $this->Litters->patchEntity($litter, $this->request->getData());
            if ($this->Litters->save($litter)) {
                $this->Flash->success(__('The litter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The litter could not be saved. Please, try again.'));
        }
        $ratteries = $this->Litters->Ratteries->find('list', ['limit' => 200]);
        $motherRats = $this->Litters->MotherRats->find('list', ['limit' => 200]);
        $fatherRats = $this->Litters->FatherRats->find('list', ['limit' => 200]);
        $users = $this->Litters->Users->find('list', ['limit' => 200]);
        $states = $this->Litters->States->find('list', ['limit' => 200]);
        $this->set(compact('litter', 'ratteries', 'motherRats', 'fatherRats', 'users', 'states'));
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
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $litter = $this->Litters->patchEntity($litter, $this->request->getData());
            if ($this->Litters->save($litter)) {
                $this->Flash->success(__('The litter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The litter could not be saved. Please, try again.'));
        }
        $ratteries = $this->Litters->Ratteries->find('list', ['limit' => 200]);
        $motherRats = $this->Litters->MotherRats->find('list', ['limit' => 200]);
        $fatherRats = $this->Litters->FatherRats->find('list', ['limit' => 200]);
        $users = $this->Litters->Users->find('list', ['limit' => 200]);
        $states = $this->Litters->States->find('list', ['limit' => 200]);
        $this->set(compact('litter', 'ratteries', 'motherRats', 'fatherRats', 'users', 'states'));
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
        if ($this->Litters->delete($litter)) {
            $this->Flash->success(__('The litter has been deleted.'));
        } else {
            $this->Flash->error(__('The litter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
