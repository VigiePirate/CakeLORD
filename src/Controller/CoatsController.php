<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Coats Controller
 *
 * @property \App\Model\Table\CoatsTable $Coats
 *
 * @method \App\Model\Entity\Coat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CoatsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $coats = $this->paginate($this->Coats);

        $this->set(compact('coats'));
    }

    /**
     * View method
     *
     * @param string|null $id Coat id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coat = $this->Coats->get($id);
        $examples = $this->Coats->Rats->find()
            ->where([
                ['coat_id' => $id],
                ['picture !=' => 'Unknown.png'],
                ['picture !=' => ''],
                ['picture IS NOT' => null]])
            ->order(['rand()'])
            ->limit(25)
            ->toArray();
        $this->set(compact('coat','examples'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coat = $this->Coats->newEmptyEntity();
        if ($this->request->is('post')) {
            $coat = $this->Coats->patchEntity($coat, $this->request->getData());
            if ($this->Coats->save($coat)) {
                $this->Flash->success(__('The coat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The coat could not be saved. Please, try again.'));
        }
        $this->set(compact('coat'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Coat id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coat = $this->Coats->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coat = $this->Coats->patchEntity($coat, $this->request->getData());
            if ($this->Coats->save($coat)) {
                $this->Flash->success(__('The coat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The coat could not be saved. Please, try again.'));
        }
        $this->set(compact('coat'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Coat id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coat = $this->Coats->get($id);
        if ($this->Coats->delete($coat)) {
            $this->Flash->success(__('The coat has been deleted.'));
        } else {
            $this->Flash->error(__('The coat could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
