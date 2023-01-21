<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Issues Controller
 *
 * @property \App\Model\Table\IssuesTable $Issues
 * @method \App\Model\Entity\Issue[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IssuesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        /* $this->loadComponent('Security'); */
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->authorize($this->Issues);
        $identity = $this->request->getAttribute('identity');
        $this->paginate = [
            'contain' => ['FromUsers', 'ClosingUsers'],
        ];

        $query = $identity->applyScope('index', $this->Issues->findByIsOpen(true));
        $issues = $this->paginate($query);

        $this->set(compact('issues'));
    }

    /**
     * All method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function all()
    {
        $this->Authorization->authorize($this->Issues, 'index');
        $identity = $this->request->getAttribute('identity');
        $this->paginate = [
            'contain' => ['FromUsers', 'ClosingUsers'],
        ];
        $query = $identity->applyScope('index', $this->Issues->find());
        $issues = $this->paginate($query);

        $this->set(compact('issues'));
    }

    /**
     * Closed method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function closed()
    {
        $this->Authorization->authorize($this->Issues, 'index');
        $identity = $this->request->getAttribute('identity');
        $this->paginate = [
            'contain' => ['FromUsers', 'ClosingUsers'],
        ];
        $query = $identity->applyScope('index', $this->Issues->findByIsOpen(false));
        $issues = $this->paginate($query);

        $this->set(compact('issues'));
    }

    /**
     * View method
     *
     * @param string|null $id Issue id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $issue = $this->Issues->get($id, [
            'contain' => ['FromUsers', 'ClosingUsers'],
        ]);
        $this->Authorization->authorize($issue);
        $identity = $this->request->getAttribute('identity');
        $this->set(compact('issue', 'identity'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->authorize($this->Issues);
        $issue = $this->Issues->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['from_user_id'] = $this->request->getAttribute('identity')->id;
            $data['is_open'] = true;
            $issue = $this->Issues->patchEntity($issue, $data);
            if ($this->Issues->save($issue)) {
                $this->Flash->success(__('The issue has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The issue could not be saved. Please, try again.'));
        } else {
            $origin = $this->request->getParam('pass');
            if (! empty($origin)) {
                $url = implode("/", $origin);
                $this->set(compact('url'));
            }
        }
        //
        $this->set(compact('issue'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Issue id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $issue = $this->Issues->get($id, [
            'contain' => ['FromUsers'],
        ]);

        $identity = $this->request->getAttribute('identity');
        $this->Authorization->authorize($issue);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['is_open'] = false;
            $data['closing_user_id'] = $identity->id;
            $issue = $this->Issues->patchEntity($issue, $data);
            if ($this->Issues->save($issue)) {
                return $this->redirect(['action' => 'view', $issue->id]);
            }
            $this->Flash->error(__('The issue could not be saved. Please, try again.'));
        }

        $this->set(compact('issue', 'identity'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Issue id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $issue = $this->Issues->get($id);
        $this->Authorization->authorize($îssue);
        if ($this->Issues->delete($issue)) {
            $this->Flash->success(__('The issue has been deleted.'));
        } else {
            $this->Flash->error(__('The issue could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
