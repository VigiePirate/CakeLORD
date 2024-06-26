<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Core\Configure;
use Cake\I18n\I18n;

/**
 * Countries Controller
 *
 * @property \App\Model\Table\CountriesTable $Countries
 *
 * @method \App\Model\Entity\Country[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CountriesController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['index', 'view']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $sort_fields = (I18n::getLocale() == I18n::getDefaultLocale())
            ? ['name' => 'name']
            : ['name' => 'CountriesTranslation.name'];

        $countries = $this->paginate($this->Countries, [
            'order' => [$sort_fields['name'] => 'asc'],
            'sortableFields' => ['id', $sort_fields['name'], 'iso3166'],
        ]);

        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');
        $this->set(compact('countries', 'sort_fields', 'user'));
    }

    /**
     * View method
     *
     * @param string|null $id Country id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $country = $this->Countries->get($id, [
            'contain' => [
                'Ratteries' => function($q) {
                    return $q
                    ->where(['is_alive' => true])
                    ->order('Ratteries.prefix');
                },
                'Ratteries.States',
                'Ratteries.Users'
            ],
        ]);
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');
        $show_staff = ! is_null($user) && $user->can('add', $this->Countries);
        $this->set(compact('country', 'user', 'show_staff'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $country = $this->Countries->newEmptyEntity();
        $this->Authorization->authorize($country);
        if ($this->request->is('post')) {
            $locale = I18n::getLocale();
            $default = I18n::getDefaultLocale();
            I18n::setLocale($default);
            $country = $this->Countries->patchEntity($country, $this->request->getData());
            if ($this->Countries->save($country)) {
                I18n::setLocale($locale);
                $this->Flash->warning(__('The new country has been saved, but only in English. ') . __('Change your preferred language and edit the sheet to add a translation.')); 
                return $this->redirect(['action' => 'index']);
            }
            I18n::setLocale($locale);
            $this->Flash->error(__('The country could not be saved. Please, try again.'));

        }
        $user = $this->request->getAttribute('identity');
        $this->set(compact('country', 'user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Country id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $country = $this->Countries->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($country);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $country = $this->Countries->patchEntity($country, $this->request->getData());
            if ($this->Countries->save($country)) {
                $this->Flash->success(__('The country has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The country could not be saved. Please, try again.'));
        }
        $user = $this->request->getAttribute('identity');
        $this->set(compact('country', 'user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Country id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $country = $this->Countries->get($id);
        $this->Authorization->authorize($country);
        if ($this->Countries->delete($country)) {
            $this->Flash->success(__('The country has been deleted.'));
        } else {
            $this->Flash->error(__('The country could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
