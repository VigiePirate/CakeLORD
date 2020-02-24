<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * RatSnapshots Controller
 *
 *
 * @method \App\Model\Entity\RatSnapshot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RatSnapshotsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $ratSnapshots = $this->paginate($this->RatSnapshots);

        $this->set(compact('ratSnapshots'));
    }

    /**
     * View method
     *
     * @param string|null $id Rat Snapshot id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ratSnapshot = $this->RatSnapshots->get($id, [
            'contain' => [],
        ]);

        $this->set('ratSnapshot', $ratSnapshot);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ratSnapshot = $this->RatSnapshots->newEmptyEntity();
        if ($this->request->is('post')) {
            $ratSnapshot = $this->RatSnapshots->patchEntity($ratSnapshot, $this->request->getData());
            if ($this->RatSnapshots->save($ratSnapshot)) {
                $this->Flash->success(__('The rat snapshot has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rat snapshot could not be saved. Please, try again.'));
        }
        $this->set(compact('ratSnapshot'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rat Snapshot id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ratSnapshot = $this->RatSnapshots->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ratSnapshot = $this->RatSnapshots->patchEntity($ratSnapshot, $this->request->getData());
            if ($this->RatSnapshots->save($ratSnapshot)) {
                $this->Flash->success(__('The rat snapshot has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rat snapshot could not be saved. Please, try again.'));
        }
        $this->set(compact('ratSnapshot'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rat Snapshot id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ratSnapshot = $this->RatSnapshots->get($id);
        if ($this->RatSnapshots->delete($ratSnapshot)) {
            $this->Flash->success(__('The rat snapshot has been deleted.'));
        } else {
            $this->Flash->error(__('The rat snapshot could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
