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
        $this->Authentication->addUnauthenticatedActions(['index', 'view']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $litters = $this->paginate($this->Litters->find()->contain(['Users', 'States', 'Sire', 'Dam']));
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

        $litter_ids = $this->Litters->find('entitledBy', ['user_id' => $user->id]);
        $query = $this->Litters
            ->find()
            ->where(['Litters.id IN' => $litter_ids])
            ->contain(['Users', 'States', 'Sire', 'Dam', 'Contributions']);

        $settings = [
            'order' => ['birth_date' => 'desc'],
            'sortableFields' => ['state_id', 'birth_date', 'pups_number'],
        ];

        $litters = $this->paginate($query, $settings);

        $pending = $this->Litters
            ->find('needsUser')
            ->where(['Litters.id in' => $litter_ids]);

        $count = $pending->count();

        if ($count) {
            $this->Flash->error(
                __('You have <strong>{0, plural, =1 {one sheet} other{# sheets}}</strong> to correct. Please check below and take action soon.', [$count]),
                ['escape' => false]
            );
        }

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
                'Users',
                'States',
                'OffspringRats',
                'OffspringRats.States',
                'Sire.Ratteries',
                'Sire.BirthLitters',
                'Sire.BirthLitters.Contributions',
                'Dam.Ratteries',
                'Dam.BirthLitters',
                'Dam.BirthLitters.Contributions',
                'Sire',
                'Sire.Markings',
                'Sire.Dilutions',
                'Sire.Colors',
                'Sire.Coats',
                'Sire.Earsets',
                'Sire.Singularities',
                'Sire.DeathPrimaryCauses',
                'Sire.DeathSecondaryCauses',
                'Sire.States',
                'Dam',
                'Dam.Markings',
                'Dam.Dilutions',
                'Dam.Colors',
                'Dam.Coats',
                'Dam.Earsets',
                'Dam.Singularities',
                'Dam.DeathPrimaryCauses',
                'Dam.DeathSecondaryCauses',
                'Dam.States',
                'Ratteries',
                'Contributions',
                'LitterSnapshots' => [
                    'sort' => [
                        'LitterSnapshots.created' => 'DESC',
                    ],
                ],
                'LitterSnapshots.States',
                'LitterMessages' => [
                    'sort' => [
                        'LitterMessages.created DESC',
                    ],
                ],
                'LitterMessages.Users',
            ],
        ]);

        $this->Authorization->skipAuthorization();

        $offspringsQuery = $this->Litters->OffspringRats
                                ->find('all', ['contain' => ['States', 'DeathPrimaryCauses', 'DeathSecondaryCauses', 'OwnerUsers', 'Ratteries']])
                                ->matching('BirthLitters', function (\Cake\ORM\Query $query) use ($litter) {
                                    return $query->where([
                                        'BirthLitters.id' => $litter->id
                                    ]);
                                })
                                ->order(['OffspringRats.name' => 'asc']);

        $offsprings = $this->paginate($offspringsQuery);

        // exclude lost rats from statistics
        $stats_offsprings = $offspringsQuery->where(['OR' => [
            'death_secondary_cause_id !=' => '1',
            'death_secondary_cause_id IS' => null,
        ]]);

        $stats = $litter->wrapStatistics($stats_offsprings);

        $states = $this->fetchModel('States');
        if($litter->state->is_frozen) {
            $next_thawed_state = $states->get($litter->state->next_thawed_state_id);
            $this->set(compact('next_thawed_state'));
        }
        else {
            $next_ko_state = $states->get($litter->state->next_ko_state_id);
            $next_ok_state = $states->get($litter->state->next_ok_state_id);
            if( !empty($litter->state->next_frozen_state_id) ) {
                $next_frozen_state = $states->get($litter->state->next_frozen_state_id);
                $this->set(compact('next_frozen_state'));
            }
            $this->set(compact('next_ko_state','next_ok_state'));
        };

        $snap_diffs = [];
        foreach ($litter->litter_snapshots as $snapshot) {
            $snap_diffs[$snapshot->id] = $this->Litters->snapCompareAsString($litter, $snapshot->id, ['contain' => ['ParentRats' => function ($q) {return $q->select(['id']);}]]);
        }

        $js_legends = json_encode([
            __('Survival rate'),
            __('Age (in months)'),
            __('Survival rate (%)'),
            __('Survival rate by age'),
            __(' % of litter pups reached this age'),
            __x('litter statistics', 'Age: between '),
            __x('litter statistics', ' and '),
            __x('litter statistics', ' months'),

        ]);

        $user = $this->request->getAttribute('identity');

        $this->set(compact('litter', 'offsprings', 'stats', 'snap_diffs', 'user', 'js_legends'));
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
                    'associated' => ['ParentRats', 'Contributions'],
                ]);

                $samelitter = $this->Litters->find('fromBirth', [
                    'birth_date' => $data['birth_date'],
                    'mother_id' => $data['mother_id'],
                ])->first();

                if (is_null($samelitter)) {
                    if ($this->Litters->save($litter)) {
                        $this->Flash->warning(__('The litter has been saved and will be examined by the staff soon. Please, check if automatically added contributions are correct.'));
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
            $rats = $this->fetchModel('Rats');
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
        $ratteries = $this->fetchModel('Ratteries');
        $creator_id = $this->Authentication->getIdentity()->get('id');
        $generic = $ratteries->find()->where(['is_generic IS' => true]);
        $rattery = (! is_null($ratteries->find('activeFromUser', ['users' => $creator_id])->first()))
                    ? $ratteries->find('activeFromUser', ['users' => $creator_id])
                    : $ratteries->find('mostRecentFromUser', ['users' => $creator_id]);
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

        if (count($parents) != 2) {
            $this->Flash->error(__('We could not find the parents you indicated. Please, ensure you selected them properly in the list, or retry with their identifiers.'));
            return $this->redirect(['action' => 'simulate']);
        }

        $data['mother_id'] = $parents[0];
        $data['father_id'] = $parents[1];

        $data['birth_date'] = \Cake\I18n\FrozenTime::today();

        $user_id = $this->Authentication->getIdentity()->get('id');
        $user = $this->fetchModel('Users')->get($user_id, ['contain' => 'Ratteries']);
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
        $rats = $this->fetchModel('Rats');
        $dam = $rats->get($parents[0], ['contain' => ['Ratteries', 'Coats', 'Colors', 'Dilutions', 'Markings', 'Earsets', 'OwnerUsers', 'OwnerUsers.Ratteries']]);
        $sire = $rats->get($parents[1], ['contain' => ['Ratteries', 'Coats', 'Colors', 'Dilutions', 'Markings', 'Earsets', 'OwnerUsers', 'OwnerUsers.Ratteries']]);
        $parents = [];

        if (! is_null($dam)) {
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
        }

        if (! is_null($sire)) {
            array_push($parents,
            [
                'id' => rand() . '_' . $sire->id,
                'true_id' => $sire->id,
                'name' => $sire->usual_name,
                'link' => \Cake\Routing\Router::Url(['controller' => 'Rats', 'action' => 'view', $sire->id]),
                'sex' => 'M',
                'description' => $sire->variety,
                'death'=> $sire->short_death_cause . ' (' . $sire->short_age_string . ')',
                'more_parents' => is_null($sire->litter_id) ? 0 : 1,
                '_parents' => [],
            ]);
        }

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

        $js_messages = json_encode([
            __('Easy peasy.'),
            __('Quite a lot, but I have seen worse.'),
            __('Wow, that was pretty intense!'),
            __('Oops, we hope your device is not smoking.'),
            __('You know some LORD’s developers in person, don’t you?'),
            __('generation'),
            __('generations'),
            __('rat'),
            __('rats'),
            __x('ancestor', 'None')
        ]);

        $this->set(compact('litter', 'sire', 'dam', 'json', 'genealogy_json', 'index_json', 'js_messages'));
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
            'contain' => [
                'ParentRats',
                'OffspringRats',
                'OffspringRats.DeathPrimaryCauses',
                'OffspringRats.DeathSecondaryCauses',
                'Ratteries',
                'Contributions',
                'Sire',
                'Dam',
                'States'
            ],
        ]);
        $this->Authorization->authorize($litter);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $litter = $this->Litters->patchEntity($litter, $this->request->getData(), [
                'associated' => ['ParentRats', 'Contributions', 'Contributions.Ratteries']
            ]);
            if ($this->Litters->save($litter, ['contain' => ['ParentRats' => function ($q) {return $q->select(['id']);}]])) {
                $this->Flash->success(__('The litter has been saved. If parents were edited, you might have to manually correct contributions.'));
                return $this->redirect(['action' => 'view', $litter->id]);
            }
            $this->Flash->error(__('The litter could not be saved. Please, try again.'));
        }

        $mother = $litter->dam[0];
        if (! empty($litter->sire)) {
            $father = $litter->sire[0];
        } else {
            $father = null;
        }

        $user = $this->request->getAttribute('identity');
        $show_staff = ! is_null($user) && $user->can('staffEdit', $litter);

        if (! $show_staff) {
            $this->Flash->warning( __('For data coherence, modifications of litters are restricted. Please, contact a staff member to change parents or birth date.'));
        }
        $this->set(compact('litter', 'mother', 'father', 'user', 'show_staff'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Litter id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $litter = $this->Litters->get($id, [
            'contain' => [
                'ParentRats',
                'Dam',
                'Sire',
                'Dam.BirthLitters.Contributions',
                'Dam.BirthLitters.Contributions.Ratteries',
                'Sire.BirthLitters.Contributions',
                'Sire.BirthLitters.Contributions.Ratteries',
                'OffspringRats',
                'OffspringRats.OwnerUsers',
                'OffspringRats.Ratteries',
                'OffspringRats.States',
                'OffspringRats.BirthLitters',
                'OffspringRats.BirthLitters.Contributions',
                'Contributions',
                'Contributions.Ratteries',
                'LitterMessages',
                'LitterSnapshots',
                'LitterSnapshots.States',
                'States'
            ]
        ]);

        $this->Authorization->authorize($litter);

        $deletable = count($litter->offspring_rats) == 0;

        if ($this->request->is(['patch', 'post', 'put'])) {

            // if litter has no attached offspring, it can be deleted
            if ($deletable) {
                if ($this->Litters->delete($litter)) {
                    $this->Flash->success(__('The litter sheet has been deleted. You can inform its creator by mail from their sheet below.'));
                    return $this->redirect(['controller' => 'Users', 'action' => 'view', $litter->creator_user_id]);
                } else {
                    $this->Flash->error(__('The litter sheet could not be deleted. It was not its time.'));
                    return $this->redirect(['action' => 'delete', $litter->id]);
                }
            }
        }

        if ($deletable) {
            $this->Flash->default(__('This litter can be deleted. Related messages and snapshots will be deleted. This operation is irreversible!'));

        } else {
            $this->Flash->error(__('Some rats are attached to this litter. You must edit their birth litters before being allowed to delete the litter sheet.'));
        }

        $snap_diffs = [];
        foreach ($litter->litter_snapshots as $snapshot) {
            $snap_diffs[$snapshot->id] = $this->Litters->snapDiffListAsString($litter, $snapshot->id);
        }

        $identity = $this->request->getAttribute('identity');
        $show_staff = ! is_null($identity) && $identity->can('edit', $litter);

        $this->set(compact('litter', 'identity', 'deletable', 'snap_diffs'));
    }

    /**
     * EditComment method
     *
     * @param string|null $id Litter id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editComment($id = null)
    {
        $litter = $this->Litters->get($id, [
            'contain' => [
                'ParentRats',
                'Ratteries',
                'Contributions',
                'Sire',
                'Dam',
                'States'
            ],
        ]);
        $this->Authorization->authorize($litter);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $litter = $this->Litters->patchEntity($litter, $this->request->getData());
            if ($this->Litters->save($litter, ['associated' => []])) {
                $this->Flash->success(__('Your new comment about the litter has been saved.'));
                return $this->redirect(['action' => 'view', $litter->id]);
            }
            $this->Flash->error(__('Your new comment about the litter could not be saved. Please, try again.'));
        }

        $user = $this->request->getAttribute('identity');
        $show_staff = ! is_null($user) && $user->can('staffEdit', $litter);

        $this->set(compact('litter', 'user', 'show_staff'));
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
                'Sire',
                'Sire.Ratteries',
                'Sire.BirthLitters',
                'Sire.BirthLitters.Contributions',
                'Dam',
                'Dam.Ratteries',
                'Dam.BirthLitters',
                'Dam.BirthLitters.Contributions',
                'ParentRats',
                'OffspringRats',
                'OffspringRats.DeathPrimaryCauses',
                'Contributions',
                'Contributions.Ratteries',
                'States'
            ],
        ]);

        $this->Authorization->authorize($litter);

        $contribution_types = $this->fetchModel('ContributionTypes')->find('all')->order('priority ASC');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->Litters->patchEntity($litter, $this->request->getData(), [
                'associated' => ['Contributions', 'Contributions.Ratteries', 'OffspringRats']
            ]);

            // silent edit of contributions is authorized just after litter creation
            if ($litter->state->is_default) {
                $this->Litters->removeBehavior('State');
            }
            if ($this->Litters->save($litter, [
                    'contain' => [
                        'Contributions' => [
                            'fields' => [
                                'id',
                                'contribution_type_id',
                                'litter_id',
                                'rattery_id'
                            ]
                        ]
                    ]
                ])
            ) {
                $this->Flash->success(__('The litter’s contributing ratteries have been updated.'));
                // silent edit of contributions is authorized just after litter creation
                if ($litter->state->is_default) {
                    $this->Litters->addBehavior('State');
                }
                return $this->redirect(['action' => 'view', $litter->id]);
            }
            //$this->Litters->addBehavior('State');
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
     * AttachRat method
     *
     * @param string|null $id Litter id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function attachRat($id = null)
    {
        $litter = $this->Litters->get($id, [
            'contain' => [
                'Sire', 'Sire.Ratteries', 'Sire.BirthLitters', 'Sire.BirthLitters.Contributions',
                'Dam', 'Dam.Ratteries', 'Dam.BirthLitters', 'Dam.BirthLitters.Contributions',
                'ParentRats',
                'OffspringRats', 'OffspringRats.DeathPrimaryCauses',
                'Ratteries',
                'Contributions', 'Contributions.Ratteries',
                'States'
            ],
        ]);

        $this->Authorization->authorize($litter, 'attachRat');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $rats = $this->fetchModel('Rats');
            $data = $this->request->getData();
            $rat = $rats->get($data['rat_id']);

            $rat->litter_id = $id;
            $rat->birth_date = $litter->birth_date;
            $rat->rattery_id = $litter->contributions['0']->rattery_id;
            if ($data['update_identifier']) {
                $rat->pedigree_identifier =  $litter->contributions['0']->rattery->prefix . $rat->id . $rat->sex ;
                $rat->is_pedigree_custom = false;
            } else {
                $rat->is_pedigree_custom = true;
            }

            $rats->removeBehavior('State');
            if ($rats->save($rat, ['checkrules' => false, 'associated' => []])) {
                $this->Flash->success(__('This rat has been successfully attached to the requested birth litter. Pups number might have to be checked.'));
                $count = $litter->countMy('rats', 'litter');
                if ($litter->pups_number < $count) {
                    $litter->pups_number = $litter->pups_number + 1;
                    $this->Litters->save($litter, ['checkRules' => false, 'atomic' => false]);
                }
                return $this->redirect(['controller' => 'rats', 'action' => 'view', $rat->id]);
            } else {
                $this->Flash->error(__('We could not attach the selected rat to this litter.'));
                return $this->redirect(['controller' => 'litters', 'action' => 'attachRat', $litter->id]);
            }
            $rats->addBehavior('State');

        }

        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('staffEdit', $litter);

        $this->set(compact('litter', 'user', 'show_staff'));
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
        $litter = $this->Litters->get($id, ['contain' => ['Contributions', 'States']]);
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
        $litters = $this->Litters
            ->find('inState', [
                'inState' => $inState
            ])
            ->contain(['Users', 'Sire', 'Dam', 'Contributions', 'States']);

        $litters = $this->paginate($litters);

        $this->set(compact('litters', 'inState'));
    }

    public function needsStaff()
    {
        $this->Authorization->authorize($this->Litters, 'filterByState');

        $litters = $this->Litters
            ->find('needsStaff')
            ->contain([
                'Users',
                'Sire',
                'Dam',
                'Contributions',
                'States',
                'LitterSnapshots' => ['sort' => ['LitterSnapshots.created' => 'DESC']],
                'LitterMessages' => ['sort' => ['LitterMessages.created' => 'DESC']],
            ]);

        $settings = [
            'order' => [
                'modified' => 'desc',
            ],
            'sortableFields' => [
                'state_id',
                'birth_date',
                'id',
                'Users.username',
                'modified'
            ]
        ];

        $litters = $this->paginate($litters, $settings);

        $identity = $this->request->getAttribute('identity');

        $this->set(compact('litters', 'identity'));
    }

    /**
     * Genealogy method
     * FIXME: should be protected?
     *
     * Recursive walk in the genealogy tree
     * Returns a flat table with [$path => $rat_id] rows
     *
     */
    public function genealogy($id, $path, &$genealogy, $approx = false, $limit = 17)
    {
        $this->Authorization->skipAuthorization();

        $parents = $this->fetchModel('Rats')->find()
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
                    $approx = $this->genealogy($parent['litter_id'], $new_path, $genealogy, $approx, $limit-1);
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
                            // $limit = 30 - 2*strlen($copy_path);
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
         if ($genealogy == null) {
             $coefficients = [
                 'coi' => __('N/A'),
                 'avk' => __('N/A'),
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
             $count = count($paths);

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
                 $coancestry[$duplicate] = ['coi' => 100*$contribution, 'count' => $count]; // ['coi' => round(100 * $contribution,2)];

                 if ($flag) {
                     $name = $this->fetchModel('Rats')->get($duplicate, [
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
        $avk = 100*round($unique/$known, 3);
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
        $approx = $this->genealogy($id, '', $genealogy, false, $limit);
        $coefficients_16 = $this->coefficients($genealogy, $sub_coefs, $limit, $approx, true);

        $limit = 6;
        $sub_coefs = [];
        $coefficients_5 = $this->coefficients($genealogy, $sub_coefs, $limit, $approx, true);

        $coefficients = $coefficients_16;
        $coefficients['coi16'] = $coefficients['coi'];
        $coefficients['coi5'] = $coefficients_5['coi'];

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

        $js_messages = json_encode([
            __('Easy peasy.'),
            __('Quite a lot, but I have seen worse.'),
            __('Wow, that was pretty intense!'),
            __('Oops, we hope your device is not smoking.'),
            __('You know some LORD’s developers in person, don’t you?'),
            __('generation'),
            __('generations'),
            __('rat'),
            __('rats'),
            __x('ancestor', 'None')
        ]);

        $this->set(compact(
            'litter',
            'genealogy_json',
            'index_json',
            'js_messages'
        ));
    }

    /* State changes */

    public function moderate($id) {
        $litter = $this->Litters->get($id, [
            'contain' => [
                'States',
            ],
        ]);

        $this->Authorization->authorize($litter, 'changeState');
        $litter = $this->Litters->patchEntity($litter, $this->request->getData());

        if ($this->Litters->save($litter, ['checkRules' => false])) {
            // state_id is up to date but not $rat->state entity; reload for updated flash message
            $this->Flash->success(__('This litter sheet is now in state: {0}.', [$this->fetchModel('States')->get($litter->state_id)->name]));

            if (! empty($this->request->getData('side_message'))) {
                $this->Flash->default(__('The following custom moderation message has been sent: {0}', [$this->request->getData('side_message')]));
            }
        } else {
            $this->Flash->error(__('We could not moderate the sheet. Please retry or contact an administrator.'));
        };

        return $this->redirect(['action' => 'view', $litter->id]);
    }

    public function dispute($id) {
        $litter = $this->Litters->get($id, [
            'contain' => [
                'States',
                'LitterMessages' => ['sort' => 'LitterMessages.created DESC'],
                'LitterMessages.Litters.States',
                'LitterMessages.Users'
            ],
        ]);

        $this->Authorization->authorize($litter);

        if ($this->request->is('post')) {
            // send back to staff and emit message
            $litter = $this->Litters->patchEntity($litter, $this->request->getData());

            if ($this->Litters->save($litter, ['checkRules' => false])) {
                $this->Flash->success(__('The sheet has been sent back to staff with your message.'));
                return $this->redirect(['action' => 'view', $litter->id]);
            } else {
                $this->Flash->success(__('Something went wrong. Please, try again or contact an administrator.'));
                return $this->redirect(['action' => 'view', $litter->id]);
            }
        }

        $identity = $this->request->getAttribute('identity');
        $this->set(compact('litter', 'identity'));
    }

    public function freeze($id)
    {
        $this->request->allowMethod(['get', 'post']);
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
        $this->request->allowMethod(['get', 'post']);
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
        $this->request->allowMethod(['get', 'post']);
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
        $this->request->allowMethod(['get', 'post']);
        $litter = $this->Litters->get($id, ['contain' => ['States']]);
        $this->Authorization->authorize($litter, 'changeState');
        if ($this->Litters->blame($litter) && $this->Litters->save($litter, ['checkRules' => false])) {
            $this->Flash->success(__('This rat sheet has been unapproved.'));
        } else {
            $this->Flash->error(__('We could not unapprove the sheet. Please retry or contact an administrator.'));
        }
        return $this->redirect(['action' => 'view', $litter->id]);
    }

    public function blameNeglected() {
        return $this->Litters->blameNeglected($this->Litters);
    }
}
