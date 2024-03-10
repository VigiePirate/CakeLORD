<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Chronos\Chronos;
use Cake\I18n\I18n;

/**
 * Eyecolors Controller
 *
 * @property \App\Model\Table\EyecolorsTable $Eyecolors
 *
 * @method \App\Model\Entity\Eyecolor[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EyecolorsController extends AppController
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
            : ['name' => 'EyecolorsTranslation.name', 'genotype' => 'EyecolorsTranslation.genotype', 'description' => 'EyecolorsTranslation.description'];

        $eyecolors = $this->paginate($this->Eyecolors, ['order' => ['id' => 'asc'], 'sortableFields' => array_values($sort_fields)]);
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');
        $show_staff = ! is_null($user) && $user->can('add', $this->Eyecolors);
        $this->set(compact('eyecolors', 'sort_fields', 'user', 'show_staff'));
    }

    /**
     * View method
     *
     * @param string|null $id Eyecolor id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eyecolor = $this->Eyecolors->get($id);
        $this->Authorization->skipAuthorization();
        $examples = $this->Eyecolors->Rats->find()
            ->where([
                ['eyecolor_id' => $id],
                ['picture !=' => 'Unknown.png'],
                ['picture !=' => ''],
                ['picture IS NOT' => null]])
            ->order(['rand()'])
            ->limit(32)
            ->toArray();

        $count = $eyecolor->countMy('rats', 'eyecolor');
        $frequency = $eyecolor->frequencyOfMy('rats', 'eyecolor');

        $recent_count = $eyecolor->countMy('rats', 'eyecolor', ['birth_date >=' => Chronos::today()->modify('-2 years')]);
        $recent_frequency = $eyecolor->frequencyOfMy('rats', 'eyecolor', ['birth_date >=' => Chronos::today()->modify('-2 years')]);

        $age['all'] = $count ? $eyecolor->roundLifespan(['eyecolor_id' => $eyecolor->id]) : __('N/A');
        $age['female'] = $count ? $eyecolor->roundLifespan(['eyecolor_id' => $eyecolor->id, 'sex' => 'F']) : __('N/A');
        $age['male'] = $count ? $eyecolor->roundLifespan(['eyecolor_id' => $eyecolor->id, 'sex' => 'M']) : __('N/A');

        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('add', $this->Eyecolors);

        $this->set(compact('eyecolor', 'examples', 'count', 'frequency', 'recent_count', 'recent_frequency', 'age', 'user', 'show_staff'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eyecolor = $this->Eyecolors->newEmptyEntity();
        $this->Authorization->authorize($eyecolor);
        if ($this->request->is('post')) {
            $locale = I18n::getLocale();
            $default = I18n::getDefaultLocale();
            I18n::setLocale($default);
            $eyecolor = $this->Eyecolors->patchEntity($eyecolor, $this->request->getData());
            if ($this->Eyecolors->save($eyecolor)) {
                I18n::setLocale($locale);
                $this->Flash->warning(__('The new eyecolor has been saved, but only in English. ') . __('Change your preferred language and edit the sheet to add a translation.'));
                return $this->redirect(['action' => 'index']);
            }
            I18n::setLocale($locale);
            $this->Flash->error(__('The eyecolor could not be saved. Please, try again.'));
        }
        $user = $this->request->getAttribute('identity');
        $this->set(compact('eyecolor', 'user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Eyecolor id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eyecolor = $this->Eyecolors->get($id);
        $this->Authorization->authorize($eyecolor);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eyecolor = $this->Eyecolors->patchEntity($eyecolor, $this->request->getData());
            if ($this->Eyecolors->save($eyecolor)) {
                $this->Flash->success(__('The eyecolor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The eyecolor could not be saved. Please, try again.'));
        }
        $user = $this->request->getAttribute('identity');
        $this->set(compact('eyecolor', 'user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Eyecolor id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eyecolor = $this->Eyecolors->get($id);
        $this->Authorization->authorize($eyecolor);
        if ($this->Eyecolors->delete($eyecolor)) {
            $this->Flash->success(__('The eyecolor has been deleted.'));
        } else {
            $this->Flash->error(__('The eyecolor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
