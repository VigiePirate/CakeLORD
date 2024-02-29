<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Chronos\Chronos;
use Cake\I18n\I18n;

/**
 * Dilutions Controller
 *
 * @property \App\Model\Table\DilutionsTable $Dilutions
 *
 * @method \App\Model\Entity\Dilution[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DilutionsController extends AppController
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
            : ['name' => 'DilutionsTranslation.name', 'genotype' => 'DilutionsTranslation.genotype', 'description' => 'DilutionsTranslation.description'];

        $dilutions = $this->paginate($this->Dilutions, ['order' => ['id' => 'asc'], 'sortableFields' => array_values($sort_fields)]);
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('add', $this->Dilutions);
        $this->set(compact('dilutions', 'sort_fields', 'user', 'show_staff'));
    }

    /**
     * View method
     *
     * @param string|null $id Dilution id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dilution = $this->Dilutions->get($id);
        $this->Authorization->skipAuthorization();
        $examples = $this->Dilutions->Rats->find()
            ->where([
                ['dilution_id' => $id],
                ['picture !=' => 'Unknown.png'],
                ['picture !=' => ''],
                ['picture IS NOT' => null]])
            ->order(['rand()'])
            ->limit(32)
            ->toArray();

        $count = $dilution->countMy('rats', 'dilution');
        $frequency = $dilution->frequencyOfMy('rats', 'dilution');

        $recent_count = $dilution->countMy('rats', 'dilution', ['birth_date >=' => Chronos::today()->modify('-2 years')]);
        $recent_frequency = $dilution->frequencyOfMy('rats', 'dilution', ['birth_date >=' => Chronos::today()->modify('-2 years')]);

        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('add', $this->Dilutions);

        $this->set(compact('dilution', 'examples', 'count', 'frequency', 'recent_count', 'recent_frequency', 'user', 'show_staff'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dilution = $this->Dilutions->newEmptyEntity();
        $this->Authorization->authorize($dilution);
        if ($this->request->is('post')) {
            $locale = I18n::getLocale();
            $default = I18n::getDefaultLocale();
            I18n::setLocale($default);
            $dilution = $this->Dilutions->patchEntity($dilution, $this->request->getData());
            if ($this->Dilutions->save($dilution)) {
                I18n::setLocale($locale);
                $this->Flash->warning(__('The new dilution has been saved, but only in English. ') . __('Change your preferred language and edit the sheet to add a translation.'));
                return $this->redirect(['action' => 'index']);
            }
            I18n::setLocale($locale);
            $this->Flash->error(__('The dilution could not be saved. Please, try again.'));
        }
        $user = $this->request->getAttribute('identity');
        $this->set(compact('dilution', 'user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dilution id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dilution = $this->Dilutions->get($id);
        $this->Authorization->authorize($dilution);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dilution = $this->Dilutions->patchEntity($dilution, $this->request->getData());
            if ($this->Dilutions->save($dilution)) {
                $this->Flash->success(__('The dilution has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dilution could not be saved. Please, try again.'));
        }
        $user = $this->request->getAttribute('identity');
        $this->set(compact('dilution', 'user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dilution id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dilution = $this->Dilutions->get($id);
        $this->Authorization->authorize($dilution);
        if ($this->Dilutions->delete($dilution)) {
            $this->Flash->success(__('The dilution has been deleted.'));
        } else {
            $this->Flash->error(__('The dilution could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
