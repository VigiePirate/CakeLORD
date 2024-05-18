<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * RatSnapshots Controller
 *
 * @property \App\Model\Table\RatSnapshotsTable $RatSnapshots
 *
 * @method \App\Model\Entity\RatSnapshot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RatSnapshotsController extends AppController
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
        $snapshot = $this->RatSnapshots->get($id, [
            'contain' => [
                'Rats',
                'Rats.States',
                'Rats.OwnerUsers',
                'Rats.CreatorUsers',
                'Rats.BirthLitters',
                'Rats.BirthLitters.Contributions',
                'Rats.Coats',
                'Rats.Colors',
                'Rats.Dilutions',
                'Rats.Eyecolors',
                'Rats.Earsets',
                'Rats.Markings',
                'Rats.Singularities',
                'Rats.Ratteries',
                'Rats.BirthLitters',
                'Rats.BirthLitters.Sire',
                'Rats.BirthLitters.Dam',
                'Rats.DeathPrimaryCauses',
                'Rats.DeathSecondaryCauses',
                'Rats.RatMessages'  => ['sort' => ['RatMessages.created' => 'DESC']],
                'Rats.RatMessages.Users',
                'States'
            ],
        ]);

        $this->Authorization->authorize($snapshot);
        $rat = $snapshot->rat;
        $states = $this->fetchModel('States');

        if ($rat->state->is_frozen) {
            if (! is_null($rat->state->next_frozen_state_id)) {
                $next_frozen_state = $states->get($rat->state->next_frozen_state_id);
            } else {
                $next_frozen_state = null;
            }
            $next_thawed_state = $states->get($rat->state->next_thawed_state_id);
            $this->set(compact('next_thawed_state', 'next_frozen_state'));
        }
        else {
            $next_ko_state = $states->get($rat->state->next_ko_state_id);
            $next_ok_state = $states->get($rat->state->next_ok_state_id);
            if (! empty($rat->state->next_frozen_state_id)) {
                $next_frozen_state = $states->get($rat->state->next_frozen_state_id);
                $this->set(compact('next_frozen_state'));
            }
            $this->set(compact('next_ko_state', 'next_ok_state'));
        };

        $diff_array = $this->RatSnapshots->Rats->snapCompare($rat, $snapshot->id);
        $diff_list = array_keys($diff_array);
        $snap_rat = $rat->buildFromSnapshot($snapshot->id);

        // process singularities separately (snapped through association)
        if (in_array('singularities', $diff_list)) {
            $singularities = \Cake\Datasource\FactoryLocator::get('Table')->get('Singularities');
            $snap_rat->singularities = [];
            foreach ($diff_array['singularities'] as $singularity_id) {
                $singularity = $singularities->get($singularity_id['id']);
                array_push($snap_rat->singularities, $singularity);
            }
        }

        $user = $this->request->getAttribute('identity');

        $this->set(compact('snapshot', 'rat', 'snap_rat', 'diff_list', 'user'));
    }
}
