<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DeathCausesPrimary Controller
 *
 * @property \App\Model\Table\DeathCausesPrimaryTable $DeathCausesPrimary
 *
 * @method \App\Model\Entity\DeathCausesPrimary[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DeathCausesPrimaryController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $deathCausesPrimary = $this->paginate($this->DeathCausesPrimary);

        $this->set(compact('deathCausesPrimary'));
    }

    /**
     * View method
     *
     * @param string|null $id Death Causes Primary id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $deathCausesPrimary = $this->DeathCausesPrimary->get($id, [
            'contain' => [],
        ]);

        $this->set('deathCausesPrimary', $deathCausesPrimary);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $deathCausesPrimary = $this->DeathCausesPrimary->newEmptyEntity();
        if ($this->request->is('post')) {
            $deathCausesPrimary = $this->DeathCausesPrimary->patchEntity($deathCausesPrimary, $this->request->getData());
            if ($this->DeathCausesPrimary->save($deathCausesPrimary)) {
                $this->Flash->success(__('The death causes primary has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The death causes primary could not be saved. Please, try again.'));
        }
        $this->set(compact('deathCausesPrimary'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Death Causes Primary id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $deathCausesPrimary = $this->DeathCausesPrimary->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $deathCausesPrimary = $this->DeathCausesPrimary->patchEntity($deathCausesPrimary, $this->request->getData());
            if ($this->DeathCausesPrimary->save($deathCausesPrimary)) {
                $this->Flash->success(__('The death causes primary has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The death causes primary could not be saved. Please, try again.'));
        }
        $this->set(compact('deathCausesPrimary'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Death Causes Primary id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $deathCausesPrimary = $this->DeathCausesPrimary->get($id);
        if ($this->DeathCausesPrimary->delete($deathCausesPrimary)) {
            $this->Flash->success(__('The death causes primary has been deleted.'));
        } else {
            $this->Flash->error(__('The death causes primary could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
