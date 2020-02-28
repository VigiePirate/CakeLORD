<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * LittersRats Controller
 *
 * @property \App\Model\Table\LittersRatsTable $LittersRats
 *
 * @method \App\Model\Entity\LittersRat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LittersRatsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Litters', 'Rats'],
        ];
        $littersRats = $this->paginate($this->LittersRats);

        $this->set(compact('littersRats'));
    }

    /**
     * View method
     *
     * @param string|null $id Litters Rat id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $littersRat = $this->LittersRats->get($id, [
            'contain' => ['Litters', 'Rats'],
        ]);

        $this->set('littersRat', $littersRat);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $littersRat = $this->LittersRats->newEmptyEntity();
        if ($this->request->is('post')) {
            $littersRat = $this->LittersRats->patchEntity($littersRat, $this->request->getData());
            if ($this->LittersRats->save($littersRat)) {
                $this->Flash->success(__('The litters rat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The litters rat could not be saved. Please, try again.'));
        }
        $litters = $this->LittersRats->Litters->find('list', ['limit' => 200]);
        $rats = $this->LittersRats->Rats->find('list', ['limit' => 200]);
        $this->set(compact('littersRat', 'litters', 'rats'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Litters Rat id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $littersRat = $this->LittersRats->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $littersRat = $this->LittersRats->patchEntity($littersRat, $this->request->getData());
            if ($this->LittersRats->save($littersRat)) {
                $this->Flash->success(__('The litters rat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The litters rat could not be saved. Please, try again.'));
        }
        $litters = $this->LittersRats->Litters->find('list', ['limit' => 200]);
        $rats = $this->LittersRats->Rats->find('list', ['limit' => 200]);
        $this->set(compact('littersRat', 'litters', 'rats'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Litters Rat id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $littersRat = $this->LittersRats->get($id);
        if ($this->LittersRats->delete($littersRat)) {
            $this->Flash->success(__('The litters rat has been deleted.'));
        } else {
            $this->Flash->error(__('The litters rat could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
