<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Singularities Controller
 *
 * @property \App\Model\Table\SingularitiesTable $Singularities
 *
 * @method \App\Model\Entity\Singularity[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SingularitiesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $singularities = $this->paginate($this->Singularities);

        $this->set(compact('singularities'));
    }

    /**
     * View method
     *
     * @param string|null $id Singularity id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $singularity = $this->Singularities->get($id, [
            'contain' => [],
        ]);

        $this->set('singularity', $singularity);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $singularity = $this->Singularities->newEmptyEntity();
        $this->Authorization->authorize($singularity);
        if ($this->request->is('post')) {
            $singularity = $this->Singularities->patchEntity($singularity, $this->request->getData());
            if ($this->Singularities->save($singularity)) {
                $this->Flash->success(__('The singularity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The singularity could not be saved. Please, try again.'));
        }
        $this->set(compact('singularity'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Singularity id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $singularity = $this->Singularities->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($singularity);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $singularity = $this->Singularities->patchEntity($singularity, $this->request->getData());
            if ($this->Singularities->save($singularity)) {
                $this->Flash->success(__('The singularity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The singularity could not be saved. Please, try again.'));
        }
        $this->set(compact('singularity'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Singularity id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $singularity = $this->Singularities->get($id);
        $this->Authorization->authorize($singularity);
        if ($this->Singularities->delete($singularity)) {
            $this->Flash->success(__('The singularity has been deleted.'));
        } else {
            $this->Flash->error(__('The singularity could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
