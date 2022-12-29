<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ContributionTypes Controller
 *
 * @property \App\Model\Table\ContributionTypesTable $ContributionTypes
 * @method \App\Model\Entity\ContributionType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContributionTypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $contributionTypes = $this->paginate($this->ContributionTypes);
        $this->Authorization->skipAuthorization();
        $this->set(compact('contributionTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Contribution Type id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contributionType = $this->ContributionTypes->get($id, [
            'contain' => ['Contributions'],
        ]);

        $this->set(compact('contributionType'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contributionType = $this->ContributionTypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $contributionType = $this->ContributionTypes->patchEntity($contributionType, $this->request->getData());
            if ($this->ContributionTypes->save($contributionType)) {
                $this->Flash->success(__('The contribution type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contribution type could not be saved. Please, try again.'));
        }
        $this->set(compact('contributionType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contribution Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contributionType = $this->ContributionTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contributionType = $this->ContributionTypes->patchEntity($contributionType, $this->request->getData());
            if ($this->ContributionTypes->save($contributionType)) {
                $this->Flash->success(__('The contribution type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contribution type could not be saved. Please, try again.'));
        }
        $this->set(compact('contributionType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contribution Type id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contributionType = $this->ContributionTypes->get($id);
        if ($this->ContributionTypes->delete($contributionType)) {
            $this->Flash->success(__('The contribution type has been deleted.'));
        } else {
            $this->Flash->error(__('The contribution type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
