<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * RatsLitters Controller
 *
 * @property \App\Model\Table\RatsLittersTable $RatsLitters
 *
 * @method \App\Model\Entity\RatsLitter[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RatsLittersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Rats', 'Litters'],
        ];
        $ratsLitters = $this->paginate($this->RatsLitters);

        $this->set(compact('ratsLitters'));
    }

    /**
     * View method
     *
     * @param string|null $id Rats Litter id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ratsLitter = $this->RatsLitters->get($id, [
            'contain' => ['Rats', 'Litters'],
        ]);

        $this->set('ratsLitter', $ratsLitter);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ratsLitter = $this->RatsLitters->newEmptyEntity();
        if ($this->request->is('post')) {
            $ratsLitter = $this->RatsLitters->patchEntity($ratsLitter, $this->request->getData());
            if ($this->RatsLitters->save($ratsLitter)) {
                $this->Flash->success(__('The rats litter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rats litter could not be saved. Please, try again.'));
        }
        $rats = $this->RatsLitters->Rats->find('list', ['limit' => 200]);
        $litters = $this->RatsLitters->Litters->find('list', ['limit' => 200]);
        $this->set(compact('ratsLitter', 'rats', 'litters'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rats Litter id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ratsLitter = $this->RatsLitters->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ratsLitter = $this->RatsLitters->patchEntity($ratsLitter, $this->request->getData());
            if ($this->RatsLitters->save($ratsLitter)) {
                $this->Flash->success(__('The rats litter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rats litter could not be saved. Please, try again.'));
        }
        $rats = $this->RatsLitters->Rats->find('list', ['limit' => 200]);
        $litters = $this->RatsLitters->Litters->find('list', ['limit' => 200]);
        $this->set(compact('ratsLitter', 'rats', 'litters'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rats Litter id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ratsLitter = $this->RatsLitters->get($id);
        if ($this->RatsLitters->delete($ratsLitter)) {
            $this->Flash->success(__('The rats litter has been deleted.'));
        } else {
            $this->Flash->error(__('The rats litter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
