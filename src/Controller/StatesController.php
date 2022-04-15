<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * States Controller
 *
 * @property \App\Model\Table\StatesTable $States
 * @method \App\Model\Entity\State[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StatesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['NextOkStates', 'NextKoStates', 'NextFrozenStates', 'NextThawedStates'],
        ];
        $states = $this->paginate($this->States);

        $this->set(compact('states'));
    }

    /**
     * View method
     *
     * @param string|null $id State id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $state = $this->States->get($id, [
            'contain' => ['NextOkStates', 'NextKoStates', 'NextFrozenStates', 'NextThawedStates'],
        ]);

        $counts = [
            'rats' => $state->countMy('rats', 'state'),
            'ratteries' => $state->countMy('rats', 'state'),
            'litters' => $state->countMy('litters', 'state')
        ];

        $this->set(compact('state', 'counts'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $state = $this->States->newEmptyEntity();
        if ($this->request->is('post')) {
            $state = $this->States->patchEntity($state, $this->request->getData());
            if ($this->States->save($state)) {
                $this->Flash->success(__('The state has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The state could not be saved. Please, try again.'));
        }
        $nextOkStates = $this->States->NextOkStates->find('list', ['limit' => 200]);
        $nextKoStates = $this->States->NextKoStates->find('list', ['limit' => 200]);
        $nextFrozenStates = $this->States->NextFrozenStates->find('list', ['limit' => 200]);
        $nextThawedStates = $this->States->NextThawedStates->find('list', ['limit' => 200]);
        $this->set(compact('state', 'nextOkStates', 'nextKoStates', 'nextFrozenStates', 'nextThawedStates'));
    }

    /**
     * Edit method
     *
     * @param string|null $id State id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $state = $this->States->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $state = $this->States->patchEntity($state, $this->request->getData());
            if ($this->States->save($state)) {
                $this->Flash->success(__('The state has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The state could not be saved. Please, try again.'));
        }
        $nextOkStates = $this->States->NextOkStates->find('list', ['limit' => 200]);
        $nextKoStates = $this->States->NextKoStates->find('list', ['limit' => 200]);
        $nextFrozenStates = $this->States->NextFrozenStates->find('list', ['limit' => 200]);
        $nextThawedStates = $this->States->NextThawedStates->find('list', ['limit' => 200]);
        $this->set(compact('state', 'nextOkStates', 'nextKoStates', 'nextFrozenStates', 'nextThawedStates'));
    }

    /**
     * Delete method
     *
     * @param string|null $id State id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $state = $this->States->get($id);
        if ($this->States->delete($state)) {
            $this->Flash->success(__('The state has been deleted.'));
        } else {
            $this->Flash->error(__('The state could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
