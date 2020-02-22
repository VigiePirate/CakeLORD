<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * BackofficeRatEntriesSingularities Controller
 *
 * @property \App\Model\Table\BackofficeRatEntriesSingularitiesTable $BackofficeRatEntriesSingularities
 *
 * @method \App\Model\Entity\BackofficeRatEntriesSingularity[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BackofficeRatEntriesSingularitiesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['BackofficeRatEntries', 'Singularities'],
        ];
        $backofficeRatEntriesSingularities = $this->paginate($this->BackofficeRatEntriesSingularities);

        $this->set(compact('backofficeRatEntriesSingularities'));
    }

    /**
     * View method
     *
     * @param string|null $id Backoffice Rat Entries Singularity id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $backofficeRatEntriesSingularity = $this->BackofficeRatEntriesSingularities->get($id, [
            'contain' => ['BackofficeRatEntries', 'Singularities'],
        ]);

        $this->set('backofficeRatEntriesSingularity', $backofficeRatEntriesSingularity);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $backofficeRatEntriesSingularity = $this->BackofficeRatEntriesSingularities->newEmptyEntity();
        if ($this->request->is('post')) {
            $backofficeRatEntriesSingularity = $this->BackofficeRatEntriesSingularities->patchEntity($backofficeRatEntriesSingularity, $this->request->getData());
            if ($this->BackofficeRatEntriesSingularities->save($backofficeRatEntriesSingularity)) {
                $this->Flash->success(__('The backoffice rat entries singularity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The backoffice rat entries singularity could not be saved. Please, try again.'));
        }
        $backofficeRatEntries = $this->BackofficeRatEntriesSingularities->BackofficeRatEntries->find('list', ['limit' => 200]);
        $singularities = $this->BackofficeRatEntriesSingularities->Singularities->find('list', ['limit' => 200]);
        $this->set(compact('backofficeRatEntriesSingularity', 'backofficeRatEntries', 'singularities'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Backoffice Rat Entries Singularity id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $backofficeRatEntriesSingularity = $this->BackofficeRatEntriesSingularities->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $backofficeRatEntriesSingularity = $this->BackofficeRatEntriesSingularities->patchEntity($backofficeRatEntriesSingularity, $this->request->getData());
            if ($this->BackofficeRatEntriesSingularities->save($backofficeRatEntriesSingularity)) {
                $this->Flash->success(__('The backoffice rat entries singularity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The backoffice rat entries singularity could not be saved. Please, try again.'));
        }
        $backofficeRatEntries = $this->BackofficeRatEntriesSingularities->BackofficeRatEntries->find('list', ['limit' => 200]);
        $singularities = $this->BackofficeRatEntriesSingularities->Singularities->find('list', ['limit' => 200]);
        $this->set(compact('backofficeRatEntriesSingularity', 'backofficeRatEntries', 'singularities'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Backoffice Rat Entries Singularity id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $backofficeRatEntriesSingularity = $this->BackofficeRatEntriesSingularities->get($id);
        if ($this->BackofficeRatEntriesSingularities->delete($backofficeRatEntriesSingularity)) {
            $this->Flash->success(__('The backoffice rat entries singularity has been deleted.'));
        } else {
            $this->Flash->error(__('The backoffice rat entries singularity could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
