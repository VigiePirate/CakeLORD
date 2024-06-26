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
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['fromRattery']);
    }

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

        $query = $this->Contributions
            ->find('fromRattery', [
                'ratteries' => $ratteries
            ])
            ->contain([
                'Litters',
                'Litters.States',
                'Litters.Sire',
                'Litters.Dam',
                'Ratteries',
                'ContributionTypes',
            ]);

        $settings = [
            'sortableFields' => [
                'Litters.birth_date',
                'ContributionTypes.name',
                'Litters.pups_number'
            ]
        ];

        $contributions = $this->paginate($query, $settings);
        $ratteries = $this->fetchModel('Ratteries')->get(array_map('intval', $ratteries));

        $this->set(compact('contributions', 'ratteries'));
    }
}
