<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Markings Controller
 *
 * @property \App\Model\Table\MarkingsTable $Markings
 *
 * @method \App\Model\Entity\Marking[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MarkingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $markings = $this->paginate($this->Markings);

        $this->set(compact('markings'));
    }

    /**
     * View method
     *
     * @param string|null $id Marking id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $marking = $this->Markings->get($id);

        $examples = $this->Markings->Rats->find()
            ->where([
                ['marking_id' => $id],
                ['picture !=' => 'Unknown.png'],
                ['picture !=' => ''],
                ['picture IS NOT' => null]])
            ->order(['rand()'])
            ->limit(32)
            ->toArray();

        $count = $marking->countMyRats(['field' => 'marking_id']);
        $frequency = $marking->frequencyOfMyRats(['field' => 'marking_id']);

        $this->set(compact('marking','examples','count','frequency'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $marking = $this->Markings->newEmptyEntity();
        if ($this->request->is('post')) {
            $marking = $this->Markings->patchEntity($marking, $this->request->getData());
            if ($this->Markings->save($marking)) {
                $this->Flash->success(__('The marking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The marking could not be saved. Please, try again.'));
        }
        $this->set(compact('marking'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Marking id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $marking = $this->Markings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $marking = $this->Markings->patchEntity($marking, $this->request->getData());
            if ($this->Markings->save($marking)) {
                $this->Flash->success(__('The marking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The marking could not be saved. Please, try again.'));
        }
        $this->set(compact('marking'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Marking id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $marking = $this->Markings->get($id);
        if ($this->Markings->delete($marking)) {
            $this->Flash->success(__('The marking has been deleted.'));
        } else {
            $this->Flash->error(__('The marking could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
