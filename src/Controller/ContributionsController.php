<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Contributions Controller
 *
 * @property \App\Model\Table\ContributionsTable $Contributions
 * @method \App\Model\Entity\Contribution[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContributionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Ratteries', 'Litters', 'Litters.Sire', 'Litters.Dam', 'ContributionTypes'],
        ];
        $contributions = $this->paginate($this->Contributions);

        $this->set(compact('contributions'));
    }

    /**
     * View method
     *
     * @param string|null $id Contribution id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contribution = $this->Contributions->get($id, [
            'contain' => ['Ratteries', 'Litters', 'Litters.Sire', 'Litters.Dam', 'ContributionTypes'],
        ]);

        $this->set(compact('contribution'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contribution = $this->Contributions->newEmptyEntity();
        if ($this->request->is('post')) {
            $contribution = $this->Contributions->patchEntity($contribution, $this->request->getData());
            if ($this->Contributions->save($contribution)) {
                $this->Flash->success(__('The contribution has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contribution could not be saved. Please, try again.'));
        }
        $ratteries = $this->Contributions->Ratteries->find('list', ['limit' => 200]);
        $litters = $this->Contributions->Litters->find('list', ['limit' => 200, 'contain' => ['Sire', 'Dam']]);
        $contributionTypes = $this->Contributions->ContributionTypes->find('list', ['limit' => 200, 'order' => ['priority' => 'ASC']]);
        $this->set(compact('contribution', 'ratteries', 'litters', 'contributionTypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contribution id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contribution = $this->Contributions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contribution = $this->Contributions->patchEntity($contribution, $this->request->getData());
            if ($this->Contributions->save($contribution)) {
                $this->Flash->success(__('The contribution has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contribution could not be saved. Please, try again.'));
        }
        $ratteries = $this->Contributions->Ratteries->find('list', ['limit' => 200]);
        $litters = $this->Contributions->Litters->find('list', ['limit' => 200, 'contain' => ['Sire', 'Dam']]);
        $contributionTypes = $this->Contributions->ContributionTypes->find('list', ['limit' => 200, 'order' => ['priority' => 'ASC']]);
        $this->set(compact('contribution', 'ratteries', 'litters', 'contributionTypes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contribution id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contribution = $this->Contributions->get($id);
        if ($this->Contributions->delete($contribution)) {
            $this->Flash->success(__('The contribution has been deleted.'));
        } else {
            $this->Flash->error(__('The contribution could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * fromRattery method
     *
     * Search contributions by ratteries.
     *
     * @param
     * @return
     */
    public function fromRattery()
    {
        $this->Authorization->skipAuthorization();
        $ratteries = $this->request->getParam('pass');
        //
        // Use the RatsTable to find named rats.
        $contributions = $this->Contributions->find('fromRattery', [
            'ratteries' => $ratteries
        ]);

        // Pass variables into the view template context.
        $this->paginate = [
            'contain' => ['Litters', 'Litters.States', 'Litters.Sire', 'Litters.Dam', 'Ratteries', 'ContributionTypes'],
        ];
        $contributions = $this->paginate($contributions);

        $this->set(compact('contributions', 'ratteries'));
    }
}
