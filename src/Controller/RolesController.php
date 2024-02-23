<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\I18n;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
 * @method \App\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RolesController extends AppController
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
            : ['name' => 'RolesTranslation.name'];

        $roles = $this->paginate($this->Roles, [
            'order' => ['id' => 'asc'],
            'sortableFields' => [
                'id',
                $sort_fields['name'],
                'is_root',
                'is_admin',
                'is_staff',
                'can_delete',
                'can_restore',
                'can_describe',
                'can_document',
                'can_configure',
                'can_edit_frozen',
                'can_edit_others',
                'can_change_state',
                'can_access_personal'
            ],
        ]);

        $this->Authorization->Authorize($this->Roles);
        $this->set(compact('roles', 'sort_fields'));
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $role = $this->Roles->get($id);
        $this->Authorization->skipAuthorization();
        if ($role->is_staff) {
            $role = $this->Roles->get($id, ['contain' => 'Users']);
        }

        $user = $this->request->getAttribute('identity');
        $this->set(compact('role', 'user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $role = $this->Roles->newEmptyEntity();
        $this->Authorization->authorize($role, 'configure');
        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
        $this->set(compact('role'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $role = $this->Roles->get($id);
        $this->Authorization->authorize($role, 'configure');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
        $this->set(compact('role'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);
        $this->Authorization->authorize($role, 'configure');
        if ($this->Roles->delete($role)) {
            $this->Flash->success(__('The role has been deleted.'));
        } else {
            $this->Flash->error(__('The role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
