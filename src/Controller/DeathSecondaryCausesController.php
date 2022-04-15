<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DeathSecondaryCauses Controller
 *
 * @property \App\Model\Table\DeathSecondaryCausesTable $DeathSecondaryCauses
 * @method \App\Model\Entity\DeathSecondaryCause[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DeathSecondaryCausesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['DeathPrimaryCauses'],
        ];
        $deathSecondaryCauses = $this->paginate($this->DeathSecondaryCauses);

        $this->set(compact('deathSecondaryCauses'));
    }

    /**
     * View method
     *
     * @param string|null $id Death Secondary Cause id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $deathSecondaryCause = $this->DeathSecondaryCauses->get($id, [
            'contain' => [
                'DeathPrimaryCauses',
                'Rats' => function($q) {
                    return $q
                    ->order('Rats.modified DESC')
                    ->limit(10);
                },
                'Rats.States','Rats.Ratteries', 'Rats.BirthLitters', 'Rats.BirthLitters.Contributions'
            ],
        ]);

        $count = $deathSecondaryCause->countMy('rats', 'death_secondary_cause');
        $frequency = $deathSecondaryCause->frequencyOfMy('rats', 'death_secondary_cause');

        if ($count > 0) {
            $sex_ratio =  $deathSecondaryCause->computeRatSexRatioInWords(['death_secondary_cause_id' => $deathSecondaryCause->id], 20);
            $age = $deathSecondaryCause->roundLifespan(['death_secondary_cause_id' => $deathSecondaryCause->id]);
        } else {
            $sex_ratio = 'N/A';
            $age = 'N/A';
        }

        $this->set(compact('deathSecondaryCause', 'count', 'frequency', 'sex_ratio', 'age'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $deathSecondaryCause = $this->DeathSecondaryCauses->newEmptyEntity();
        if ($this->request->is('post')) {
            $deathSecondaryCause = $this->DeathSecondaryCauses->patchEntity($deathSecondaryCause, $this->request->getData());
            if ($this->DeathSecondaryCauses->save($deathSecondaryCause)) {
                $this->Flash->success(__('The death cause has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The death cause could not be saved. Please, try again.'));
        }
        $deathPrimaryCauses = $this->DeathSecondaryCauses->DeathPrimaryCauses->find('list', ['limit' => 200])->order('id');
        $this->set(compact('deathSecondaryCause', 'deathPrimaryCauses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Death Secondary Cause id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $deathSecondaryCause = $this->DeathSecondaryCauses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $deathSecondaryCause = $this->DeathSecondaryCauses->patchEntity($deathSecondaryCause, $this->request->getData());
            if ($this->DeathSecondaryCauses->save($deathSecondaryCause)) {
                $this->Flash->success(__('The death cause has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The death cause could not be saved. Please, try again.'));
        }
        $deathPrimaryCauses = $this->DeathSecondaryCauses->DeathPrimaryCauses->find('list', ['limit' => 200])->order('id');
        $this->set(compact('deathSecondaryCause', 'deathPrimaryCauses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Death Secondary Cause id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $deathSecondaryCause = $this->DeathSecondaryCauses->get($id);
        if ($this->DeathSecondaryCauses->delete($deathSecondaryCause)) {
            $this->Flash->success(__('The death cause has been deleted.'));
        } else {
            $this->Flash->error(__('The death cause could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function findByPrimary() {
        if ($this->request->is(['ajax'])) {
            $items = $this->DeathSecondaryCauses->find('all')
                ->select(['id' => 'id', 'value' => 'name'])
                ->where([
                            'death_primary_cause_id IS' => $this->request->getQuery('deathprimarykey'),
                        ])
                ->order(['id' => 'ASC'])
            ;
            $this->set('items', $items);
            $this->viewBuilder()->setOption('serialize', ['items']);
        }
    }

    public function description() {
        if ($this->request->is(['ajax'])) {
            $items = $this->DeathSecondaryCauses->find('all')
                ->select(['id' => 'id', 'value' => 'description'])
                ->where([
                            'id IS' => $this->request->getQuery('id'),
                        ])
            ;
            $this->set('items', $items);
            $this->viewBuilder()->setOption('serialize', ['items']);
        }
    }

}
