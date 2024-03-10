<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Chronos\Chronos;
use Cake\I18n\I18n;

/**
 * Colors Controller
 *
 * @property \App\Model\Table\ColorsTable $Colors
 *
 * @method \App\Model\Entity\Color[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ColorsController extends AppController
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
            : ['name' => 'ColorsTranslation.name', 'genotype' => 'ColorsTranslation.genotype', 'description' => 'ColorsTranslation.description'];
        $colors = $this->paginate($this->Colors, ['order' => ['id' => 'asc'], 'sortableFields' => array_values($sort_fields)]);
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');
        $show_staff = ! is_null($user) && $user->can('add', $this->Colors);
        $this->set(compact('colors', 'sort_fields', 'user', 'show_staff'));
    }

    /**
     * View method
     *
     * @param string|null $id Color id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $color = $this->Colors->get($id);
        $this->Authorization->skipAuthorization();
        $examples = $this->Colors->Rats->find()
            ->where([
                ['color_id' => $id],
                ['picture !=' => 'Unknown.png'],
                ['picture !=' => ''],
                ['picture IS NOT' => null]])
            ->order(['rand()'])
            ->limit(32)
            ->toArray();

        $count = $color->countMy('rats', 'color');
        $frequency = $color->frequencyOfMy('rats', 'color');

        $recent_count = $color->countMy('rats', 'color', ['birth_date >=' => Chronos::today()->modify('-2 years')]);
        $recent_frequency = $color->frequencyOfMy('rats', 'color', ['birth_date >=' => Chronos::today()->modify('-2 years')]);

        $age['all'] = $count ? $color->roundLifespan(['color_id' => $color->id]) : __('N/A');
        $age['female'] = $count ? $color->roundLifespan(['color_id' => $color->id, 'sex' => 'F']) : __('N/A');
        $age['male'] = $count ? $color->roundLifespan(['color_id' => $color->id, 'sex' => 'M']) : __('N/A');

        $user = $this->request->getAttribute('identity');
        $show_staff = ! is_null($user) && $user->can('add', $this->Colors);

        $this->set(compact('color', 'examples', 'count', 'frequency', 'recent_count', 'recent_frequency', 'age', 'user', 'show_staff'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $color = $this->Colors->newEmptyEntity();
        $this->Authorization->authorize($color);
        if ($this->request->is('post')) {
            $locale = I18n::getLocale();
            $default = I18n::getDefaultLocale();
            I18n::setLocale($default);
            $color = $this->Colors->patchEntity($color, $this->request->getData());
            if ($this->Colors->save($color)) {
                I18n::setLocale($locale);
                $this->Flash->warning(__('The new color has been saved, but only in English. ') . __('Change your preferred language and edit the sheet to add a translation.'));
                return $this->redirect(['action' => 'index']);
            }
            I18n::setLocale($locale);
            $this->Flash->error(__('The color could not be saved. Please, try again.'));
        }
        $user = $this->request->getAttribute('identity');
        $this->set(compact('color', 'user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Color id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $color = $this->Colors->get($id);
        $this->Authorization->authorize($color);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $color = $this->Colors->patchEntity($color, $this->request->getData());
            if ($this->Colors->save($color)) {
                $this->Flash->success(__('The color has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The color could not be saved. Please, try again.'));
        }
        $user = $this->request->getAttribute('identity');
        $this->set(compact('color', 'user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Color id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $color = $this->Colors->get($id);
        $this->Authorization->authorize($color);
        if ($this->Colors->delete($color)) {
            $this->Flash->success(__('The color has been deleted.'));
        } else {
            $this->Flash->error(__('The color could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
