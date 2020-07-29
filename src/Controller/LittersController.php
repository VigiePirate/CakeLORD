<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Litters Controller
 *
 * @property \App\Model\Table\LittersTable $Litters
 * @method \App\Model\Entity\Litter[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LittersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'States', 'Sire', 'Dam'],
        ];
        $litters = $this->paginate($this->Litters);

        $this->set(compact('litters'));
    }

    /**
     * My method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function my()
    {
        $user = $this->Authentication->getIdentity();
        $this->paginate = [
            'contain' => ['Users', 'States', 'Sire', 'Dam', 'Contributions'],
        ];
        $litters = $this->paginate($this->Litters->find()
                        ->matching('Contributions.Ratteries', function (\Cake\ORM\Query $q) use ($user) {
                            return $q->where([
                                'Ratteries.owner_user_id' => $user->id,
                            ]);
                        })
                        ->order(['Contributions.litters_contribution_id' => 'ASC', 'Litters.birth_date' => 'DESC'])
                );

        $this->set(compact('litters', 'user'));
    }

    /**
     * View method
     *
     * @param string|null $id Litter id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $litter = $this->Litters->get($id, [
            'contain' => ['Users', 'States', 'OffspringRats', 'OffspringRats.States',
            'Sire.Ratteries', 'Sire.BirthLitters', 'Sire.BirthLitters.Contributions',
            'Dam.Ratteries', 'Dam.BirthLitters', 'Dam.BirthLitters.Contributions',
            'Sire', 'Sire.Markings', 'Sire.Dilutions', 'Sire.Colors', 'Sire.Coats', 'Sire.Earsets','Sire.DeathPrimaryCauses','Sire.DeathSecondaryCauses',
            'Dam', 'Dam.Markings', 'Dam.Dilutions', 'Dam.Colors', 'Dam.Coats', 'Dam.Earsets','Dam.DeathPrimaryCauses','Dam.DeathSecondaryCauses',
            'Ratteries','Contributions', 'Conversations', 'LitterSnapshots'],
        ]);
        $offspringsQuery = $this->Litters->OffspringRats
                                ->find('all', ['contain' => ['States', 'DeathPrimaryCauses','DeathSecondaryCauses','OwnerUsers']])
                                ->matching('BirthLitters', function (\Cake\ORM\Query $query) use ($litter) {
                                    return $query->where([
                                        'BirthLitters.id' => $litter->id
                                    ]);
                                });
        $offsprings = $this->paginate($offspringsQuery);

        $this->set(compact('litter', 'offsprings'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $litter = $this->Litters->newEmptyEntity();
        if ($this->request->is('post')) {
            $litter = $this->Litters->patchEntity($litter, $this->request->getData());
            if ($this->Litters->save($litter)) {
                $this->Flash->success(__('The litter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The litter could not be saved. Please, try again.'));
        }
        $users = $this->Litters->Users->find('list', ['limit' => 200]);
        $states = $this->Litters->States->find('list', ['limit' => 200]);
        $parentRats = $this->Litters->ParentRats->find('list', ['limit' => 200]);
        $ratteries = $this->Litters->Ratteries->find('list', ['limit' => 200]);
        $contributions = $this->Litters->Contributions->find('list', ['limit' => 200]);
        $this->set(compact('litter', 'users', 'states', 'parentRats', 'ratteries', 'contributions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Litter id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $litter = $this->Litters->get($id, [
            'contain' => ['ParentRats', 'Ratteries', 'Contributions'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $litter = $this->Litters->patchEntity($litter, $this->request->getData());
            if ($this->Litters->save($litter)) {
                $this->Flash->success(__('The litter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The litter could not be saved. Please, try again.'));
        }
        $users = $this->Litters->Users->find('list', ['limit' => 200]);
        $states = $this->Litters->States->find('list', ['limit' => 200]);
        $parentRats = $this->Litters->ParentRats->find('list', ['limit' => 200]);
        $ratteries = $this->Litters->Ratteries->find('list', ['limit' => 200]);
        $contributions = $this->Litters->Contributions->find('list', ['limit' => 200]);
        $this->set(compact('litter', 'users', 'states', 'parentRats', 'ratteries', 'contributions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Litter id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $litter = $this->Litters->get($id);
        if ($this->Litters->delete($litter)) {
            $this->Flash->success(__('The litter has been deleted.'));
        } else {
            $this->Flash->error(__('The litter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Restore method
     *
     * Restores a Litter from a previous snapshot.
     *
     * @param string|null $id Litter id.
     * @param string|null $snapshot_id LitterSnapshot id.
     * @return \Cake\Http\Response|null Redirects to view.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function restore($id = null, $snapshot_id = null)
    {
        $litter = $this->Litters->get($id);
        $this->Authorization->authorize($litter);
        if ($this->Litters->snapRestore($litter, $snapshot_id)) {
            $this->Flash->success(__('The snapshot has been restored.'));
        } else {
            $this->Flash->error(__('The snapshot could not be loaded. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', $litter->id]);
    }

    public function inState()
    {
        $inState = $this->request->getParam('pass');
        $litters = $this->Litters->find('inState', [
            'inState' => $inState
        ]);

        // Pass variables into the view template context.
        $this->paginate = [
            'contain' => ['Users', 'Sire', 'Dam', 'Contributions', 'States'],
        ];
        $litters = $this->paginate($litters);

        $this->set([
            'litters' => $litters,
            'inState' => $inState
        ]);
    }
}
