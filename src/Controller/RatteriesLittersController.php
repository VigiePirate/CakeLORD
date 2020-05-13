<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * RatteriesLitters Controller
 *
 * @property \App\Model\Table\RatteriesLittersTable $RatteriesLitters
 * @method \App\Model\Entity\RatteriesLitter[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RatteriesLittersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Ratteries', 'Litters', 'LittersContributions'],
        ];
        $ratteriesLitters = $this->paginate($this->RatteriesLitters);

        $this->set(compact('ratteriesLitters'));
    }

    /**
     * View method
     *
     * @param string|null $id Ratteries Litter id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ratteriesLitter = $this->RatteriesLitters->get($id, [
            'contain' => ['Ratteries', 'Litters', 'LittersContributions'],
        ]);

        $this->set('ratteriesLitter', $ratteriesLitter);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ratteriesLitter = $this->RatteriesLitters->newEmptyEntity();
        if ($this->request->is('post')) {
            $ratteriesLitter = $this->RatteriesLitters->patchEntity($ratteriesLitter, $this->request->getData());
            if ($this->RatteriesLitters->save($ratteriesLitter)) {
                $this->Flash->success(__('The ratteries litter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ratteries litter could not be saved. Please, try again.'));
        }
        $ratteries = $this->RatteriesLitters->Ratteries->find('list', ['limit' => 200]);
        $litters = $this->RatteriesLitters->Litters->find('list', ['limit' => 200]);
        $littersContributions = $this->RatteriesLitters->LittersContributions->find('list', ['limit' => 200]);
        $this->set(compact('ratteriesLitter', 'ratteries', 'litters', 'littersContributions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ratteries Litter id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ratteriesLitter = $this->RatteriesLitters->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ratteriesLitter = $this->RatteriesLitters->patchEntity($ratteriesLitter, $this->request->getData());
            if ($this->RatteriesLitters->save($ratteriesLitter)) {
                $this->Flash->success(__('The ratteries litter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ratteries litter could not be saved. Please, try again.'));
        }
        $ratteries = $this->RatteriesLitters->Ratteries->find('list', ['limit' => 200]);
        $litters = $this->RatteriesLitters->Litters->find('list', ['limit' => 200]);
        $littersContributions = $this->RatteriesLitters->LittersContributions->find('list', ['limit' => 200]);
        $this->set(compact('ratteriesLitter', 'ratteries', 'litters', 'littersContributions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ratteries Litter id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ratteriesLitter = $this->RatteriesLitters->get($id);
        if ($this->RatteriesLitters->delete($ratteriesLitter)) {
            $this->Flash->success(__('The ratteries litter has been deleted.'));
        } else {
            $this->Flash->error(__('The ratteries litter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
