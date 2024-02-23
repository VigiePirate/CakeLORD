<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Chronos\Chronos;
use Cake\I18n\I18n;

/**
 * Coats Controller
 *
 * @property \App\Model\Table\CoatsTable $Coats
 *
 * @method \App\Model\Entity\Coat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CoatsController extends AppController
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
            : ['name' => 'CoatsTranslation.name', 'genotype' => 'CoatsTranslation.genotype', 'description' => 'CoatsTranslation.description'];
        $coats = $this->paginate($this->Coats, ['order' => ['id' => 'asc'], 'sortableFields' => array_values($sort_fields)]);
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('add', $this->Coats);
        $this->set(compact('coats', 'sort_fields', 'user', 'show_staff'));
    }

    /**
     * View method
     *
     * @param string|null $id Coat id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coat = $this->Coats->get($id);
        $this->Authorization->skipAuthorization();

        // FIXME: move to model
        $examples = $this->Coats->Rats->find()
            ->where([
                ['coat_id' => $id],
                ['picture !=' => 'Unknown.png'],
                ['picture !=' => ''],
                ['picture IS NOT' => null]])
            ->order(['rand()'])
            ->limit(32)
            ->toArray();

        $count = $coat->countMy('Rats', 'coat');
        $frequency = $coat->frequencyOfMy('Rats', 'coat');

        $recent_count = $coat->countMy('rats', 'coat', ['birth_date >=' => Chronos::today()->modify('-2 years')]);
        $recent_frequency = $coat->frequencyOfMy('rats', 'coat', ['birth_date >=' => Chronos::today()->modify('-2 years')]);

        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('add', $this->Coats);

        $this->set(compact('coat', 'examples', 'count', 'frequency', 'recent_count', 'recent_frequency', 'user', 'show_staff'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coat = $this->Coats->newEmptyEntity();
        $this->Authorization->authorize($coat);
        if ($this->request->is('post')) {
            $coat = $this->Coats->patchEntity($coat, $this->request->getData());
            if ($this->Coats->save($coat)) {
                $this->Flash->success(__('The coat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The coat could not be saved. Please, try again.'));
        }
        $this->set(compact('coat'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Coat id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coat = $this->Coats->get($id);
        $this->Authorization->authorize($coat);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coat = $this->Coats->patchEntity($coat, $this->request->getData());
            if ($this->Coats->save($coat)) {
                $this->Flash->success(__('The coat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The coat could not be saved. Please, try again.'));
        }
        $user = $this->request->getAttribute('identity');
        $this->set(compact('coat', 'user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Coat id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coat = $this->Coats->get($id);
        $this->Authorization->authorize($coat);
        if ($this->Coats->delete($coat)) {
            $this->Flash->success(__('The coat has been deleted.'));
        } else {
            $this->Flash->error(__('The coat could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
