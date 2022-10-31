<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Compatibilities Controller
 *
 * @property \App\Model\Table\CompatibilitiesTable $Compatibilities
 *
 * @method \App\Model\Entity\Compatibility[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CompatibilitiesController extends AppController
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
        $this->paginate = ['contain' => ['Operators']];
        $compatibilities = $this->paginate($this->Compatibilities);
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('add', $this->Compatibilities);
        $this->set(compact('compatibilities', 'user', 'show_staff'));
    }

    /**
     * View method
     *
     * @param string|null $id Compatibility id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $compatibility = $this->Compatibilities->get($id, ['contain' => ['Operators']]);
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('add', $this->Compatibilities);
        $this->set(compact('compatibility', 'user', 'show_staff'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $compatibility = $this->Compatibilities->newEmptyEntity();
        $this->Authorization->authorize($compatibility);
        if ($this->request->is('post')) {
            $compatibility = $this->Compatibilities->patchEntity($compatibility, $this->request->getData());
            if ($this->Compatibilities->save($compatibility)) {
                $this->Flash->success(__('The compatibility has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The compatibility could not be saved. Please, try again.'));
        }
        $operators = $this->Compatibilities->Operators->find('list', ['limit' => 200]);
        $this->set(compact('compatibility', 'operators'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Compatibility id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $compatibility = $this->Compatibilities->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $compatibility = $this->Compatibilities->patchEntity($compatibility, $this->request->getData());
            if ($this->Compatibilities->save($compatibility)) {
                $this->Flash->success(__('The compatibility has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The compatibility could not be saved. Please, try again.'));
        }
        $operators = $this->Compatibilities->Operators->find('list', ['limit' => 200]);
        $this->set(compact('compatibility', 'operators'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Compatibility id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $compatibility = $this->Compatibilities->get($id);
        if ($this->Compatibilities->delete($compatibility)) {
            $this->Flash->success(__('The compatibility has been deleted.'));
        } else {
            $this->Flash->error(__('The compatibility could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
