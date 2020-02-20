<?php
// src/Controller/SingularitiesController.php

namespace App\Controller;
use App\Controller\AppController;

class SingularitiesController extends AppController
{

  public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

  public function index()
    {
        $this->loadComponent('Paginator');
        $singularities = $this->Paginator->paginate($this->Singularities->find());
        $this->set(compact('singularities'));
    }

    public function view($id = null)
    {
        $singularity = $this->Singularities->findById($id)->firstOrFail();
        $this->set(compact('singularity'));
    }

    public function add()
    {
        $singularity = $this->Singularities->newEmptyEntity();
        if ($this->request->is('post')) {
            $singularity = $this->Singularities->patchEntity($singularity, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            $singularity->user_id = 1;

            if ($this->Singularities->save($singularity)) {
                $this->Flash->success(__('Your singularity has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your singularity.'));
        }
        $this->set('singularity', $singularity);
    }

    public function edit($id)
    {
    $singularity = $this->Singularities
        ->findById($id)
        ->firstOrFail();

    if ($this->request->is(['post', 'put'])) {
        $this->Singularities->patchEntity($singularity, $this->request->getData());
        if ($this->Singularities->save($singularity)) {
            $this->Flash->success(__('Your singularity has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update your singularity.'));
    }

    $this->set('singularity', $singularity);
  }

  public function delete($id)
{
    $this->request->allowMethod(['post', 'delete']);

    $singularity = $this->Singularities->findById($id)->firstOrFail();
    if ($this->Singularities->delete($singularity)) {
        $this->Flash->success(__('The {0} singularity has been deleted.', $singularity->name_fr));
        return $this->redirect(['action' => 'index']);
    }
}
}
