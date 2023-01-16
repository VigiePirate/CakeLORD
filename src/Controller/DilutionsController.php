<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Dilutions Controller
 *
 * @property \App\Model\Table\DilutionsTable $Dilutions
 *
 * @method \App\Model\Entity\Dilution[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DilutionsController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['view', 'index']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $dilutions = $this->paginate($this->Dilutions);
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('add', $this->Dilutions);
        $this->set(compact('dilutions', 'user', 'show_staff'));
    }

    /**
     * View method
     *
     * @param string|null $id Dilution id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dilution = $this->Dilutions->get($id);
        $this->Authorization->skipAuthorization();
        $examples = $this->Dilutions->Rats->find()
            ->where([
                ['dilution_id' => $id],
                ['picture !=' => 'Unknown.png'],
                ['picture !=' => ''],
                ['picture IS NOT' => null]])
            ->order(['rand()'])
            ->limit(32)
            ->toArray();

        $count = $dilution->countMy('rats', 'dilution');
        $frequency = $dilution->frequencyOfMy('rats', 'dilution');

        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('add', $this->Dilutions);

        $this->set(compact('dilution', 'examples', 'count', 'frequency', 'user', 'show_staff'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dilution = $this->Dilutions->newEmptyEntity();
        if ($this->request->is('post')) {
            $dilution = $this->Dilutions->patchEntity($dilution, $this->request->getData());
            if ($this->Dilutions->save($dilution)) {
                $this->Flash->success(__('The dilution has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dilution could not be saved. Please, try again.'));
        }
        $this->set(compact('dilution'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dilution id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dilution = $this->Dilutions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dilution = $this->Dilutions->patchEntity($dilution, $this->request->getData());
            if ($this->Dilutions->save($dilution)) {
                $this->Flash->success(__('The dilution has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dilution could not be saved. Please, try again.'));
        }
        $this->set(compact('dilution'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dilution id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dilution = $this->Dilutions->get($id);
        if ($this->Dilutions->delete($dilution)) {
            $this->Flash->success(__('The dilution has been deleted.'));
        } else {
            $this->Flash->error(__('The dilution could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
