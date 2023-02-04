<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Chronos\Chronos;

/**
 * Singularities Controller
 *
 * @property \App\Model\Table\SingularitiesTable $Singularities
 *
 * @method \App\Model\Entity\Singularity[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SingularitiesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $singularities = $this->paginate($this->Singularities);
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('add', $this->Singularities);
        $this->set(compact('singularities', 'user', 'show_staff'));
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
        $singularity = $this->Singularities->get($id, [
            'contain' => ['Rats'],
        ]);
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

        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('add', $this->Singularities);

        $this->set(compact('singularity', 'examples', 'count', 'frequency', 'recent_count', 'recent_frequency', 'user', 'show_staff'));
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
            $singularity = $this->Singularities->patchEntity($singularity, $this->request->getData());
            if ($this->Singularities->save($singularity)) {
                $this->Flash->success(__('The singularity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
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
        $singularity = $this->Singularities->get($id, [
            'contain' => ['Rats'],
        ]);
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
