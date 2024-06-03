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
                'Litters.Users',
                'Litters.States',
                'Litters.LitterMessages'  => ['sort' => ['LitterMessages.created' => 'DESC']],
                'Litters.LitterMessages.Users',
                'States'
            ],
        ]);

        $this->Authorization->authorize($snapshot);
        $litter = $snapshot->litter;
        $states = $this->fetchModel('States');

        if($litter->state->is_frozen) {
            if (! is_null($litter->state->next_frozen_state_id)) {
                $next_frozen_state = $states->get($litter->state->next_frozen_state_id);
            } else {
                $next_frozen_state = null;
            }
            $next_thawed_state = $states->get($litter->state->next_thawed_state_id);
            $this->set(compact('next_thawed_state', 'next_frozen_state'));
        }
        else {
            $next_ko_state = $states->get($litter->state->next_ko_state_id);
            $next_ok_state = $states->get($litter->state->next_ok_state_id);
            if (! empty($litter->state->next_frozen_state_id) ) {
                $next_frozen_state = $states->get($litter->state->next_frozen_state_id);
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
            //$rats = \Cake\Datasource\FactoryLocator::get('Table')->get('Rats');
            $rats = $this->fetchModel('Rats');
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
}
