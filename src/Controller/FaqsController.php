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
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories'],
        ];
        $faqs = $this->paginate($this->Faqs);

        $this->set(compact('faqs'));
    }

    public function all()
    {
        $categories = $this->loadModel('Categories')
            ->find('all')
            ->contain('Faqs')
            ->order(['position' => 'ASC']);

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

        $this->set(compact('faq'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $faq = $this->Faqs->newEmptyEntity();
        if ($this->request->is('post')) {
            $faq = $this->Faqs->patchEntity($faq, $this->request->getData());
            if ($this->Faqs->save($faq)) {
                $this->Flash->success(__('The FAQ has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $faq = $this->Faqs->patchEntity($faq, $this->request->getData());
            if ($this->Faqs->save($faq)) {
                $this->Flash->success(__('The FAQ has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The FAQ could not be saved. Please, try again.'));
        }
        $categories = $this->Faqs->Categories->find('list', ['limit' => 200]);
        $this->set(compact('faq', 'categories'));
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
        if ($this->Faqs->delete($faq)) {
            $this->Flash->success(__('The FAQ has been deleted.'));
        } else {
            $this->Flash->error(__('The FAQ could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
