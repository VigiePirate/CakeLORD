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
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
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
            'contain' => ['Users', 'States', 'OffspringRats', 'OffspringRats.States',
            'Sire.Ratteries', 'Sire.BirthLitters', 'Sire.BirthLitters.Contributions',
            'Dam.Ratteries', 'Dam.BirthLitters', 'Dam.BirthLitters.Contributions',
            'Sire', 'Sire.Markings', 'Sire.Dilutions', 'Sire.Colors', 'Sire.Coats', 'Sire.Earsets','Sire.DeathPrimaryCauses','Sire.DeathSecondaryCauses',
            'Dam', 'Dam.Markings', 'Dam.Dilutions', 'Dam.Colors', 'Dam.Coats', 'Dam.Earsets','Dam.DeathPrimaryCauses','Dam.DeathSecondaryCauses',
            'Ratteries','Contributions', 'Conversations', 'LitterSnapshots',
            ],
        ]);

        $offspringsQuery = $this->Litters->OffspringRats
                                ->find('all', ['contain' => ['States', 'DeathPrimaryCauses','DeathSecondaryCauses','OwnerUsers']])
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

        $this->set(compact('litter', 'offsprings', 'stats'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // some of the stuff here should move to beforeMarshal?
        $litter = $this->Litters->newEmptyEntity([
            'associated' => ['ParentRats, Contributions']
        ]);

        if ($this->request->is('post')) {
            // this is not an unauthenticated action, so, test $result emptiness is not necessary?
            $result = $this->Authentication->getResult();

            if ($result->isValid()) {

                $data = $this->request->getData();
                $data['creator_user_id'] = $this->Authentication->getIdentityData('id');

                // check if mother was properly selected
                if (empty($data['mother_id'])) {
                    // autocomplete was not used
                    // try to find the pedigree
                    $this->loadModel('Rats');
                    $mother = $this->Rats->findByPedigreeIdentifier($data['mother_name'])->toList();
                    if ((! empty($mother)) && $mother['sex'] == 'F') {
                        $mother_id = $mother['0']['id'];
                    } else {
                        $mother_id = 0;
                        unset($data['mother_id']);
                    }
                } else {
                    $mother_id = $data['mother_id'];
                }

                // check if some father data were tentatively entered
                if (empty($data['father_id'])) {
                    // autocomplete was not used
                    // try to find the pedigree
                    $this->loadModel('Rats');
                    $father = $this->Rats->findByPedigreeIdentifier($data['father_name'])->toList();
                    if ((! empty($mother)) && $father['sex'] == 'M') {
                        $father_id = $father['0']['id'];
                    } else {
                        $father_id = 0;
                        unset($data['father_id']);
                    }
                } else {
                    $father_id = $data['father_id'];
                }

                if(empty($data['father_id'])) {
                    $data['parent_rats'] = ['_ids' => [$mother_id]];
                } else {
                    $data['parent_rats'] = ['_ids' => [$mother_id, $father_id]];
                }

                // check if a litter with the same birthdate and mother exists
                if (isset($data['mother_id']) && isset($data['birth_date'])) {
                    $samelitter = $this->Litters->find('fromBirth', [
                        'birth_date' => $data['birth_date'],
                        'mother_id' => $mother_id,
                    ])->first();

                    if (! empty($samelitter)) {
                        $this->Flash->error(__('This litter already exists. You can add rats to it directly.'));
                        return $this->redirect(['action' => 'view', $samelitter['id']]);
                    }
                }

                // add contributions
                // first, check rattery (javascript callback)
                if (empty($data['rattery_id'])) {
                    // autocomplete was not used
                    // try to find the prefix
                    $this->loadModel('Ratteries');
                    $rattery = $this->Ratteries->findByPrefix($data['rattery_name'])->toList();
                    if (! empty($rattery)) {
                        $rattery_id = $rattery['0']['id'];
                    } else {
                        $rattery_id = 0;
                        unset($data['rattery_id']);
                    }
                } else {
                    $rattery_id = $data['rattery_id'];
                }

                $data['contributions'] = [
                    [
                        'contribution_type_id' => '1',
                        'rattery_id' => $rattery_id,
                    ]
                ];

                // potential contribution is mother's owner's active rattery
                // could use a separate function in the rat model, returning the active rattery of its owner
                if($mother_id != 0) {
                    $this->loadModel('Rats');
                    $mother = $this->Rats->get($mother_id, [
                        'contain' => ['OwnerUsers','OwnerUsers.Ratteries']
                    ]);

                    $mother_rattery_id = $data['rattery_id'];
                    if (count($mother->owner_user->ratteries) == 1 && ! $mother->owner_user->ratteries['0']['is_generic']) {
                        $mother_rattery_id = $mother->owner_user->ratteries['0']['id'];
                        // activate rattery if needed
                        // ... code ...
                    } else {
                        foreach($mother->owner_user->ratteries as $rattery) {
                            if (! $rattery->is_generic && $rattery->is_alive) {
                                $mother_rattery_id = $rattery['id'];
                            } else {
                                // mother's owner has several ratteries, but none is active: we don't know what to do
                            }
                        }
                    }
                    if ($data['rattery_id'] != $mother_rattery_id) {
                        array_push($data['contributions'], [
                            'contribution_type_id' => '2',
                            'rattery_id' => $mother_rattery_id,
                        ]);
                    }
                }

                // potential contribution is father's owner's active rattery
                // could use a separate function in the rat model, returning the active rattery of its owner
                if ($father_id != 0) {
                    $father = $this->Rats->get($father_id, [
                        'contain' => ['OwnerUsers','OwnerUsers.Ratteries']
                    ]);

                    $father_rattery_id = $data['rattery_id'];
                    if(count($father->owner_user->ratteries) == 1) {
                        $father_rattery_id = $father->owner_user->ratteries['0']['id'];
                        // activate rattery if needed
                        // ... code ...
                    } else {
                        foreach($father->owner_user->ratteries as $rattery) {
                            if($rattery->is_alive) {
                                $father_rattery_id = $rattery['id'];
                            } else {
                                // mother's owner has several ratteries, but none is active: we don't know what to do
                            }
                        }
                    }
                    if( $data['rattery_id'] != $father_rattery_id ) {
                        array_push($data['contributions'], [
                            'contribution_type_id' => '3',
                            'rattery_id' => $father_rattery_id,
                        ]);
                    }
                }
                // patch and try saving
                $litter = $this->Litters->patchEntity($litter, $data, [
                    'associated' => ['ParentRats', 'Contributions']
                ]);

                if ($this->Litters->save($litter)) {
                    $this->Flash->success(__('The litter has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The litter could not be saved. Please, read explanatory messages in the form, check and correct your entry, and try again.'));

            } else {
                $this->Flash->error(__('Only registered users are allowed to register a new litter. Please sign in or sign up before proceeding.')); // . $email->smtpError);
                return $this->redirect(['action' => 'login']);
            }
        } else {
            $this->Flash->default(__('Please record the litter’s main information below. You will be able to add rats to the litter just after.'));
        }

        $this->set(compact('litter'));
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
            'contain' => ['ParentRats', 'Ratteries', 'Contributions'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $litter = $this->Litters->patchEntity($litter, $this->request->getData());
            if ($this->Litters->save($litter)) {
                $this->Flash->success(__('The litter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The litter could not be saved. Please, try again.'));
        }
        $users = $this->Litters->Users->find('list', ['limit' => 200]);
        $states = $this->Litters->States->find('list', ['limit' => 200]);
        $parentRats = $this->Litters->ParentRats->find('list', ['limit' => 200]);
        $ratteries = $this->Litters->Ratteries->find('list', ['limit' => 200]);
        $contributions = $this->Litters->Contributions->find('list', ['limit' => 200]);
        $this->set(compact('litter', 'users', 'states', 'parentRats', 'ratteries', 'contributions'));
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
     *
     * Recursive walk in the genealogy tree
     * Returns a flat table with [$path => $litter_id] rows
     *
     */

    public function genealogy($id, $path, &$genealogy, $approx = false)
    {
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
                            $limit = 32 - 2*strlen($copy_path);
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
     * SpanningTree method
     *
     * Recursive walk in the genealogy tree
     * (ancestors of an already met ancestor are not rewritten)
     * Returns a flat table with [$path => $litter_id] rows
     *
     */
    public function spanningTree($id, $path = '', &$genealogy = null, &$index = null)
    {
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

            if (in_array($parent['id'], array_values($genealogy))) {
                if (is_null($parent['litter_id'])) {
                    $new_path = $new_path . 'X';
                } else {
                    $new_path = $new_path . 'Y';
                }
                $genealogy[$new_path] = $parent['id'];
            } else {
                $index[$parent['id']] = $new_path;
                if (is_null($parent['litter_id'])) {
                    $new_path = $new_path . 'X';
                    $genealogy[$new_path] = $parent['id'];
                } else {
                    // since we have never been there and there is more, we continue exploring upwards
                    $this->spanningTree($parent['litter_id'], $new_path, $genealogy, $index);
                    $genealogy[$new_path] = $parent['id'];
                }
            }
        }
        return null;
    }

    /**
     * Coefficients methods
     *
     * Returns inbreeding coefficients (AVK, COI) and associated coancestry
     * Returns only COI if $flag = false
     * Should probably be in the model
     *
     */
     public function coefficients($genealogy = null, &$sub_coefs = [], $limit = 18, $approx = false, $flag = true)
     {
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
                                             $new_limit = $limit - 2;
                                             $sub_coef = $this->coefficients($sub_genealogy, $sub_coefs, $new_limit, false, false);
                                             $sub_coefs[$duplicate] = $sub_coef['coi'];
                                             $contribution += 1/pow(2, $f_path_length + $m_path_length - 1) * (1 + $sub_coefs[$duplicate]/100);
                                         } else { // approximate common ancestor own inbreeding rate if it is far enough
                                             // $sub_coefs[$duplicate] = 25; // negligible if not high
                                             $sub_coefs[$duplicate] = 1.1257574; // LORD average COI of all rats
                                             // $sub_coefs[$duplicate] = 8.3460252; // LORD average COI of inbred rats
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

    public function computeAvk($genealogy, $level = 5)
    {
        $avk_genealogy = array_filter($genealogy, function($key) use ($level) {
            $key = trim($key,'X');
            return (strlen($key) <= $level);
        }, ARRAY_FILTER_USE_KEY);

        $known = count($avk_genealogy);
        $unknown = (2**($level+1)-2)-$known;
        $unique = count(array_unique($avk_genealogy));
        $avk = 100*round(($unique + $unknown)/($known + $unknown), 2);
        return $avk;
    }

    public function inbreedingServer($id = null)
    {
        $litter = $this->Litters->get($id, [
            'contain' => [
                'States',
                'Sire.Ratteries', 'Sire.BirthLitters', 'Sire.BirthLitters.Contributions',
                'Dam.Ratteries', 'Dam.BirthLitters', 'Dam.BirthLitters.Contributions'
            ],
        ]);

        $limit = 19;
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

        // $this->spanningTree($id, '', $genealogy, false);
        // $this->set(compact('litter', 'genealogy'));
    }

    public function inbreedingClient($id)
    {
        $litter = $this->Litters->get($id, [
            'contain' => [
                'States',
                'Sire.Ratteries', 'Sire.BirthLitters', 'Sire.BirthLitters.Contributions',
                'Dam.Ratteries', 'Dam.BirthLitters', 'Dam.BirthLitters.Contributions'
            ],
        ]);

        $genealogy = [];
        $index = [];
        $this->spanningTree($id, '', $genealogy, $index);
        // sort genealogy by path length (easier in php than javascript)
        // $keys = array_map('strlen', array_keys($genealogy));
        // array_multisort($keys, SORT_DESC, $genealogy);
        $genealogy_json = json_encode($genealogy);
        $index_json = json_encode($index);

        $this->set(compact('litter', 'genealogy_json', 'index_json',
            // 'genealogy', 'index' // for debug, to be deleted later
        ));
        // $this->viewBuilder()->setOption('serialize', ['genealogy']);
    }
}
