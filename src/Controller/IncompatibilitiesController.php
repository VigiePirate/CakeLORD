<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Incompatibilities Controller
 *
 * @property \App\Model\Table\IncompatibilitiesTable $Incompatibilities
 *
 * @method \App\Model\Entity\Incompatibility[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IncompatibilitiesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $incompatibilities = $this->paginate($this->Incompatibilities);

        $this->set(compact('incompatibilities'));
    }

    /**
     * View method
     *
     * @param string|null $id Incompatibility id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $incompatibility = $this->Incompatibilities->get($id, [
            'contain' => [],
        ]);

        $this->set('incompatibility', $incompatibility);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $incompatibility = $this->Incompatibilities->newEmptyEntity();
        if ($this->request->is('post')) {
            $incompatibility = $this->Incompatibilities->patchEntity($incompatibility, $this->request->getData());
            if ($this->Incompatibilities->save($incompatibility)) {
                $this->Flash->success(__('The incompatibility has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The incompatibility could not be saved. Please, try again.'));
        }
        $this->set(compact('incompatibility'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Incompatibility id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $incompatibility = $this->Incompatibilities->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $incompatibility = $this->Incompatibilities->patchEntity($incompatibility, $this->request->getData());
            if ($this->Incompatibilities->save($incompatibility)) {
                $this->Flash->success(__('The incompatibility has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The incompatibility could not be saved. Please, try again.'));
        }
        $this->set(compact('incompatibility'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Incompatibility id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $incompatibility = $this->Incompatibilities->get($id);
        if ($this->Incompatibilities->delete($incompatibility)) {
            $this->Flash->success(__('The incompatibility has been deleted.'));
        } else {
            $this->Flash->error(__('The incompatibility could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
