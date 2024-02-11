<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * RatterySnapshots Controller
 *
 * @property \App\Model\Table\RatterySnapshotsTable $RatterySnapshots
 *
 * @method \App\Model\Entity\RatterySnapshot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RatterySnapshotsController extends AppController
{
    /**
     * Diff method
     *
     * @param string|null $id Rattery Snapshot id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function diff($id = null) {
        $snapshot = $this->RatterySnapshots->get($id, [
            'contain' => [
                'Ratteries',
                'Ratteries.Countries',
                'Ratteries.Users',
                'Ratteries.States',
                'Ratteries.RatteryMessages'  => ['sort' => ['RatteryMessages.created' => 'DESC']],
                'Ratteries.RatteryMessages.Users',
                'States',
            ]
        ]);

        $this->Authorization->authorize($snapshot);

        $rattery = $snapshot->rattery;

        $states = $this->fetchModel('States');
        if($rattery->state->is_frozen) {
            $next_thawed_state = $states->get($rattery->state->next_thawed_state_id);
            $this->set(compact('next_thawed_state'));
        }
        else {
            $next_ko_state = $states->get($rattery->state->next_ko_state_id);
            $next_ok_state = $states->get($rattery->state->next_ok_state_id);
            if( !empty($rattery->state->next_frozen_state_id) ) {
                $next_frozen_state = $states->get($rattery->state->next_frozen_state_id);
                $this->set(compact('next_frozen_state'));
            }
            $this->set(compact('next_ko_state', 'next_ok_state'));
        };

        $diff_list = array_keys($this->RatterySnapshots->Ratteries->snapCompare($rattery, $snapshot->id));
        $snap_rattery = $rattery->buildFromSnapshot($snapshot->id);

        $user = $this->request->getAttribute('identity');

        $this->set(compact('snapshot', 'rattery', 'snap_rattery', 'diff_list', 'user'));
    }
}
