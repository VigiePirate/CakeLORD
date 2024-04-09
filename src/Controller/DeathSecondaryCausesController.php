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
        $this->Authorization->skipAuthorization();
        $query = $this->DeathSecondaryCauses->find()->contain(['DeathPrimaryCauses']);
        $deathSecondaryCauses = $this->paginate($query);
        $user = $this->request->getAttribute('identity');
        $this->set(compact('deathSecondaryCauses', 'user'));
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

        $this->Authorization->authorize($deathSecondaryCause);

        $count = $deathSecondaryCause->countMy('rats', 'death_secondary_cause');
        $frequency = $deathSecondaryCause->frequencyOfMy('rats', 'death_secondary_cause');

        if ($count > 0) {
            $sex_ratio =  $deathSecondaryCause->computeRatSexRatioInWords(['death_secondary_cause_id' => $deathSecondaryCause->id], 20);
            $age = $deathSecondaryCause->roundLifespan(['death_secondary_cause_id' => $deathSecondaryCause->id]);
        } else {
            $sex_ratio = __('N/A');
            $age = __('N/A');
        }

        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('add', $this->DeathSecondaryCauses);
        $this->set(compact('deathSecondaryCause', 'count', 'frequency', 'sex_ratio', 'age', 'user', 'show_staff'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $deathSecondaryCause = $this->DeathSecondaryCauses->newEmptyEntity();
        $this->Authorization->authorize($deathSecondaryCause);
        if ($this->request->is('post')) {
            $locale = I18n::getLocale();
            $default = I18n::getDefaultLocale();
            I18n::setLocale($default);
            $deathSecondaryCause = $this->DeathSecondaryCauses->patchEntity($deathSecondaryCause, $this->request->getData());
            if ($this->DeathSecondaryCauses->save($deathSecondaryCause)) {
                I18n::setLocale($locale);
                $this->Flash->warning(__('The new death secondary has been saved, but only in English. ') . __('Change your preferred language and edit the sheet to add a translation.'));
                return $this->redirect(['action' => 'index']);
            }
            I18n::setLocale($locale);
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
        $deathSecondaryCause = $this->DeathSecondaryCauses->get($id);
        $this->Authorization->authorize($deathSecondaryCause);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $deathSecondaryCause = $this->DeathSecondaryCauses->patchEntity($deathSecondaryCause, $this->request->getData());
            if ($this->DeathSecondaryCauses->save($deathSecondaryCause)) {
                $this->Flash->success(__('The death cause has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The death cause could not be saved. Please, try again.'));
        }
        $deathPrimaryCauses = $this->DeathSecondaryCauses->DeathPrimaryCauses->find('list', ['limit' => 200])->order('DeathPrimaryCauses.id');
        $user = $this->request->getAttribute('identity');
        $this->set(compact('deathSecondaryCause', 'deathPrimaryCauses', 'user'));
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
        $this->Authorization->authorize($deathSecondaryCause);
        if ($this->DeathSecondaryCauses->delete($deathSecondaryCause)) {
            $this->Flash->success(__('The death cause has been deleted.'));
        } else {
            $this->Flash->error(__('The death cause could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    // uses several get() instead of a single find() to manage translations
    public function findByPrimary() {
        if ($this->request->is(['ajax'])) {
            $this->Authorization->skipAuthorization();
            $causes_id = $this->DeathSecondaryCauses
                    ->find()
                    ->where(['death_primary_cause_id IS' => $this->request->getQuery('deathprimarykey')])
                    ->all()
                    ->extract('id');

            $items = [];
            foreach ($causes_id as $cause_id) {
                $cause = $this->DeathSecondaryCauses->get($cause_id);
                $item = ['id' => $cause->id, 'value' => $cause->name];
                array_push($items, $item);
            }

            // sort all items but last by alphabetical order
            // (last item is "Other" and must always be at the end)
            if (count($items) > 1) {
                $tail = end($items);
                array_pop($items);
                usort($items, function ($a, $b) {
                    return strcmp($a['value'], $b['value']);
                });
                array_push($items, $tail);
            }

            $this->set('items', $items);
            $this->viewBuilder()->setOption('serialize', ['items']);
        }
    }

    public function description() {
        if ($this->request->is(['ajax'])) {
            $this->Authorization->skipAuthorization();
            $cause = $this->DeathSecondaryCauses->get($this->request->getQuery('id'));
            $items = ['0' => ['id' => $cause['id'], 'value' => $cause['description']]];
            $this->set('items', $items);
            $this->viewBuilder()->setOption('serialize', ['items']);
        }
    }
}
