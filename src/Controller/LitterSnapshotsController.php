<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Collection\Collection;

/**
 * LitterSnapshots Controller
 *
 * @property \App\Model\Table\LitterSnapshotsTable $LitterSnapshots
 *
 * @method \App\Model\Entity\LitterSnapshot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LitterSnapshotsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Litters', 'States'],
        ];
        $litterSnapshots = $this->paginate($this->LitterSnapshots);

        $this->set(compact('litterSnapshots'));
    }

    /**
     * View method
     *
     * @param string|null $id Litter Snapshot id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $litterSnapshot = $this->LitterSnapshots->get($id, [
            'contain' => ['Litters', 'States'],
        ]);

        $this->set('litterSnapshot', $litterSnapshot);
    }

    /**
     * Diff method
     *
     * @param string|null $id Rat Snapshot id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function diff($id = null)
    {
        $snapshot = $this->LitterSnapshots->get($id, [
            'contain' => [
                'Litters',
                'Litters.Contributions',
                'Litters.Contributions.ContributionTypes',
                'Litters.Contributions.Ratteries',
                'Litters.Dam',
                'Litters.Dam.BirthLitters.Contributions.Ratteries',
                'Litters.Sire',
                'Litters.Sire.BirthLitters.Contributions.Ratteries',
                'Litters.ParentRats',
                'Litters.States',
                'States'
            ],
        ]);

        $this->Authorization->authorize($snapshot);

        $litter = $snapshot->litter;

        $this->loadModel('States');
        if($litter->state->is_frozen) {
            $next_thawed_state = $this->States->get($litter->state->next_thawed_state_id);
            $this->set(compact('next_thawed_state'));
        }
        else {
            $next_ko_state = $this->States->get($litter->state->next_ko_state_id);
            $next_ok_state = $this->States->get($litter->state->next_ok_state_id);
            if (! empty($litter->state->next_frozen_state_id) ) {
                $next_frozen_state = $this->States->get($litter->state->next_frozen_state_id);
                $this->set(compact('next_frozen_state'));
            }
            $this->set(compact('next_ko_state', 'next_ok_state'));
        };

        $diff_array = $this->LitterSnapshots->Litters->snapCompare($litter, $snapshot->id);
        $diff_list = array_keys($diff_array);
        $snap_litter = $litter->buildFromSnapshot($snapshot->id);

        // process parents separately (snapped through association)
        if (in_array('parent_rats', $diff_list)) {
            $contain = ['Ratteries', 'BirthLitters.Contributions.Ratteries'];
            $rats = \Cake\Datasource\FactoryLocator::get('Table')->get('Rats');
            foreach ($diff_array['parent_rats'] as $parent_id) {
                $parent = $rats->get($parent_id['id'], ['contain' => $contain]);
                if ($parent->sex == 'F') {
                    $snap_litter->dam[0] = $parent;
                }
                if ($parent->sex == 'M') {
                    $snap_litter->sire[0] = $parent;
                }
            }
        }

        // process contributions
        $contribution_types = \Cake\Datasource\FactoryLocator::get('Table')->get('ContributionTypes');

        if (in_array('contributions', $diff_list)) {
            $contributions = \Cake\Datasource\FactoryLocator::get('Table')->get('Contributions');
            $ratteries = \Cake\Datasource\FactoryLocator::get('Table')->get('Ratteries');
            $snap_litter->contributions = [];
            foreach ($diff_array['contributions'] as $contribution_snap) {
                $contribution = $contributions->newEntity($contribution_snap);
                $contribution->rattery = $ratteries->get($contribution->rattery_id);
                $contribution->contribution_type = $contribution_types->get($contribution->contribution_type_id);
                array_push($snap_litter->contributions, $contribution);
            }
        } else {
            $snap_litter->contributions = $litter->contributions;
        }

        // intersect available contribution types on both sides to align diff display
        $snap_ratteries = (new Collection($snap_litter->contributions))->combine('contribution_type_id', 'rattery')->toArray();
        $litter_ratteries = (new Collection($litter->contributions))->combine('contribution_type_id', 'rattery')->toArray();
        $types = $contribution_types->find('all');

        $user = $this->request->getAttribute('identity');

        $this->set(compact(
            'snapshot',
            'litter',
            'snap_litter',
            'diff_list',
            'snap_ratteries',
            'litter_ratteries',
            'types',
            'user')
        );
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $litterSnapshot = $this->LitterSnapshots->newEmptyEntity();
        if ($this->request->is('post')) {
            $litterSnapshot = $this->LitterSnapshots->patchEntity($litterSnapshot, $this->request->getData());
            if ($this->LitterSnapshots->save($litterSnapshot)) {
                $this->Flash->success(__('The litter snapshot has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The litter snapshot could not be saved. Please, try again.'));
        }
        $litters = $this->LitterSnapshots->Litters->find('list', ['limit' => 200]);
        $states = $this->LitterSnapshots->States->find('list', ['limit' => 200]);
        $this->set(compact('litterSnapshot', 'litters', 'states'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Litter Snapshot id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $litterSnapshot = $this->LitterSnapshots->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $litterSnapshot = $this->LitterSnapshots->patchEntity($litterSnapshot, $this->request->getData());
            if ($this->LitterSnapshots->save($litterSnapshot)) {
                $this->Flash->success(__('The litter snapshot has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The litter snapshot could not be saved. Please, try again.'));
        }
        $litters = $this->LitterSnapshots->Litters->find('list', ['limit' => 200]);
        $states = $this->LitterSnapshots->States->find('list', ['limit' => 200]);
        $this->set(compact('litterSnapshot', 'litters', 'states'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Litter Snapshot id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $litterSnapshot = $this->LitterSnapshots->get($id);
        if ($this->LitterSnapshots->delete($litterSnapshot)) {
            $this->Flash->success(__('The litter snapshot has been deleted.'));
        } else {
            $this->Flash->error(__('The litter snapshot could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
