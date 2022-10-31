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
        $this->Authorization->authorize($this->Contributions);
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
        $this->Authorization->authorize($contribution);
        $this->set(compact('contribution'));
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
        $this->Authorization->authorize($contribution);
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
        $this->Authorization->authorize($contribution);
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

        // Use the ContributionsTable to find contributions from the rattery.
        $contributions = $this->Contributions->find('fromRattery', [
            'ratteries' => $ratteries
        ]);

        // Pass variables into the view template context.
        $this->paginate = [
            'contain' => ['Litters', 'Litters.States', 'Litters.Sire', 'Litters.Dam', 'Ratteries', 'ContributionTypes'],
        ];
        $contributions = $this->paginate($contributions);

        $ratteries = $this->loadModel('Ratteries')->get(array_map('intval', $ratteries));

        $this->set(compact('contributions', 'ratteries'));
    }
}
