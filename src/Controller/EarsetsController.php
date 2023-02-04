<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Chronos\Chronos;

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
        $show_staff = !is_null($user) && $user->can('add', $this->Earsets);
        $this->set(compact('earsets', 'user', 'show_staff'));
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

        $recent_count = $earset->countMy('rats', 'earset', ['birth_date >=' => Chronos::today()->modify('-2 years')]);
        $recent_frequency = $earset->frequencyOfMy('rats', 'earset', ['birth_date >=' => Chronos::today()->modify('-2 years')]);

        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('add', $this->Earsets);

        $this->set(compact('earset', 'examples' ,'count' , 'frequency', 'recent_count', 'recent_frequency', 'user', 'show_staff'));
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
