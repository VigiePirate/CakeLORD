<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 *
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['view', 'all']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->Authorization->authorize($this->Articles);
        $query = $this->Articles->find()->contain(['Categories']);
        $settings = [
            'sortableFields' => [
                'id',
                'Categories.name',
                'subtitle',
                'title',
                'created',
                'modified'
            ]
        ];
        $articles = $this->paginate($query, $settings);
        $this->set(compact('articles'));
    }

    /**
     * All method
     *
     * @return \Cake\Http\Response|null
     */
    public function all()
    {
        $this->Authorization->skipAuthorization();
        $categories = $this->Articles->Categories->find('all', ['contain' => ['Articles']])->where(['id >' => 3]);
        $this->set(compact('categories'));
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Categories'],
        ]);
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');
        $this->set(compact('article', 'user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $article = $this->Articles->newEmptyEntity();
        $this->Authorization->authorize($article);

        if ($this->request->is('post')) {
            $locale = I18n::getLocale();
            $default = I18n::getDefaultLocale();
            I18n::setLocale($default);
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                I18n::setLocale($locale);
                $this->Flash->warning(__('The new article has been saved, but only in English. ') . __('Change your preferred language and edit the sheet to add a translation.'));
                return $this->redirect(['action' => 'index']);
            }
            I18n::setLocale($locale);
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }

        $categories = $this->fetchModel('Categories')->find('list', ['limit' => 200]);
        $this->set(compact('article', 'categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Categories'],
        ]);
        $this->Authorization->authorize($article);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'view', $article->id]);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $categories = $this->Articles->Categories->find('list', ['limit' => 200]);
        $user = $this->request->getAttribute('identity');
        $this->set(compact('article', 'categories', 'user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id, ['contain' => ['Categories']]);
        $this->Authorization->authorize($article);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->Articles->delete($article)) {
                $this->Flash->success(__('The article has been deleted.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The article could not be deleted. Please, try again.'));
            }
        }
        $user = $this->request->getAttribute('identity');
        $this->set(compact('article', 'user'));

    }
}
