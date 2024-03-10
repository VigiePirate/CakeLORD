<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Chronos\Chronos;
use Cake\I18n\I18n;

/**
 * Singularities Controller
 *
 * @property \App\Model\Table\SingularitiesTable $Singularities
 *
 * @method \App\Model\Entity\Singularity[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SingularitiesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['view', 'index']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $sort_fields = (I18n::getLocale() == I18n::getDefaultLocale())
            ? ['name' => 'name', 'genotype' => 'genotype', 'description' => 'description']
            : ['name' => 'SingularitiesTranslation.name', 'genotype' => 'SingularitiesTranslation.genotype', 'description' => 'SingularitiesTranslation.description'];
        $singularities = $this->paginate($this->Singularities, ['order' => ['id' => 'asc'], 'sortableFields' => array_values($sort_fields)]);
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('add', $this->Singularities);
        $this->set(compact('singularities', 'sort_fields', 'user', 'show_staff'));
    }

    /**
     * View method
     *
     * @param string|null $id Singularity id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $singularity = $this->Singularities->get($id);
        $this->Authorization->skipAuthorization();

        $examples = $this->Singularities->Rats->find()
            ->matching('Singularities', function ($q) use ($id) {
                return $q->where(['Singularities.id' => $id]);
            })
            ->where([
                ['Rats.picture !=' => 'Unknown.png'],
                ['Rats.picture !=' => ''],
                ['Rats.picture IS NOT' => null]])
            ->order(['rand()'])
            ->limit(32)
            ->toArray();

        $count = $singularity->countHaving('Rats', 'Singularities');
        $frequency = $singularity->frequencyOfHaving('rats', 'Singularities');

        $recent_count = $singularity->countHaving('rats', 'Singularities', ['birth_date >=' => Chronos::today()->modify('-2 years')]);
        $recent_frequency = $singularity->frequencyOfHaving('rats', 'Singularities', ['birth_date >=' => Chronos::today()->modify('-2 years')]);

        $age['all'] = $count ? $singularity->roundLifespan([], 1) : __('N/A');
        $age['female'] = $count ? $singularity->roundLifespan(['sex' => 'F'], ['singularity' => $singularity->id]) : __('N/A');
        $age['male'] = $count ? $singularity->roundLifespan(['sex' => 'M'], ['singularity' => $singularity->id]) : __('N/A');

        // $age['all'] = __('N/A');
        // $age['female'] = __('N/A');
        // $age['male'] = __('N/A');

        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('add', $this->Singularities);

        $this->set(compact('singularity', 'examples', 'count', 'frequency', 'recent_count', 'recent_frequency', 'age', 'user', 'show_staff'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $singularity = $this->Singularities->newEmptyEntity();
        $this->Authorization->authorize($singularity);
        if ($this->request->is('post')) {
            $locale = I18n::getLocale();
            $default = I18n::getDefaultLocale();
            I18n::setLocale($default);
            $singularity = $this->Singularities->patchEntity($singularity, $this->request->getData());
            if ($this->Singularities->save($singularity)) {
                I18n::setLocale($locale);
                $this->Flash->warning(__('The new singularity has been saved, but only in English. ') . __('Change your preferred language and edit the sheet to add a translation.'));
                return $this->redirect(['action' => 'index']);
            }
            I18n::setLocale($locale);
            $this->Flash->error(__('The singularity could not be saved. Please, try again.'));
        }
        $rats = $this->Singularities->Rats->find('list', ['limit' => 200]);
        $this->set(compact('singularity', 'rats'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Singularity id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $singularity = $this->Singularities->get($id);
        $this->Authorization->authorize($singularity);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $singularity = $this->Singularities->patchEntity($singularity, $this->request->getData());
            if ($this->Singularities->save($singularity)) {
                $this->Flash->success(__('The singularity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The singularity could not be saved. Please, try again.'));
        }
        $rats = $this->Singularities->Rats->find('list', ['limit' => 200]);
        $user = $this->request->getAttribute('identity');
        $this->set(compact('singularity', 'rats', 'user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Singularity id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $singularity = $this->Singularities->get($id);
        $this->Authorization->authorize($singularity);
        if ($this->Singularities->delete($singularity)) {
            $this->Flash->success(__('The singularity has been deleted.'));
        } else {
            $this->Flash->error(__('The singularity could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
