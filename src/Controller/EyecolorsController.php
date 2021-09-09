<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Eyecolors Controller
 *
 * @property \App\Model\Table\EyecolorsTable $Eyecolors
 *
 * @method \App\Model\Entity\Eyecolor[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EyecolorsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $eyecolors = $this->paginate($this->Eyecolors);

        $this->set(compact('eyecolors'));
    }

    /**
     * View method
     *
     * @param string|null $id Eyecolor id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eyecolor = $this->Eyecolors->get($id);

        $examples = $this->Eyecolors->Rats->find()
            ->where([
                ['coat_id' => $id],
                ['picture !=' => 'Unknown.png'],
                ['picture !=' => ''],
                ['picture IS NOT' => null]])
            ->order(['rand()'])
            ->limit(32)
            ->toArray();

        $count = $eyecolor->countMyRats(['field' => 'eyecolor_id']);
        $frequency = $eyecolor->frequencyOfMyRats(['field' => 'eyecolor_id']);

        $this->set(compact('eyecolor','examples','count','frequency'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eyecolor = $this->Eyecolors->newEmptyEntity();
        if ($this->request->is('post')) {
            $eyecolor = $this->Eyecolors->patchEntity($eyecolor, $this->request->getData());
            if ($this->Eyecolors->save($eyecolor)) {
                $this->Flash->success(__('The eyecolor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The eyecolor could not be saved. Please, try again.'));
        }
        $this->set(compact('eyecolor'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Eyecolor id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eyecolor = $this->Eyecolors->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eyecolor = $this->Eyecolors->patchEntity($eyecolor, $this->request->getData());
            if ($this->Eyecolors->save($eyecolor)) {
                $this->Flash->success(__('The eyecolor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The eyecolor could not be saved. Please, try again.'));
        }
        $this->set(compact('eyecolor'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Eyecolor id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eyecolor = $this->Eyecolors->get($id);
        if ($this->Eyecolors->delete($eyecolor)) {
            $this->Flash->success(__('The eyecolor has been deleted.'));
        } else {
            $this->Flash->error(__('The eyecolor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
