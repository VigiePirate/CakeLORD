<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * States Controller
 *
 * @property \App\Model\Table\StatesTable $States
 * @method \App\Model\Entity\State[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StatesController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['index']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $query = $this->States->find()
            ->contain(['NextOkStates', 'NextKoStates', 'NextFrozenStates', 'NextThawedStates']);
        $this->set('states', $this->paginate($query));
    }

    /**
     * View method
     *
     * @param string|null $id State id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $state = $this->States->get($id, [
            'contain' => ['NextOkStates', 'NextKoStates', 'NextFrozenStates', 'NextThawedStates'],
        ]);

        $counts = [
            'rats' => $state->countMy('rats', 'state'),
            'ratteries' => $state->countMy('ratteries', 'state'),
            'litters' => $state->countMy('litters', 'state')
        ];

        $user = $this->request->getAttribute('identity');

        $this->set(compact('state', 'counts', 'user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $state = $this->States->newEmptyEntity();
        $this->Authorization->authorize($state, 'act');
        if ($this->request->is('post')) {
            $locale = I18n::getLocale();
            $default = I18n::getDefaultLocale();
            I18n::setLocale($default);
            $state = $this->States->patchEntity($state, $this->request->getData());
            if ($this->States->save($state)) {
                I18n::setLocale($locale);
                $this->Flash->warning(__('The new state has been saved, but only in English. ') . __('Change your preferred language and edit the sheet to add a translation.'));
                return $this->redirect(['action' => 'index']);
            }
            I18n::setLocale($locale);
            $this->Flash->error(__('The state could not be saved. Please, try again.'));
        }
        $nextOkStates = $this->States->NextOkStates->find('list', ['limit' => 200]);
        $nextKoStates = $this->States->NextKoStates->find('list', ['limit' => 200]);
        $nextFrozenStates = $this->States->NextFrozenStates->find('list', ['limit' => 200]);
        $nextThawedStates = $this->States->NextThawedStates->find('list', ['limit' => 200]);
        $this->set(compact('state', 'nextOkStates', 'nextKoStates', 'nextFrozenStates', 'nextThawedStates'));
    }

    /**
     * Edit method
     *
     * @param string|null $id State id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $state = $this->States->get($id, ['contain' => []]);
        $this->Authorization->authorize($state, 'act');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $state = $this->States->patchEntity($state, $this->request->getData());
            if ($this->States->save($state)) {
                $this->Flash->success(__('The state has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The state could not be saved. Please, try again.'));
        }
        $nextOkStates = $this->States->NextOkStates->find('list', ['limit' => 200]);
        $nextKoStates = $this->States->NextKoStates->find('list', ['limit' => 200]);
        $nextFrozenStates = $this->States->NextFrozenStates->find('list', ['limit' => 200]);
        $nextThawedStates = $this->States->NextThawedStates->find('list', ['limit' => 200]);
        $user = $this->request->getAttribute('identity');
        $this->set(compact('state', 'nextOkStates', 'nextKoStates', 'nextFrozenStates', 'nextThawedStates', 'user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id State id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $state = $this->States->get($id);
        $this->Authorization->authorize($state, 'act');

        if ($this->States->delete($state)) {
            $this->Flash->success(__('The state has been deleted.'));
        } else {
            $this->Flash->error(__('The state could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
