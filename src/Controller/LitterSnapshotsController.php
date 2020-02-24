<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * LitterSnapshots Controller
 *
 *
 * @method \App\Model\Entity\LitterSnapshot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LitterSnapshotsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $litterSnapshots = $this->paginate($this->LitterSnapshots);

        $this->set(compact('litterSnapshots'));
    }

    /**
     * View method
     *
     * @param string|null $id Litter Snapshot id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $litterSnapshot = $this->LitterSnapshots->get($id, [
            'contain' => [],
        ]);

        $this->set('litterSnapshot', $litterSnapshot);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $litterSnapshot = $this->LitterSnapshots->newEmptyEntity();
        if ($this->request->is('post')) {
            $litterSnapshot = $this->LitterSnapshots->patchEntity($litterSnapshot, $this->request->getData());
            if ($this->LitterSnapshots->save($litterSnapshot)) {
                $this->Flash->success(__('The litter snapshot has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The litter snapshot could not be saved. Please, try again.'));
        }
        $this->set(compact('litterSnapshot'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Litter Snapshot id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $litterSnapshot = $this->LitterSnapshots->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $litterSnapshot = $this->LitterSnapshots->patchEntity($litterSnapshot, $this->request->getData());
            if ($this->LitterSnapshots->save($litterSnapshot)) {
                $this->Flash->success(__('The litter snapshot has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The litter snapshot could not be saved. Please, try again.'));
        }
        $this->set(compact('litterSnapshot'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Litter Snapshot id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $litterSnapshot = $this->LitterSnapshots->get($id);
        if ($this->LitterSnapshots->delete($litterSnapshot)) {
            $this->Flash->success(__('The litter snapshot has been deleted.'));
        } else {
            $this->Flash->error(__('The litter snapshot could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
