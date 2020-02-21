<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * RatsSingularities Controller
 *
 * @property \App\Model\Table\RatsSingularitiesTable $RatsSingularities
 *
 * @method \App\Model\Entity\RatsSingularity[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RatsSingularitiesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Rats', 'Singularities'],
        ];
        $ratsSingularities = $this->paginate($this->RatsSingularities);

        $this->set(compact('ratsSingularities'));
    }

    /**
     * View method
     *
     * @param string|null $id Rats Singularity id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ratsSingularity = $this->RatsSingularities->get($id, [
            'contain' => ['Rats', 'Singularities'],
        ]);

        $this->set('ratsSingularity', $ratsSingularity);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ratsSingularity = $this->RatsSingularities->newEmptyEntity();
        if ($this->request->is('post')) {
            $ratsSingularity = $this->RatsSingularities->patchEntity($ratsSingularity, $this->request->getData());
            if ($this->RatsSingularities->save($ratsSingularity)) {
                $this->Flash->success(__('The rats singularity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rats singularity could not be saved. Please, try again.'));
        }
        $rats = $this->RatsSingularities->Rats->find('list', ['limit' => 200]);
        $singularities = $this->RatsSingularities->Singularities->find('list', ['limit' => 200]);
        $this->set(compact('ratsSingularity', 'rats', 'singularities'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rats Singularity id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ratsSingularity = $this->RatsSingularities->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ratsSingularity = $this->RatsSingularities->patchEntity($ratsSingularity, $this->request->getData());
            if ($this->RatsSingularities->save($ratsSingularity)) {
                $this->Flash->success(__('The rats singularity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rats singularity could not be saved. Please, try again.'));
        }
        $rats = $this->RatsSingularities->Rats->find('list', ['limit' => 200]);
        $singularities = $this->RatsSingularities->Singularities->find('list', ['limit' => 200]);
        $this->set(compact('ratsSingularity', 'rats', 'singularities'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rats Singularity id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ratsSingularity = $this->RatsSingularities->get($id);
        if ($this->RatsSingularities->delete($ratsSingularity)) {
            $this->Flash->success(__('The rats singularity has been deleted.'));
        } else {
            $this->Flash->error(__('The rats singularity could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
