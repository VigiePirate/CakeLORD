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
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        //FIXME: create Policy for Issues
        $this->Authorization->skipAuthorization();
        $this->paginate = [
            'contain' => ['FromUsers', 'ClosingUsers'],
        ];
        $issues = $this->paginate($this->Issues);

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
            'contain' => ['Users'],
        ]);

        $this->set(compact('issue'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        $issue = $this->Issues->newEmptyEntity();

        if ($this->request->is('post')) {
            // $issue = $this->Issues->patchEntity($issue, $this->request->getData());
            // if ($this->Issues->save($issue)) {
            //     $this->Flash->success(__('The issue has been saved.'));
            //
            //     return $this->redirect(['action' => 'index']);
            // }
            // $this->Flash->error(__('The issue could not be saved. Please, try again.'));
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
    public function close($id = null)
    {
        $issue = $this->Issues->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $issue = $this->Issues->patchEntity($issue, $this->request->getData());
            if ($this->Issues->save($issue)) {
                $this->Flash->success(__('The issue has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The issue could not be saved. Please, try again.'));
        }
        $users = $this->Issues->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('issue', 'users'));
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
        if ($this->Issues->delete($issue)) {
            $this->Flash->success(__('The issue has been deleted.'));
        } else {
            $this->Flash->error(__('The issue could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
