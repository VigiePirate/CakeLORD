<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * LittersContributions Controller
 *
 * @property \App\Model\Table\LittersContributionsTable $LittersContributions
 *
 * @method \App\Model\Entity\LittersContribution[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LittersContributionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $littersContributions = $this->paginate($this->LittersContributions);

        $this->set(compact('littersContributions'));
    }

    /**
     * View method
     *
     * @param string|null $id Litters Contribution id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $littersContribution = $this->LittersContributions->get($id, [
            'contain' => [],
        ]);

        $this->set('littersContribution', $littersContribution);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $littersContribution = $this->LittersContributions->newEmptyEntity();
        if ($this->request->is('post')) {
            $littersContribution = $this->LittersContributions->patchEntity($littersContribution, $this->request->getData());
            if ($this->LittersContributions->save($littersContribution)) {
                $this->Flash->success(__('The litters contribution has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The litters contribution could not be saved. Please, try again.'));
        }
        $this->set(compact('littersContribution'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Litters Contribution id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $littersContribution = $this->LittersContributions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $littersContribution = $this->LittersContributions->patchEntity($littersContribution, $this->request->getData());
            if ($this->LittersContributions->save($littersContribution)) {
                $this->Flash->success(__('The litters contribution has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The litters contribution could not be saved. Please, try again.'));
        }
        $this->set(compact('littersContribution'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Litters Contribution id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $littersContribution = $this->LittersContributions->get($id);
        if ($this->LittersContributions->delete($littersContribution)) {
            $this->Flash->success(__('The litters contribution has been deleted.'));
        } else {
            $this->Flash->error(__('The litters contribution could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
