<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DeathCausesSecondary Controller
 *
 * @property \App\Model\Table\DeathCausesSecondaryTable $DeathCausesSecondary
 *
 * @method \App\Model\Entity\DeathCausesSecondary[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DeathCausesSecondaryController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['DeathCausesPrimary'],
        ];
        $deathCausesSecondary = $this->paginate($this->DeathCausesSecondary);

        $this->set(compact('deathCausesSecondary'));
    }

    /**
     * View method
     *
     * @param string|null $id Death Causes Secondary id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $deathCausesSecondary = $this->DeathCausesSecondary->get($id, [
            'contain' => ['DeathCausesPrimary'],
        ]);

        $this->set('deathCausesSecondary', $deathCausesSecondary);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $deathCausesSecondary = $this->DeathCausesSecondary->newEmptyEntity();
        if ($this->request->is('post')) {
            $deathCausesSecondary = $this->DeathCausesSecondary->patchEntity($deathCausesSecondary, $this->request->getData());
            if ($this->DeathCausesSecondary->save($deathCausesSecondary)) {
                $this->Flash->success(__('The death causes secondary has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The death causes secondary could not be saved. Please, try again.'));
        }
        $deathCausesPrimary = $this->DeathCausesSecondary->DeathCausesPrimary->find('list', ['limit' => 200]);
        $this->set(compact('deathCausesSecondary', 'deathCausesPrimary'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Death Causes Secondary id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $deathCausesSecondary = $this->DeathCausesSecondary->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $deathCausesSecondary = $this->DeathCausesSecondary->patchEntity($deathCausesSecondary, $this->request->getData());
            if ($this->DeathCausesSecondary->save($deathCausesSecondary)) {
                $this->Flash->success(__('The death causes secondary has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The death causes secondary could not be saved. Please, try again.'));
        }
        $deathCausesPrimary = $this->DeathCausesSecondary->DeathCausesPrimary->find('list', ['limit' => 200]);
        $this->set(compact('deathCausesSecondary', 'deathCausesPrimary'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Death Causes Secondary id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $deathCausesSecondary = $this->DeathCausesSecondary->get($id);
        if ($this->DeathCausesSecondary->delete($deathCausesSecondary)) {
            $this->Flash->success(__('The death causes secondary has been deleted.'));
        } else {
            $this->Flash->error(__('The death causes secondary could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
