<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * RatterySnapshots Controller
 *
 * @property \App\Model\Table\RatterySnapshotsTable $RatterySnapshots
 *
 * @method \App\Model\Entity\RatterySnapshot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RatterySnapshotsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Ratteries', 'States'],
        ];
        $ratterySnapshots = $this->paginate($this->RatterySnapshots);

        $this->set(compact('ratterySnapshots'));
    }

    /**
     * View method
     *
     * @param string|null $id Rattery Snapshot id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ratterySnapshot = $this->RatterySnapshots->get($id, [
            'contain' => ['Ratteries', 'States'],
        ]);

        $this->set('ratterySnapshot', $ratterySnapshot);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ratterySnapshot = $this->RatterySnapshots->newEmptyEntity();
        if ($this->request->is('post')) {
            $ratterySnapshot = $this->RatterySnapshots->patchEntity($ratterySnapshot, $this->request->getData());
            if ($this->RatterySnapshots->save($ratterySnapshot)) {
                $this->Flash->success(__('The rattery snapshot has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rattery snapshot could not be saved. Please, try again.'));
        }
        $ratteries = $this->RatterySnapshots->Ratteries->find('list', ['limit' => 200]);
        $states = $this->RatterySnapshots->States->find('list', ['limit' => 200]);
        $this->set(compact('ratterySnapshot', 'ratteries', 'states'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rattery Snapshot id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ratterySnapshot = $this->RatterySnapshots->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ratterySnapshot = $this->RatterySnapshots->patchEntity($ratterySnapshot, $this->request->getData());
            if ($this->RatterySnapshots->save($ratterySnapshot)) {
                $this->Flash->success(__('The rattery snapshot has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rattery snapshot could not be saved. Please, try again.'));
        }
        $ratteries = $this->RatterySnapshots->Ratteries->find('list', ['limit' => 200]);
        $states = $this->RatterySnapshots->States->find('list', ['limit' => 200]);
        $this->set(compact('ratterySnapshot', 'ratteries', 'states'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rattery Snapshot id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ratterySnapshot = $this->RatterySnapshots->get($id);
        if ($this->RatterySnapshots->delete($ratterySnapshot)) {
            $this->Flash->success(__('The rattery snapshot has been deleted.'));
        } else {
            $this->Flash->error(__('The rattery snapshot could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
