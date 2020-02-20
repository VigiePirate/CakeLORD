<?php
// src/Controller/SingularitiesController.php

namespace App\Controller;

class SingularitiesController extends AppController
{
  public function index()
    {
        $this->loadComponent('Paginator');
        $articles = $this->Paginator->paginate($this->Singularities->find());
        $this->set(compact('singularities'));
    }

    public function view($id = null)
    {
        $singularity = $this->Singularities->findById($id)->firstOrFail();
        $this->set(compact('singularity'));
    }
}
