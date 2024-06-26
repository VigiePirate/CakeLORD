<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\I18n;

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
        $sort_fields = (I18n::getLocale() == I18n::getDefaultLocale())
            ? ['name' => 'name']
            : ['name' => 'DeathPrimaryCausesTranslation.name'];

        $deathPrimaryCauses = $this->paginate($this->DeathPrimaryCauses, [
            'order' => ['id' => 'asc'],
            'sortableFields' => [$sort_fields['name'], 'is_infant', 'is_accident', 'is_oldster']
        ]);

        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');
        $this->set(compact('deathPrimaryCauses', 'sort_fields', 'user'));
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
        $lastId = $this->DeathPrimaryCauses->DeathSecondaryCauses->findByDeathPrimaryCauseId($id)->all()->last();

        if (is_null($lastId)) {
            $lastId = 1;
        } else {
            $lastId = $lastId->id;
        }

        $deathPrimaryCause = $this->DeathPrimaryCauses->get($id, [
            'contain' => [
                'DeathSecondaryCauses' => function($q) use ($lastId) {
                    $translate = (I18n::getLocale() == I18n::getDefaultLocale()) ? '' : 'Translation';
                    return $q
                        ->order([
                            'CASE WHEN DeathSecondaryCauses__id = '. $lastId .' THEN 1 ELSE 0 END', // first sort by id=1
                            'DeathSecondaryCauses'.$translate.'__name COLLATE utf8mb4_unicode_ci ASC' // then sort by name
                        ]);
                },
                'Rats' => function($q) {
                    return $q
                    ->order('Rats.modified DESC')
                    ->limit(10);
                },
                'Rats.States',
                'Rats.Ratteries',
                'Rats.BirthLitters',
                'Rats.BirthLitters.Contributions'
            ],
        ]);

        $this->Authorization->authorize($deathPrimaryCause);

        $count = $deathPrimaryCause->countMy('rats','death_primary_cause');
        $frequency = $deathPrimaryCause->frequencyOfMy('rats','death_primary_cause');
        if ($count > 0) {
            $sex_ratio =  $deathPrimaryCause->computeRatSexRatioInWords(['death_primary_cause_id' => $deathPrimaryCause->id], 20);
            $age = $deathPrimaryCause->roundLifespan(['death_primary_cause_id' => $deathPrimaryCause->id]);
        } else {
            $sex_ratio = __('N/A');
            $age = __('N/A');
        }

        $user = $this->request->getAttribute('identity');
        $show_staff = ! is_null($user) && $user->can('add', $this->DeathPrimaryCauses);
        $this->set(compact('deathPrimaryCause', 'count', 'frequency', 'sex_ratio', 'age', 'user', 'show_staff'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $deathPrimaryCause = $this->DeathPrimaryCauses->newEmptyEntity();
        $this->Authorization->authorize($deathPrimaryCause);
        if ($this->request->is('post')) {
            $locale = I18n::getLocale();
            $default = I18n::getDefaultLocale();
            I18n::setLocale($default);
            $deathPrimaryCause = $this->DeathPrimaryCauses->patchEntity($deathPrimaryCause, $this->request->getData());
            if ($this->DeathPrimaryCauses->save($deathPrimaryCause)) {
                I18n::setLocale($locale);
                $this->Flash->warning(__('The new death category has been saved, but only in English. ') . __('Change your preferred language and edit the sheet to add a translation.'));
                return $this->redirect(['action' => 'index']);
            }
            I18n::setLocale($locale);
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
        $deathPrimaryCause = $this->DeathPrimaryCauses->get($id);
        $this->Authorization->authorize($deathPrimaryCause);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $deathPrimaryCause = $this->DeathPrimaryCauses->patchEntity($deathPrimaryCause, $this->request->getData());
            if ($this->DeathPrimaryCauses->save($deathPrimaryCause)) {
                $this->Flash->success(__('The death category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The death category could not be saved. Please, try again.'));
        }

        $user = $this->request->getAttribute('identity');
        $this->set(compact('deathPrimaryCause', 'user'));
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
        $this->Authorization->authorize($deathPrimaryCause);
        if ($this->DeathPrimaryCauses->delete($deathPrimaryCause)) {
            $this->Flash->success(__('The death category has been deleted.'));
        } else {
            $this->Flash->error(__('The death category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function description() {
        if ($this->request->is(['ajax'])) {
            $this->Authorization->skipAuthorization();
            $cause = $this->DeathPrimaryCauses->get($this->request->getQuery('id'));
            $items = ['0' => ['id' => $cause['id'], 'value' => $cause['description']]];
            $this->set('items', $items);
            $this->viewBuilder()->setOption('serialize', ['items']);
        }
    }
}
