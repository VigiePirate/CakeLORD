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
        $this->set(compact('litter', 'offsprings'));
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
            // this is not an unauthenticated action, so, test $result emptiness is not necessary
            $result = $this->Authentication->getResult();

            if ($result->isValid()) {

                $data = $this->request->getData();

                // check if a litter with the same birthdate and mother exists
                $mother_id = $data['mother_id'];
                $samelitter = $this->Litters->find('fromBirth', [
                    'birth_date' => $data['birth_date'],
                    'mother_id' => $mother_id,
                ])->first();
                if (! empty($samelitter)) {
                    $this->Flash->error(__('This litter already exists.'));
                    return $this->redirect(['action' => 'view', $samelitter['id']]);
                } else {

                    $data['creator_user_id'] = $this->Authentication->getIdentityData('id');

                    if (! empty($this->request->getData('father_id'))) {
                        $father_id = $this->request->getData('father_id');
                        $data['parent_rats'] = ['_ids' => [$mother_id, $father_id]];
                    } else {
                        $data['parent_rats'] = ['_ids' => [$mother_id]];
                    };

                    // add contributions
                    $data['contributions'] = [
                        [
                            'contribution_type_id' => '1',
                            'rattery_id' => $data['rattery_id']
                        ]
                    ];

                    // potential contribution is mother's owner's active rattery
                    // could use a separate function in the rat model, returning the active rattery of its owner
                    $this->loadModel('Rats');
                    $mother = $this->Rats->get($mother_id, [
                        'contain' => ['OwnerUsers','OwnerUsers.Ratteries']
                    ]);

                    $mother_rattery_id = $data['rattery_id'];
                    if(count($mother->owner_user->ratteries) == 1 && ! $mother->owner_user->ratteries['0']['is_generic']) {
                        $mother_rattery_id = $mother->owner_user->ratteries['0']['id'];
                        // activate rattery if needed
                        // ... code ...
                    } else {
                        foreach($mother->owner_user->ratteries as $rattery) {
                            if(! $rattery->is_generic && $rattery->is_alive) {
                                $mother_rattery_id = $rattery['id'];
                            } else {
                                // mother's owner has several ratteries, but none is active: we don't know what to do
                            }
                        }
                    }
                    if( $data['rattery_id'] != $mother_rattery_id ) {
                        array_push($data['contributions'], [
                            'contribution_type_id' => '2',
                            'rattery_id' => $mother_rattery_id,
                        ]);
                    }

                    // potential contribution is father's owner's active rattery
                    // could use a separate function in the rat model, returning the active rattery of its owner
                    if (! empty($data['father_id'])) {
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

                    // patch and save
                    $litter = $this->Litters->patchEntity($litter, $data, [
                        'associated' => ['ParentRats', 'Contributions']
                    ]);

                    if ($this->Litters->save($litter)) {
                        $this->Flash->success(__('The litter has been saved.'));

                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('The litter could not be saved. Please, read explanatory messages in the form and try again.'));
                }
            } else {
                $this->Flash->error(__('Only registered users are allowed to register a new litter. Please sign in or sign up before proceeding.')); // . $email->smtpError);
                return $this->redirect(['action' => 'login']);
            }
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

    public function genealogy($id = null, $path)
    {
        $this->loadModel('Rats');
        $parents = $this->Rats->find()
            ->select(['id', 'litter_id', 'sex'])
            ->matching('BredLitters', function ($query) use ($id) {
                return $query->where(['BredLitters.id' => $id]);
            })
            ->all();

        // no test on parent existence, since a litter must have at least one parent
        foreach ($parents as $parent) {

            if (! is_null($parent['litter_id'])) {
                $new_path = $path . $parent->sex;
                $genealogy[$new_path] = $parent['id'];
                $genealogy = array_merge($genealogy, $this->genealogy($parent['litter_id'], $new_path));
            } else {
                $new_path = $path . $parent->sex . 'X';
                $genealogy[$new_path] = $parent['id'];
            }
        }
        return $genealogy;
    }

    /**
     * Coefficients methods
     *
     * Returns inbreeding coefficients (AVK, COI) and associated coancestry
     * Returns only COI if $flag = false
     * Should probably be in the model
     *
     */
    public function coefficients($genealogy = null, $flag = true) {
        if($genealogy == null) {
            $coefficients = [
                'coi' => 'Unknown',
                'avk' => 'Unknown'
            ];
        }

        // compute supplementary stuff only if needed
        if ($flag) {
            // will be needed later for common ancestors name
            $this->loadModel('Rats');

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

            // for avk computation, we need to truncate tree at minDepth
            $avk_genealogy = array_filter($genealogy, function($key) use ($min_depth) {
                $key = trim($key,'X');
                return (strlen($key) <= $min_depth);
            }, ARRAY_FILTER_USE_KEY);

            $coefficients['avk'] = round(100 * count(array_unique($avk_genealogy)) / count($avk_genealogy),2);
        }

        // find and filter duplicates in a limited number of generations (here:8)
        $short_gen = array();
        foreach ($genealogy as $key => $value) {
            if (strlen($key) < 9) {
                // fixme: different processing if last character is 'X' or not!
                $short_gen[substr($key,0,8)] = $value;
            }
        }

        $counts = array_count_values($short_gen);
        $duplicates = array_filter($short_gen, function ($value) use ($counts) {
            return $counts[$value] > 1;
        });
        $duplicate_id_list = array_unique($duplicates);
        /* $coefficients['common_number'] = count($duplicate_id_list); */

        $coi = 0;
        $coancestry = [];

        // sort out by decreasing path length to compute coancestors inbreeding easily?
        foreach($duplicate_id_list as $sub_path => $duplicate) {

            // extract all lines from $duplicates which share the same value (duplicate id)
            $contribution = 0;

            $paths = array_filter($duplicates, function($value) use ($duplicate) {
                return ($value == $duplicate);
            });

            $paths = array_keys($paths);

            $f_paths = array_filter($paths, function ($input) {return $input[0] == 'F';});
            $m_paths = array_filter($paths, function ($input) {return $input[0] == 'M';});

            // loop on pairs of path {(mother to ancestor),(father to ancestor)}
            foreach($f_paths as $f_path) {
                // trim f_path
                $f_path = trim($f_path,'X');
                // fetch rats on the way
                $f_path_length = strlen($f_path);
                $f_labels = array();
                for ($i = 1; $i <= $f_path_length-1 ; $i++) {
                    array_push($f_labels, $short_gen[substr($f_path,0,$i)]);
                }
                // now check if some rats in f_path are in some m_paths to prune them
                $overlap = false;
                foreach($m_paths as $m_path) {

                    // trim m_path
                    $m_path = trim($m_path,'X');
                    $m_path_length = strlen($m_path);
                    // if overlapping paths, prune it
                    for ($j = 1; $j <= $m_path_length-1; $j++) {
                        $m_label = $short_gen[substr($m_path,0,$j)];
                        if(in_array($m_label,$f_labels)) {
                            $overlap = true;
                            break;
                        }
                    }
                    if (! $overlap) {
                        // here: get subgenealogy of coancestor and compute its own inbreeding
                        $sub_genealogy = array();
                        $sub_path = trim($sub_path,'X');
                        foreach($genealogy as $key => $val) {
                            //array_filter($genealogy, function($key) use ($sub_path) {
                            if (substr($key,0,strlen($sub_path)) === $sub_path) {
                                $sub_genealogy[substr($key,strlen($sub_path))] = $genealogy[$key];
                            };
                        }
                        $subcoef = $this->coefficients($sub_genealogy, false);
                        $contribution += 1/pow(2,$f_path_length + $m_path_length - 1) * (1 + $subcoef['coi']/100);
                    }
                }
            }

            if ($contribution > 0) {
                $coi += $contribution;

                if($contribution > 0.0001) {
                    $coancestry[$duplicate] = ['coi' => round(100 * $contribution,2)];

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
        }

        $coefficients['coi'] = round(100 * $coi,2);

        if ($flag) {
            arsort($coancestry);
            $coefficients['coancestry'] = $coancestry;
        }

        return $coefficients;
    }

    public function inbreeding($id = null)
    {
        $litter = $this->Litters->get($id, [
            'contain' => [
                'States',
                'Sire.Ratteries', 'Sire.BirthLitters', 'Sire.BirthLitters.Contributions',
                'Dam.Ratteries', 'Dam.BirthLitters', 'Dam.BirthLitters.Contributions'
            ],
        ]);
        $genealogy = $this->genealogy($id,'');
        $coefficients = $this->coefficients($genealogy);

        $this->set(compact('litter','genealogy','coefficients'));
    }
}
