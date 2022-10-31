<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Earsets Controller
 *
 * @property \App\Model\Table\EarsetsTable $Earsets
 *
 * @method \App\Model\Entity\Earset[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EarsetsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $earsets = $this->paginate($this->Earsets);
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');
        $this->set(compact('earsets', 'user'));
    }

    /**
     * View method
     *
     * @param string|null $id Earset id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $earset = $this->Earsets->get($id);

        $examples = $this->Earsets->Rats->find()
            ->where([
                ['earset_id' => $id],
                ['picture !=' => 'Unknown.png'],
                ['picture !=' => ''],
                ['picture IS NOT' => null]])
            ->order(['rand()'])
            ->limit(32)
            ->toArray();

        $count = $earset->countMy('rats', 'earset');
        $frequency = $earset->frequencyOfMy('rats', 'earset');

        $this->set(compact('earset','examples','count','frequency'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $earset = $this->Earsets->newEmptyEntity();
        if ($this->request->is('post')) {
            $earset = $this->Earsets->patchEntity($earset, $this->request->getData());
            if ($this->Earsets->save($earset)) {
                $this->Flash->success(__('The earset has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The earset could not be saved. Please, try again.'));
        }
        $this->set(compact('earset'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Earset id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $earset = $this->Earsets->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $earset = $this->Earsets->patchEntity($earset, $this->request->getData());
            if ($this->Earsets->save($earset)) {
                $this->Flash->success(__('The earset has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The earset could not be saved. Please, try again.'));
        }
        $this->set(compact('earset'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Earset id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $earset = $this->Earsets->get($id);
        if ($this->Earsets->delete($earset)) {
            $this->Flash->success(__('The earset has been deleted.'));
        } else {
            $this->Flash->error(__('The earset could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
