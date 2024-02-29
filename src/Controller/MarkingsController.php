<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Chronos\Chronos;
use Cake\I18n\I18n;

/**
 * Markings Controller
 *
 * @property \App\Model\Table\MarkingsTable $Markings
 *
 * @method \App\Model\Entity\Marking[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MarkingsController extends AppController
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
            : ['name' => 'MarkingsTranslation.name', 'genotype' => 'MarkingsTranslation.genotype', 'description' => 'MarkingsTranslation.description'];

        $markings = $this->paginate($this->Markings, ['order' => ['id' => 'asc'], 'sortableFields' => array_values($sort_fields)]);
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('add', $this->Markings);
        $this->set(compact('markings', 'sort_fields', 'user', 'show_staff'));
    }

    /**
     * View method
     *
     * @param string|null $id Marking id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $marking = $this->Markings->get($id);
        $this->Authorization->skipAuthorization();
        $examples = $this->Markings->Rats->find()
            ->where([
                ['marking_id' => $id],
                ['picture !=' => 'Unknown.png'],
                ['picture !=' => ''],
                ['picture IS NOT' => null]])
            ->order(['rand()'])
            ->limit(32)
            ->toArray();

        $count = $marking->countMy('rats', 'marking');
        $frequency = $marking->frequencyOfMy('rats', 'marking');

        $recent_count = $marking->countMy('rats', 'marking', ['birth_date >=' => Chronos::today()->modify('-2 years')]);
        $recent_frequency = $marking->frequencyOfMy('rats', 'marking', ['birth_date >=' => Chronos::today()->modify('-2 years')]);

        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('add', $this->Markings);

        $this->set(compact('marking', 'examples', 'count', 'frequency', 'recent_count', 'recent_frequency', 'user', 'show_staff'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $marking = $this->Markings->newEmptyEntity();
        $this->Authorization->authorize($marking);
        if ($this->request->is('post')) {
            $locale = I18n::getLocale();
            $default = I18n::getDefaultLocale();
            I18n::setLocale($default);
            $marking = $this->Markings->patchEntity($marking, $this->request->getData());
            if ($this->Markings->save($marking)) {
                I18n::setLocale($locale);
                $this->Flash->warning(__('The new marking has been saved, but only in English. ') . __('Change your preferred language and edit the sheet to add a translation.'));
                return $this->redirect(['action' => 'index']);
            }
            I18n::setLocale($locale);
            $this->Flash->error(__('The marking could not be saved. Please, try again.'));
        }

        $user = $this->request->getAttribute('identity');
        $this->set(compact('marking', 'user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Marking id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $marking = $this->Markings->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($marking);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $marking = $this->Markings->patchEntity($marking, $this->request->getData());
            if ($this->Markings->save($marking)) {
                $this->Flash->success(__('The marking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The marking could not be saved. Please, try again.'));
        }
        $user = $this->request->getAttribute('identity');
        $this->set(compact('marking', 'user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Marking id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $marking = $this->Markings->get($id);
        $this->Authorization->authorize($marking);
        if ($this->Markings->delete($marking)) {
            $this->Flash->success(__('The marking has been deleted.'));
        } else {
            $this->Flash->error(__('The marking could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
