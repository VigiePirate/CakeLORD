<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DeathPrimaryCauses Controller
 *
 * @property \App\Model\Table\DeathPrimaryCausesTable $DeathPrimaryCauses
 * @method \App\Model\Entity\DeathPrimaryCause[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DeathPrimaryCausesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $deathPrimaryCauses = $this->paginate($this->DeathPrimaryCauses);

        $this->set(compact('deathPrimaryCauses'));
    }

    /**
     * View method
     *
     * @param string|null $id Death Primary Cause id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $deathPrimaryCause = $this->DeathPrimaryCauses->get($id, [
            'contain' => [
                'DeathSecondaryCauses',
                'Rats' => function($q) {
                    return $q
                    ->order('Rats.modified DESC')
                    ->limit(10);
                },
                'Rats.States','Rats.Ratteries', 'Rats.BirthLitters', 'Rats.BirthLitters.Contributions'
            ],
        ]);

        $count = $deathPrimaryCause->countMy('rats','death_primary_cause');
        $frequency = $deathPrimaryCause->frequencyOfMy('rats','death_primary_cause');
        if ($count > 0) {
            $sex_ratio =  $deathPrimaryCause->computeRatSexRatioInWords(['death_primary_cause_id' => $deathPrimaryCause->id], 20);
            $age = $deathPrimaryCause->roundLifespan(['death_primary_cause_id' => $deathPrimaryCause->id]);
        } else {
            $sex_ratio = 'N/A';
            $age = 'N/A';
        }

        $this->set(compact('deathPrimaryCause', 'count', 'frequency', 'sex_ratio', 'age'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $deathPrimaryCause = $this->DeathPrimaryCauses->newEmptyEntity();
        if ($this->request->is('post')) {
            $deathPrimaryCause = $this->DeathPrimaryCauses->patchEntity($deathPrimaryCause, $this->request->getData());
            if ($this->DeathPrimaryCauses->save($deathPrimaryCause)) {
                $this->Flash->success(__('The death category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The death category could not be saved. Please, try again.'));
        }
        $this->set(compact('deathPrimaryCause'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Death Primary Cause id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $deathPrimaryCause = $this->DeathPrimaryCauses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $deathPrimaryCause = $this->DeathPrimaryCauses->patchEntity($deathPrimaryCause, $this->request->getData());
            if ($this->DeathPrimaryCauses->save($deathPrimaryCause)) {
                $this->Flash->success(__('The death category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The death category could not be saved. Please, try again.'));
        }
        $this->set(compact('deathPrimaryCause'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Death Primary Cause id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $deathPrimaryCause = $this->DeathPrimaryCauses->get($id);
        if ($this->DeathPrimaryCauses->delete($deathPrimaryCause)) {
            $this->Flash->success(__('The death category has been deleted.'));
        } else {
            $this->Flash->error(__('The death category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
