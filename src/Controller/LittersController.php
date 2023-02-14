<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Collection\Collection;

/**
 * Litters Controller
 *
 * @property \App\Model\Table\LittersTable $Litters
 * @method \App\Model\Entity\Litter[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LittersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['view']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $this->paginate = [
            'contain' => ['Users', 'States', 'Sire', 'Dam'],
        ];
        $litters = $this->paginate($this->Litters);

        $this->set(compact('litters'));
    }

    /**
     * My method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function my()
    {
        $this->Authorization->skipAuthorization();
        $user = $this->Authentication->getIdentity();
        $this->paginate = [
            'contain' => ['Users', 'States', 'Sire', 'Dam', 'Contributions'],
        ];
        $litters = $this->paginate($this->Litters->find()
                        ->matching('Contributions.Ratteries', function (\Cake\ORM\Query $q) use ($user) {
                            return $q->where([
                                'Ratteries.owner_user_id' => $user->id,
                            ]);
                        })
                        ->order(['Contributions.litter_id' => 'ASC', 'Litters.birth_date' => 'DESC'])
                );

        $this->set(compact('litters', 'user'));
    }

    /**
     * View method
     *
     * @param string|null $id Litter id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $litter = $this->Litters->get($id, [
            'contain' => [
                'Users', 'States', 'OffspringRats', 'OffspringRats.States',
                'Sire.Ratteries', 'Sire.BirthLitters', 'Sire.BirthLitters.Contributions',
                'Dam.Ratteries', 'Dam.BirthLitters', 'Dam.BirthLitters.Contributions',
                'Sire', 'Sire.Markings', 'Sire.Dilutions', 'Sire.Colors', 'Sire.Coats', 'Sire.Earsets','Sire.DeathPrimaryCauses','Sire.DeathSecondaryCauses',
                'Dam', 'Dam.Markings', 'Dam.Dilutions', 'Dam.Colors', 'Dam.Coats', 'Dam.Earsets','Dam.DeathPrimaryCauses','Dam.DeathSecondaryCauses',
                'Ratteries', 'Contributions', 'Conversations', 'LitterSnapshots',
            ],
        ]);

        $this->Authorization->skipAuthorization();

        $offspringsQuery = $this->Litters->OffspringRats
                                ->find('all', ['contain' => ['States', 'DeathPrimaryCauses', 'DeathSecondaryCauses', 'OwnerUsers', 'Ratteries']])
                                ->matching('BirthLitters', function (\Cake\ORM\Query $query) use ($litter) {
                                    return $query->where([
                                        'BirthLitters.id' => $litter->id
                                    ]);
                                });
        $offsprings = $this->paginate($offspringsQuery);

        $stats = $litter->wrapStatistics($offsprings);

        $this->loadModel('States');
        if($litter->state->is_frozen) {
            $next_thawed_state = $this->States->get($litter->state->next_thawed_state_id);
            $this->set(compact('next_thawed_state'));
        }
        else {
            $next_ko_state = $this->States->get($litter->state->next_ko_state_id);
            $next_ok_state = $this->States->get($litter->state->next_ok_state_id);
            if( !empty($litter->state->next_frozen_state_id) ) {
                $next_frozen_state = $this->States->get($litter->state->next_frozen_state_id);
                $this->set(compact('next_frozen_state'));
            }
            $this->set(compact('next_ko_state','next_ok_state'));
        };

        $user = $this->request->getAttribute('identity');

        $this->set(compact('litter', 'offsprings', 'stats', 'user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $litter = $this->Litters->newEmptyEntity([
            'associated' => ['ParentRats', 'Contributions']
        ]);

        $this->Authorization->authorize($litter);

        if ($this->request->is('post')) {
            // this is not an unauthenticated action, so, test $result emptiness is not necessary?
            $result = $this->Authentication->getResult();

            if ($result->isValid()) {

                $data = $this->request->getData();
                $data['creator_user_id'] = $this->Authentication->getIdentityData('id');

                $litter = $this->Litters->patchEntity($litter, $data, [
                    'from_rat' => false,
                    'associated' => ['ParentRats', 'Contributions', 'Contributions.Ratteries']
                ]);

                $samelitter = $this->Litters->find('fromBirth', [
                    'birth_date' => $data['birth_date'],
                    'mother_id' => $data['mother_id'],
                ])->first();

                if (is_null($samelitter)) {
                    if ($this->Litters->save($litter)) {
                        $this->Flash->success(__('The litter has been saved.'));
                        return $this->redirect(['action' => 'view', $litter->id]);
                    }
                    $this->Flash->error(__('The litter could not be saved. Please, read explanatory messages in the form, check and correct your entry, and try again.'));
                } else {
                    $this->Flash->error(__('This litter already exists. You can add rats to it directly.'));
                    return $this->redirect(['action' => 'view', $samelitter->id]);
                }
            } else {
                $this->Flash->error(__('Only registered users are allowed to register a new litter. Please sign in or sign up before proceeding.')); // . $email->smtpError);
                return $this->redirect(['action' => 'login']);
            }
        } else {
            $this->Flash->default(__('Please record the litter’s main information below. You will be able to add rats to the litter just after.'));
        }

        $parent_id = $this->request->getParam('pass');
        if (! empty($parent_id)) {
            $from_parent = true;
            $rats = $this->loadModel('Rats');
            $parent = $rats->get($parent_id, ['contain' => 'Ratteries']);
            if ($parent->sex == 'F') {
                $mother = ['name' => $parent->name . ' ('. $parent->pedigree_identifier .')', 'id' => $parent->id];
                $this->set(compact('mother'));
            } else {
                $father = ['name' => $parent->name . ' ('. $parent->pedigree_identifier .')', 'id' => $parent->id];
                $this->set(compact('father'));
            }
        } else {
            $from_parent = false;
        }
        $ratteries = $this->loadModel('Ratteries');
        $creator = $this->Authentication->getIdentity()->get('id');
        $generic = $ratteries->find()->where(['is_generic IS' => true]);
        $rattery = $ratteries->findByOwnerUserId($creator)->where(['is_alive IS' => true]);
        $origins = $generic->all()->append($rattery)->combine('id', 'full_name');

        $this->set(compact('litter', 'origins', 'from_parent'));
    }

    /**
     * Simulate method
     *
     */
    public function simulate()
    {
        $litter = $this->Litters->newEmptyEntity([
            'associated' => ['ParentRats', 'Contributions']
        ]);

        $this->Authorization->authorize($litter, 'add');

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $this->redirect(['controller' => 'litters', 'action' => 'virtual', $data['mother_id'], $data['father_id']]);
        }

        $this->set(compact('litter'));
    }

    /**
     * Virtual method
     *
     */
    public function virtual()
    {
        $litter = $this->Litters->newEmptyEntity([
            'associated' => ['ParentRats', 'Contributions']
        ]);
        $this->Authorization->authorize($litter, 'add');

        $parents = $this->request->getParam('pass');
        $data['mother_id'] = $parents[0];
        $data['father_id'] = $parents[1];

        $data['birth_date'] = \Cake\I18n\FrozenTime::today();

        $user_id = $this->Authentication->getIdentity()->get('id');
        $user = $this->loadModel('Users')->get($user_id, ['contain' => 'Ratteries']);
        if (empty($user->main_rattery)) {
            $data['rattery_id'] = 1;
        } else {
            $data['rattery_id'] = $user->main_rattery->id;
        }

        $litter = $this->Litters->patchEntity($litter, $data, [
            'from_rat' => false,
            'associated' => ['ParentRats', 'Contributions', 'Contributions.Ratteries']
        ]);

        // parse tree for inbreeding computation
        $genealogy = [];
        $index = [];
        $litter->spanningTree('', $genealogy, $index);
        $genealogy_json = json_encode($genealogy);
        $index_json = json_encode($index);

        // create fake offspring to init family tree
        $rats = $this->loadModel('Rats');
        $dam = $rats->get($parents[0], ['contain' => ['Ratteries', 'Coats', 'Colors', 'Dilutions', 'Markings', 'Earsets', 'OwnerUsers', 'OwnerUsers.Ratteries']]);
        $sire = $rats->get($parents[1], ['contain' => ['Ratteries', 'Coats', 'Colors', 'Dilutions', 'Markings', 'Earsets', 'OwnerUsers', 'OwnerUsers.Ratteries']]);
        $parents = [];

        array_push($parents,
        [
            'id' => rand() . '_' . $dam->id,
            'true_id' => $dam->id,
            'name' => $dam->usual_name,
            'link' => \Cake\Routing\Router::Url(['controller' => 'Rats', 'action' => 'view', $dam->id]),
            'sex' => 'F',
            'description' => $dam->variety,
            'death'=> $dam->short_death_cause . ' (' . $dam->short_age_string . ')',
            'more_parents' => is_null($dam->litter_id) ? 0 : 1,
            '_parents' => [],
        ]);

        array_push($parents,
        [
            'id' => rand() . '_' . $sire->id,
            'true_id' => $sire->id,
            'name' => $sire->usual_name,
            'link' => \Cake\Routing\Router::Url(['controller' => 'Rats', 'action' => 'view', $sire->id]),
            'sex' => 'M',
            'description' => $sire->variety,
            'death'=> $sire->short_death_cause . ' (' . $sire->short_age_string . ')',
            'more_parents' => is_null($sire) ? 0 : 1,
            '_parents' => [],
        ]);

        $litter->dam = $dam;
        $litter->sire = $sire;
        $prefix = $litter->predictPrefix();

        $family = [
            'id' => 0,
            'true_id' => 0,
            'name' => __('Virtual litter'),
            'link' => '#',
            'sex' => 'X', // we want a different color for the root of the tree
            'description' => __('Expected prefix: ') . h($prefix),
            'death' => __('Mating window: ') . $dam->childbearingAge(),
            '_parents' => $parents,
            '_children' => [],
        ];

        $json = json_encode($family);

        $this->set(compact('litter', 'sire', 'dam', 'json', 'genealogy_json', 'index_json'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Litter id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $litter = $this->Litters->get($id, [
            'contain' => ['ParentRats', 'OffspringRats', 'OffspringRats.DeathPrimaryCauses', 'Ratteries', 'Contributions', 'Sire', 'Dam', 'States'],
        ]);
        $this->Authorization->authorize($litter);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $litter = $this->Litters->patchEntity($litter, $this->request->getData(), [
                'associated' => ['ParentRats', 'OffspringRats', 'Contributions', 'Contributions.Ratteries']
            ]);
            if ($this->Litters->save($litter)) {
                $this->Flash->success(__('The litter has been saved. If parents were edited, you might have to manually correct contributions.'));

                return $this->redirect(['action' => 'view', $litter->id]);
            }
            $this->Flash->error(__('The litter could not be saved. Please, try again.'));
        }

        foreach ($litter->parent_rats as $parent) {
            if ($parent->sex == 'F') {
                $mother = ['name' => $parent->name . ' ('. $parent->pedigree_identifier .')', 'id' => $parent->id];
                $this->set(compact('mother'));
            }
            if ($parent->sex == 'M') {
                $father = ['name' => $parent->name . ' ('. $parent->pedigree_identifier .')', 'id' => $parent->id];
                $this->set(compact('father'));
            }
        }

        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('staffEdit', $litter);

        $this->Flash->warning( __('For data coherence, modifications of litters are restricted. Please, contact a staff member to change parents or birth date.'));
        $this->set(compact('litter', 'mother', 'father', 'user', 'show_staff'));
    }

    /**
     * ManageContributions method
     *
     * @param string|null $id Litter id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function manageContributions($id = null)
    {
        $litter = $this->Litters->get($id, [
            'contain' => [
                'Sire', 'Sire.Ratteries', 'Sire.BirthLitters', 'Sire.BirthLitters.Contributions',
                'Dam', 'Dam.Ratteries', 'Dam.BirthLitters', 'Dam.BirthLitters.Contributions',
                'ParentRats', 'OffspringRats', 'OffspringRats.DeathPrimaryCauses', 'Ratteries', 'Contributions', 'Contributions.Ratteries', 'States'
            ],
        ]);

        $this->Authorization->authorize($litter);

        $this->loadModel('ContributionTypes');
        $contribution_types = $this->ContributionTypes->find('all')->order('priority ASC');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->Litters->patchEntity($litter, $this->request->getData(), ['associated' => ['Contributions', 'OffspringRats']]);

            if ($this->Litters->save($litter)) {
                $this->Flash->success(__('The litter’s contributing ratteries have been updated.'));
                return $this->redirect(['action' => 'view', $litter->id]);
            }
            $this->Flash->error(__('The litter’s contributing ratteries could not be updated. Please, try again.'));
        } else {
            $this->Flash->default(__('You can add, edit or delete contributing ratteries below. Please, contact a staff member to edit the birth place.'));
        }

        $previous = [];
        foreach ($contribution_types as $type) {
            foreach ($litter->contributions as $contribution) {
                if ($contribution->contribution_type_id === $type->id) {
                    $previous[$type->id] = [
                        'id' => $contribution->rattery->id,
                        'name' => $contribution->rattery->full_name
                    ];
                }
            }
        }

        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('staffEdit', $litter);

        $this->set(compact('litter', 'contribution_types', 'previous', 'user', 'show_staff'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Litter id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $litter = $this->Litters->get($id);
        $this->Authorization->authorize($litter);
        if ($this->Litters->delete($litter)) {
            $this->Flash->success(__('The litter has been deleted.'));
        } else {
            $this->Flash->error(__('The litter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Restore method
     *
     * Restores a Litter from a previous snapshot.
     *
     * @param string|null $id Litter id.
     * @param string|null $snapshot_id LitterSnapshot id.
     * @return \Cake\Http\Response|null Redirects to view.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function restore($id = null, $snapshot_id = null)
    {
        $litter = $this->Litters->get($id);
        $this->Authorization->authorize($litter);
        if ($this->Litters->snapRestore($litter, $snapshot_id)) {
            $this->Flash->success(__('The snapshot has been restored.'));
        } else {
            $this->Flash->error(__('The snapshot could not be loaded. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', $litter->id]);
    }

    public function inState()
    {
        $this->Authorization->authorize($this->Litters);

        $inState = $this->request->getParam('pass');
        $litters = $this->Litters->find('inState', [
            'inState' => $inState
        ]);

        // Pass variables into the view template context.
        $this->paginate = [
            'contain' => ['Users', 'Sire', 'Dam', 'Contributions', 'States'],
        ];
        $litters = $this->paginate($litters);

        $this->set([
            'litters' => $litters,
            'inState' => $inState
        ]);
    }

    /**
     * Genealogy method
     * FIXME: should be protected?
     *
     * Recursive walk in the genealogy tree
     * Returns a flat table with [$path => $rat_id] rows
     *
     */
    public function genealogy($id, $path, &$genealogy, $approx = false)
    {
        $this->Authorization->skipAuthorization();
        $this->loadModel('Rats');
        $parents = $this->Rats->find()
            ->select(['id', 'litter_id', 'sex'])
            ->matching('BredLitters', function ($query) use ($id) {
                return $query->where(['BredLitters.id' => $id]);
            })
            ->enableHydration(false)
            ->all();

        // no test on parent existence, since a litter must have at least one parent
        foreach ($parents as $parent) {
            $new_path = $path . $parent['sex'];

            if (! in_array($parent['id'], array_values($genealogy))) {
                if (is_null($parent['litter_id'])) {
                    $new_path = $new_path . 'X';
                    $genealogy[$new_path] = $parent['id'];
                } else {
                    // since we have never been there, we continue exploring upwards
                    $approx = $this->genealogy($parent['litter_id'], $new_path, $genealogy, $approx);
                    $genealogy[$new_path] = $parent['id'];
                }
            } else {
                 if (is_null($parent['litter_id'])) {
                    $new_path = $new_path . 'X';
                 } else {
                    // find other paths to the same id to copy already parsed ascendants
                    $copies = array_filter($genealogy, function ($id) use ($parent) {return $id == $parent['id'];});
                    foreach ($copies as $copy_path => $copy_id) {
                        $ancestors = array_filter(
                            $genealogy,
                            function ($ancestor) use ($copy_path) {
                                return str_starts_with($ancestor, $copy_path . 'F') || str_starts_with($ancestor, $copy_path . 'M');
                            },
                            ARRAY_FILTER_USE_KEY
                        );
                        if (! empty($ancestors)) {
                            // FIXME : some better criteria to decide to copy or not?
                            // copy only ancestors which might bring significant inbreeding, but copy more if low copy root
                            $limit = 30 - 2*strlen($copy_path);
                            foreach($ancestors as $ancestor_path => $ancestor_id) {
                                if (strlen($ancestor_path) < $limit) {
                                    // replace prefixes and write in genealogy
                                    $new_ancestor_path = substr_replace($ancestor_path, $new_path, 0, strlen($copy_path));
                                    $genealogy[$new_ancestor_path] = $ancestor_id;
                                } else {
                                    $approx = true; // approximation tracker
                                }
                            }
                        }
                    }
                }
                $genealogy[$new_path] = $parent['id'];
            }
        }
        return $approx;
    }

    /**
     * Coefficients methods
     * Returns inbreeding coefficients (AVK, COI) and associated coancestry
     * Returns only COI if $flag = false
     * Only used as fallback for the client-side javascript computation
     * Should probably be in the model
     *
     */
     public function coefficients($genealogy = null, &$sub_coefs = [], $limit = 17, $approx = false, $flag = true)
     {
         $this->Authorization->skipAuthorization();
         if($genealogy == null) {
             $coefficients = [
                 'coi' => 'Unknown',
                 'avk' => 'Unknown'
             ];
         }

         // find duplicates
         $counts = array_count_values($genealogy);
         $duplicates = array_filter($genealogy, function ($value) use ($counts) {
             return ($value != 1 && $counts[$value] > 1);
         });

         $unique_duplicates = array_unique($duplicates);
         asort($unique_duplicates);
         $coi = 0;
         $coancestry = [];

         foreach($unique_duplicates as $sub_path => $duplicate) {

             $sub_path = trim($sub_path, 'X');
             $sub_path_length = strlen($sub_path);

             // extract all lines from $duplicates which share the same value (same duplicate id)
             $contribution = 0;

             $paths = array_filter($duplicates, function($value) use ($duplicate) {
                 return ($value == $duplicate);
             });

             $paths = array_keys($paths);

             $f_paths = array_filter($paths, function ($input) {return $input[0] == 'F';});
             $m_paths = array_filter($paths, function ($input) {return $input[0] == 'M';});

             // loop on pairs of path {(mother to ancestor),(father to ancestor)}
             if (! empty($f_paths) && ! empty($m_paths)) {
                 foreach($f_paths as $f_path) {
                     $f_path = trim($f_path,'X');
                     $f_path_length = strlen($f_path);
                     if ($f_path_length < $limit) {
                     //  $approx = true;
                     //} else {
                         $f_labels = array();
                         for ($i = 1; $i <= $f_path_length-1 ; $i++) {
                             array_push($f_labels, $genealogy[substr($f_path, 0, $i)]);
                         }

                         // now check if some rats in f_path are in some m_paths to prune the latter
                         foreach($m_paths as $m_path) {
                             $m_path = trim($m_path, 'X');
                             $m_path_length = strlen($m_path);
                             if ($m_path_length < $limit) {
                             //  $approx = true;
                             //} else {
                                 $overlap = false;
                                 // if overlapping path, prune it
                                 for ($j = 1; $j <= $m_path_length-1; $j++) {
                                     $m_label = $genealogy[substr($m_path, 0, $j)];
                                     if (in_array($m_label, $f_labels)) {
                                         $overlap = true;
                                         break;
                                     }
                                 }

                                 if (! $overlap) {
                                     // get subgenealogy of coancestor and compute its own inbreeding coefficient if still unknown
                                     if (! in_array($duplicate, $sub_coefs)) {
                                         if(($f_path_length + $m_path_length) < $limit) {
                                             $sub_genealogy = array();
                                             foreach ($genealogy as $key => $val) {
                                                 if (substr($key, 0, $sub_path_length) === $sub_path) {
                                                     $sub_genealogy[substr($key, $sub_path_length)] = $genealogy[$key];
                                                 };
                                             }
                                             $new_limit = $limit; // could be used to modulate the limit as the tree grows
                                             $sub_coef = $this->coefficients($sub_genealogy, $sub_coefs, $new_limit, false, false);
                                             $sub_coefs[$duplicate] = $sub_coef['coi'];
                                             $contribution += 1/pow(2, $f_path_length + $m_path_length - 1) * (1 + $sub_coefs[$duplicate]/100);
                                         } else { // approximate common ancestor own inbreeding rate if it is far enough
                                             $sub_coefs[$duplicate] = 1.1257574; // LORD average COI of all rats
                                             $contribution += 1/pow(2, $f_path_length + $m_path_length - 1) * (1 + $sub_coefs[$duplicate]/100);
                                             $approx = true;
                                         }
                                     }
                                 }
                             }
                         }
                     }
                 }
             }

             if ($contribution > 0) {
                 $coi += $contribution;
                 $coancestry[$duplicate] = ['coi' => 100*$contribution]; // ['coi' => round(100 * $contribution,2)];

                 if ($flag) {
                     $name = $this->Rats->get($duplicate, [
                         'contain' => [
                             'Ratteries','BirthLitters','BirthLitters.Contributions',
                         ]
                     ])->usual_name;
                     $coancestry[$duplicate]['name'] = $name;
                 }
             }
         }

         $coefficients['coi'] = 100*$coi; // round(100 * $coi,2);

         // additional coefs we could not compute in the beginning
         if ($flag) {
             $coefficients['ancestor_number'] = count($genealogy);
             $coefficients['distinct_number'] = count(array_unique($genealogy));

             $leaves = array_filter($genealogy, function($key) {
                 return (substr($key, -1) == 'X');
             }, ARRAY_FILTER_USE_KEY);

             $coefficients['founder_number'] = count(array_unique($leaves));

             $depths = array_map('strlen', array_keys($leaves));
             $min_depth = min($depths);
             $coefficients['min_depth'] = $min_depth-1;
             $coefficients['max_depth'] = max($depths)-1;
             $coefficients['avk5'] = $this->computeAvk($genealogy, 5);
             $coefficients['avk10'] = $this->computeAvk($genealogy, 10);

             arsort($coancestry);
             $coefficients['coancestry'] = $coancestry;
             $coefficients['common_number'] = count($coancestry);
         }

         if ($coi == 0) {
             $approx = false;
         }
         $coefficients['approx'] = $approx;

         return $coefficients;
     }

     /**
      * ComputeAvk method
      *
      * Only used as fallback for the client-side javascript computation
      * Should probably be in the model
      *
      */
    public function computeAvk($genealogy, $level = 5)
    {
        $this->Authorization->skipAuthorization();
        $avk_genealogy = array_filter($genealogy, function($key) use ($level) {
            $key = trim($key,'X');
            return (strlen($key) <= $level);
        }, ARRAY_FILTER_USE_KEY);

        $known = count($avk_genealogy);
        // $unknown = (2**($level+1)-2)-$known;
        $unique = count(array_unique($avk_genealogy));
        // $avk = 100*round(($unique + $unknown)/($known + $unknown), 2);
        $avk = 100*round($unique/$known, 2);
        return $avk;
    }

    public function inbreedingApprox($id = null)
    {
        $this->Authorization->skipAuthorization();
        $litter = $this->Litters->get($id, [
            'contain' => [
                'States',
                'Sire.Ratteries', 'Sire.BirthLitters', 'Sire.BirthLitters.Contributions',
                'Dam.Ratteries', 'Dam.BirthLitters', 'Dam.BirthLitters.Contributions'
            ],
        ]);

        $limit = 17;
        $genealogy = [];
        $sub_coefs = [];
        $approx = $this->genealogy($id, '', $genealogy, false);
        $coefficients = $this->coefficients($genealogy, $sub_coefs, $limit, $approx, true);

        if ($coefficients['approx']) {
           $this->Flash->warning(__('This litter has a long or complicated family tree. We had to truncate it in order to compute (reasonably) approximate results.'));
        } else {
           $this->Flash->success(__('Good news! This litter’s family tree is simple enough and we managed to compute exact results.'));
        }

        $json = json_encode($genealogy);

        $this->set(compact('litter', 'genealogy', 'coefficients', 'json'));
    }

    public function inbreeding($id)
    {
        $this->Authorization->skipAuthorization();
        $litter = $this->Litters->get($id, [
            'contain' => [
                'States',
                'Sire.Ratteries', 'Sire.BirthLitters', 'Sire.BirthLitters.Contributions',
                'Dam.Ratteries', 'Dam.BirthLitters', 'Dam.BirthLitters.Contributions'
            ],
        ]);

        $genealogy = [];
        $index = [];
        $litter->spanningTree('', $genealogy, $index);
        $genealogy_json = json_encode($genealogy);
        $index_json = json_encode($index);

        $this->set(compact('litter', 'genealogy_json', 'index_json'));
    }

    /* State changes */

    public function freeze($id)
    {
        $this->request->allowMethod(['get', 'freeze']);
        $litter = $this->Litters->get($id, ['contain' => ['States']]);
        $this->Authorization->authorize($litter, 'changeState');
        if ($this->Litters->freeze($litter) && $this->Litters->save($litter, ['checkRules' => false])) {
            $this->Flash->success(__('This litter sheet is now frozen.'));
        } else {
            $this->Flash->error(__('We could not freeze the sheet. Please retry or contact an administrator.'));
        }

        return $this->redirect(['action' => 'view', $litter->id]);
    }

    public function thaw($id)
    {
        $this->request->allowMethod(['get', 'thaw']);
        $litter = $this->Litters->get($id, ['contain' => ['States']]);
        $this->Authorization->authorize($litter, 'editFrozen');
        if ($this->Litters->thaw($litter) && $this->Litters->save($litter, ['checkRules' => false])) {
            $this->Flash->success(__('This litter sheet is now unfrozen.'));
        } else {
            $this->Flash->error(__('We could not thaw the sheet. Please retry or contact an administrator.'));
        }
        return $this->redirect(['action' => 'view', $litter->id]);
    }

    public function approve($id)
    {
        $this->request->allowMethod(['get', 'approve']);
        $litter = $this->Litters->get($id, ['contain' => ['States']]);
        $this->Authorization->authorize($litter, 'changeState');
        if ($this->Litters->approve($litter) && $this->Litters->save($litter, ['checkRules' => false])) {
            $this->Flash->success(__('This rat sheet has been approved.'));
        } else {
            $this->Flash->error(__('We could not approve the sheet. Please retry or contact an administrator.'));
        }
        return $this->redirect(['action' => 'view', $litter->id]);
    }

    public function blame($id)
    {
        $this->request->allowMethod(['get', 'blame']);
        $litter = $this->Litters->get($id, ['contain' => ['States']]);
        $this->Authorization->authorize($litter, 'changeState');
        if ($this->Litters->blame($litter) && $this->Litters->save($litter, ['checkRules' => false])) {
            $this->Flash->success(__('This rat sheet has been unapproved.'));
        } else {
            $this->Flash->error(__('We could not unapprove the sheet. Please retry or contact an administrator.'));
        }
        return $this->redirect(['action' => 'view', $litter->id]);
    }
}
