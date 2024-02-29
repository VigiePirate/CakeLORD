<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Faqs Controller
 *
 * @property \App\Model\Table\FaqsTable $Faqs
 * @method \App\Model\Entity\Faq[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FaqsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['all', 'view']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $faqs = $this->paginate($this->Faqs->find()->contain(['Categories']));
        $this->set(compact('faqs'));
    }

    public function all()
    {
        $categories = $this->fetchModel('Categories')
            ->find('all')
            ->contain('Faqs')
            ->order(['position' => 'ASC']);
        $this->Authorization->skipAuthorization();
        $this->set(compact('categories'));
    }

    /**
     * View method
     *
     * @param string|null $id Faq id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $faq = $this->Faqs->get($id, [
            'contain' => ['Categories'],
        ]);
        $this->Authorization->authorize($faq);
        $user = $this->request->getAttribute('identity');
        $this->set(compact('faq', 'user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $faq = $this->Faqs->newEmptyEntity();
        $this->Authorization->authorize($faq);
        if ($this->request->is('post')) {
            $locale = I18n::getLocale();
            $default = I18n::getDefaultLocale();
            I18n::setLocale($default);
            $faq = $this->Faqs->patchEntity($faq, $this->request->getData());
            if ($this->Faqs->save($faq)) {
                I18n::setLocale($locale);
                $this->Flash->warning(__('The new FAQ has been saved, but only in English. ') . __('Change your preferred language and edit the sheet to add a translation.'));
                return $this->redirect(['action' => 'index']);
            }
            I18n::setLocale($locale);
            $this->Flash->error(__('The FAQ could not be saved. Please, try again.'));
        }
        $categories = $this->Faqs->Categories->find('list', ['limit' => 200]);
        $this->set(compact('faq', 'categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Faq id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $faq = $this->Faqs->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($faq);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $faq = $this->Faqs->patchEntity($faq, $this->request->getData());
            if ($this->Faqs->save($faq)) {
                $this->Flash->success(__('The FAQ has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The FAQ could not be saved. Please, try again.'));
        }
        $categories = $this->Faqs->Categories->find('list', ['limit' => 200]);
        $user = $this->request->getAttribute('identity');
        $this->set(compact('faq', 'categories', 'user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Faq id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $faq = $this->Faqs->get($id);
        $this->Authorization->authorize($faq);
        if ($this->Faqs->delete($faq)) {
            $this->Flash->success(__('The FAQ has been deleted.'));
        } else {
            $this->Flash->error(__('The FAQ could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
