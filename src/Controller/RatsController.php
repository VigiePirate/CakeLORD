<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Chronos\Chronos;
use Cake\Collection\Collection;
use Cake\I18n\I18n;
use Cake\Routing\Router;

/**
 * Rats Controller
 *
 * @property \App\Model\Table\RatsTable $Rats
 *
 * @method \App\Model\Entity\Rat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RatsController extends AppController
{
    protected $searchable_only;

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->addUnauthenticatedActions([
            'index',
            'view',
            'named',
            'fromRattery',
            'byRattery',
            'ownedBy',
            'byOwner',
            'sex',
            'search',
            'results',
            'pedigree',
            'parentsTree',
            'childrenTree',
        ]);

        $identity = $this->request->getAttribute('identity');
        $this->searchable_only = is_null($identity) || ! $identity->can('filterByState', $this->Rats);

        /* FIXME
         * The previous call to "can" counts as an authorization check
         * Methods which don't perform their authorization check own won't raise an issue!!
         * This problem can be avoided by patching the Authorization plugin with an uncheckAuthorization() method
        */
        //$this->Authorization->uncheckAuthorization();
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $query = $this->Rats->find('all', ['searchable_only' => $this->searchable_only])
            ->contain(['OwnerUsers', 'Ratteries', 'BirthLitters', 'BirthLitters.Contributions', 'States']);
        $this->set('rats', $this->paginate($query));
    }

    /**
     * My method
     *
     * @return \Cake\Http\Response|null
     */
    public function my()
    {
        $user = $this->Authentication->getIdentity();
        $this->Authorization->skipAuthorization();

        $contain = [
            'Ratteries',
            'OwnerUsers',
            'States',
            'DeathPrimaryCauses',
            'DeathSecondaryCauses',
            'BirthLitters',
            'BirthLitters.Contributions',
            'BirthLitters.Ratteries'
        ];

        $females = $this->Rats->find()
            ->where(['Rats.owner_user_id' => $user->id, 'Rats.sex' => 'F'])
            ->order('Rats.birth_date DESC')
            ->contain($contain);
        $males = $this->Rats->find()
            ->where(['Rats.owner_user_id' => $user->id, 'Rats.sex' => 'M'])
            ->order('Rats.birth_date DESC')
            ->contain($contain);
        $alive = $this->Rats->find()
            ->where(['Rats.owner_user_id' => $user->id, 'Rats.is_alive' => true])
            ->order('Rats.birth_date DESC')
            ->contain($contain);
        $departed = $this->Rats->find()
            ->where(['Rats.owner_user_id' => $user->id, 'Rats.is_alive' => false])
            ->order('Rats.birth_date DESC')
            ->contain($contain);
        $pending = $this->Rats->find()
            ->where(['Rats.owner_user_id' => $user->id, 'States.needs_user_action' => true])
            ->order('Rats.birth_date DESC')
            ->contain($contain);
        $waiting = $this->Rats->find()
            ->where(['Rats.owner_user_id' => $user->id, 'States.needs_staff_action' => true])
            ->order('Rats.birth_date DESC')
            ->contain($contain);
        $okrats = $this->Rats->find()
            ->where(['Rats.owner_user_id' => $user->id, 'States.needs_user_action' => false, 'States.needs_staff_action' => false])
            ->order('Rats.birth_date DESC')
            ->contain($contain);

        $count = $pending->count();

        if ($count) {
            $this->Flash->error(
                __('You have <strong>{0, plural, =1 {one sheet} other{# sheets}}</strong> to correct. Please check below and take action soon.', [$count]),
                ['escape' => false]
            );
        }
        $this->set(compact('females', 'males', 'alive', 'departed', 'pending', 'waiting', 'okrats', 'user'));
    }

    /**
     * View method
     *
     * @param string|null $id Rat id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $rat = $this->Rats->get($id, [
            'contain' => [
                'OwnerUsers',
                'CreatorUsers',
                'Ratteries',
                'BirthLitters',
                'BirthLitters.Ratteries',
                'BirthLitters.Contributions',
                'BirthLitters.Sire',
                'BirthLitters.Sire.States',
                'BirthLitters.Sire.BirthLitters',
                'BirthLitters.Sire.BirthLitters.Contributions',
                'BirthLitters.Dam',
                'BirthLitters.Dam.States',
                'BirthLitters.Dam.BirthLitters',
                'BirthLitters.Dam.BirthLitters.Contributions',
                'Colors',
                'Eyecolors',
                'Dilutions',
                'Markings',
                'Earsets',
                'Coats',
                'Singularities',
                'DeathPrimaryCauses',
                'DeathSecondaryCauses',
                'States',
                'BredLitters' => function($q) {
                    return $q
                    ->order('birth_date DESC')
                    ->limit(10);
                },
                'BredLitters.Contributions',
                'BredLitters.Ratteries',
                'BredLitters.Sire',
                'BredLitters.Sire.BirthLitters',
                'BredLitters.Sire.BirthLitters.Contributions',
                'BredLitters.Dam',
                'BredLitters.Dam.BirthLitters',
                'BredLitters.Dam.BirthLitters.Contributions',
                'BredLitters.OffspringRats',
                'BredLitters.OffspringRats.Ratteries',
                'BredLitters.OffspringRats.BirthLitters',
                'BredLitters.OffspringRats.BirthLitters.Contributions',
                'BredLitters.OffspringRats.OwnerUsers',
                'BredLitters.OffspringRats.States',
                'BredLitters.OffspringRats.DeathPrimaryCauses',
                'BredLitters.OffspringRats.DeathSecondaryCauses',
                'RatSnapshots' => ['sort' => ['RatSnapshots.created' => 'DESC']],
                'RatSnapshots.States',
                'RatMessages' => ['sort' => ['RatMessages.created' => 'DESC']],
                'RatMessages.Users',
            ],
        ]);

        $states = $this->fetchModel('States');
        if ($rat->state->is_frozen) {
            if (! is_null($rat->state->next_frozen_state_id)) {
                $next_frozen_state = $states->get($rat->state->next_frozen_state_id);
            } else {
                $next_frozen_state = null;
            }
            $next_thawed_state = $states->get($rat->state->next_thawed_state_id);
            $this->set(compact('next_thawed_state', 'next_frozen_state'));
        }
        else {
            $next_ko_state = $states->get($rat->state->next_ko_state_id);
            $next_ok_state = $states->get($rat->state->next_ok_state_id);
            if (! empty($rat->state->next_frozen_state_id)) {
                $next_frozen_state = $states->get($rat->state->next_frozen_state_id);
                $this->set(compact('next_frozen_state'));
            }
            $this->set(compact('next_ko_state', 'next_ok_state'));
        };

        $snap_diffs = [];
        foreach ($rat->rat_snapshots as $snapshot) {
            $snap_diffs[$snapshot->id] = $this->Rats->snapDiffListAsString($rat, $snapshot->id, ['contain' => ['Singularities' => function ($q) {return $q->select(['id']);}]]);
        }

        $user = $this->request->getAttribute('identity');

        $this->set(compact('rat', 'snap_diffs', 'user'));
    }

    /**
     * Add method
     *
     * FIXME: litter_id as optional input (pre-fill form, read-only fields?)
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rat = $this->Rats->newEmptyEntity();
        $this->Authorization->skipAuthorization();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $rat_options = [
                'associated' => [
                    'Ratteries',
                    'BirthLitters',
                    'Singularities' => ['onlyIds' => true],
                    'DeathPrimaryCauses',
                    'DeathSecondaryCauses'
                ],
                'accessibleFields' => [
                    'pedigree_identifier' => true
                ],
            ];

            if (! empty($data['mother_name'])) {
                $litters = $this->getTableLocator()->get('Litters');

                $samelitter = $litters->find('fromBirth', [
                    'birth_date' => $data['birth_date'],
                    'mother_id' => $data['mother_id'],
                    'searchable_only' => $this->searchable_only
                ])
                ->contain(['ParentRats', 'Contributions'])
                ->first();

                if (! is_null($samelitter)) {
                    $data['litter_id'] = $samelitter->id;
                    $data['rattery_id'] = $samelitter->contributions[0]->rattery_id;
                    $rat = $this->Rats->patchEntity($rat, $data, $rat_options);
                    if ($this->Rats->save($rat)) {
                        $this->Flash->success(__('The rat has been saved and attached to the litter below.'));
                        return $this->redirect(['controller' => 'Litters', 'action' => 'view', $samelitter->id]);
                    } else {
                        $this->Flash->error(__('The rat could not be saved. Please, read explanatory messages in the form, check and correct your entry, and try again.'));
                    }
                } else {
                    $litter_options = [
                        'from_rat' => true,
                        'associated' => ['ParentRats', 'Contributions'],
                        'accessibleFields' => ['pups_number' => true],
                    ];
                    $data['pups_number'] = 0;
                    $litter = $litters->newEntity($data, $litter_options); //FIXME check contributions[0] has a rattery
                    if ($litters->save($litter, $litter_options)) {
                        $data['litter_id'] = $litter->id;
                        $data['rattery_id'] = $litter->contributions[0]->rattery_id;
                        $rat = $this->Rats->patchEntity($rat, $data, $rat_options);
                        if ($this->Rats->save($rat)) {
                            $this->Flash->success(__('The rat has been saved as well as its birth litter, and attached to it.'));
                            return $this->redirect(['controller' => 'Litters', 'action' => 'view', $litter->id]);
                        } else {
                            $this->Flash->error(__('The rat could not be saved. Please, read explanatory messages in the form, check and correct your entry, and try again.'));
                        }
                    } else {
                        $rat = $this->Rats->patchEntity($rat, $data, $rat_options);
                        if ($this->Rats->save($rat)) {
                            $this->Flash->warning(__('The rat has been saved, but could not be attached to any litter.'));
                            return $this->redirect(['action' => 'view', $rat->id]);
                        } else {
                            $rat->setErrors(array_replace_recursive($rat->getErrors(), $litter->getErrors()));
                            $this->Flash->error(__('The rat and its birth litter could not be saved. Please, read explanatory messages below and try again.'));
                        }
                    }
                }
            } else { // no mother entered
                $rat = $this->Rats->patchEntity($rat, $data, $rat_options);
                if ($this->Rats->save($rat)) {
                    $this->Flash->success(__('The rat has been saved.'));
                    return $this->redirect(['action' => 'view', $rat->id]);
                }  else {
                    $this->Flash->error(__('The rat could not be saved. Please, read explanatory messages in the form, check and correct your entry, and try again.'));
                }
            }

        // update death information for form reloading (in case of error elsewhere)
        if (! $rat->is_alive && ! is_null($rat->death_primary_cause_id)) {
            $death_secondary_causes_model = $this->fetchModel('DeathSecondaryCauses');
            $deathSecondaryCauses = $death_secondary_causes_model
                ->find('all')
                ->select(['id', 'name'])
                ->where(['death_primary_cause_id IS' => $rat->death_primary_cause_id])
                ->order(['id' => 'ASC'])
                ->all()->combine('id', 'name')->toArray();
            $this->set(compact('deathSecondaryCauses'));
        }

        // form
        } else {
            $this->Flash->default(__('Please record the rat’s information below. When in doubt, please check documentation before entering data.'));
        }

        $translate = (I18n::getLocale() == I18n::getDefaultLocale()) ? '' : 'Translation';
        $coats = $this->Rats->Coats->find('list', [
            'limit' => 200,
            'order' => [
                'CASE WHEN Coats__id = 1 THEN 0 ELSE 1 END', // first sort by id=1
                'Coats'.$translate.'__name ASC' // then sort by name
            ]
        ]);
        $colors = $this->Rats->Colors->find('list', [
            'limit' => 200,
            'order' => [
                'CASE WHEN Colors__id = 1 THEN 0 ELSE 1 END', // first sort by id=1
                'Colors'.$translate.'__name ASC' // then sort by name
            ]
        ]);
        $eyecolors = $this->Rats->Eyecolors->find('list', [
            'limit' => 200,
            'order' => [
                'CASE WHEN Eyecolors__id = 1 THEN 0 ELSE 1 END', // first sort by id=1
                'Eyecolors'.$translate.'__name ASC' // then sort by name
            ]
        ]);
        $dilutions = $this->Rats->Dilutions->find('list', [
            'limit' => 200,
            'order' => [
                'CASE WHEN Dilutions__id = 1 THEN 0 ELSE 1 END', // first sort by id=1
                'Dilutions'.$translate.'__name ASC' // then sort by name
            ]
        ]);
        $markings = $this->Rats->Markings->find('list', [
            'limit' => 200,
            'order' => [
                'CASE WHEN Markings__id = 1 THEN 0 ELSE 1 END', // first sort by id=1
                'Markings'.$translate.'__name ASC' // then sort by name
            ]
        ]);
        $earsets = $this->Rats->Earsets->find('list', [
            'limit' => 200,
            'order' => [
                'CASE WHEN Earsets__id = 1 THEN 0 ELSE 1 END', // first sort by id=1
                'Earsets'.$translate.'__name ASC' // then sort by name
            ]
        ]);
        $singularities = $this->Rats->Singularities->find('list', [
            'limit' => 200,
            'order' => [
                'Singularities'.$translate.'__name ASC' // sort by name
            ]
        ]);
        $states = $this->Rats->States->find('list', ['limit' => 200]);
        $creator_id = $this->Authentication->getIdentity()->get('id');

        $litter_id = $this->request->getParam('pass');
        if (empty($litter_id)) {
            $from_litter = false;
            $generic = $this->Rats->Ratteries->find()->where(['is_generic IS' => true]);
            $rattery = (! is_null($this->Rats->Ratteries->find('activeFromUser', ['users' => $creator_id])->first()))
                        ? $this->Rats->Ratteries->find('activeFromUser', ['users' => $creator_id])
                        : $this->Rats->Ratteries->find('mostRecentFromUser', ['users' => $creator_id]);
            $origins = $generic->all()->append($rattery)->combine('id', 'full_name');
            $this->set(compact('from_litter', 'origins'));
        } else {
            $from_litter = true;
            $litters = $this->getTableLocator()->get('Litters');
            $litter = $litters->get($litter_id, ['contain' => ['Sire', 'Dam', 'Contributions']]);
            $this->set(compact('from_litter', 'litter'));
        }

        // keeps "Unknown" as first cause and "Other" as last, sort the rest alphabetically
        // collation explicitly added to manage French character "Œ"
        $lastId = $this->Rats->DeathPrimaryCauses->find()->count();
        $deathPrimaryCauses = $this->Rats->DeathPrimaryCauses->find('list')
            ->order([
                'CASE WHEN DeathPrimaryCauses__id = 1 THEN 0 WHEN DeathPrimaryCauses__id = ' . $lastId . ' THEN 2 ELSE 1 END', // first sort by id=1
                'DeathPrimaryCauses'.$translate.'__name COLLATE utf8mb4_unicode_ci ASC' // then sort by name
            ]);

        $js_messages = json_encode([
            __('Please, read carefully information that will appear below to check the fitness of your choice.'),
            __('Please answer the following questions about euthanasia, diagnostics and analyses.'),
        ]);

        $placeholders = json_encode([
            'colors' => __('Type here to filter colors...'),
            'eyecolors' => __('Type here to filter eyecolors...'),
            'coats' => __('Type here to filter coats...'),
            'dilutions' => __('Type here to filter dilutions...'),
            'earsets' => __('Type here to filter earsets...'),
            'markings' => __('Type here to filter markings...'),
            'singularities' => __('Type here to filter singularities...'),
        ]);

        $this->set(compact(
            'rat',
            'colors',
            'eyecolors',
            'dilutions',
            'markings',
            'earsets',
            'coats',
            'singularities',
            'deathPrimaryCauses',
            'states',
            'creator_id',
            'js_messages',
            'placeholders'
        ));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rat id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rat = $this->Rats->get($id, [
            'contain' => [
                'OwnerUsers',
                'CreatorUsers',
                'Singularities',
                'Ratteries',
                'DeathPrimaryCauses',
                'DeathSecondaryCauses',
                'BirthLitters.Contributions.Ratteries',
                'BredLitters',
                'States'
            ],
        ]);
        $this->Authorization->authorize($rat);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $rat = $this->Rats->patchEntity($rat, $data);

            if (isset($data['generic_rattery_id'])  && $data['generic_rattery_id'] != "") {
                // remove birth litter
                if ($data['detach_from_birthlitter']) {
                    $rat->litter_id = null;
                }
                if ($data['update_identifier']) {
                    // prefix change
                    $ratteries = $this->fetchModel('Ratteries');
                    $prefix = $ratteries->get($data['generic_rattery_id'])->prefix;
                    $rat->pedigree_identifier =  $prefix . $rat->id . $rat->sex;
                    $rat->is_pedigree_custom = false;
                } else {
                    $rat->is_pedigree_custom = true;
                }
            } else {
                if ($data['update_identifier']) {
                    // sex change only
                    $old_identifier = $rat->pedigree_identifier;
                    $rat->pedigree_identifier =  substr($old_identifier, 0, -1) . $rat->sex;
                } else {
                    $rat->is_pedigree_custom = true;
                }
            }

            if ($this->Rats->save($rat, ['contain' => ['Singularities' => function ($q) {return $q->select(['id']);}]])) {
                $this->Flash->success(__('The rat has been saved.'));
                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error(__('The rat could not be saved. Please, try again.'));
        }

        // get and sort all descriptive traits properly
        $translate = (I18n::getLocale() == I18n::getDefaultLocale()) ? '' : 'Translation';
        $coats = $this->Rats->Coats->find('list', [
            'limit' => 200,
            'order' => [
                'CASE WHEN Coats__id = 1 THEN 0 ELSE 1 END', // first sort by id=1
                'Coats'.$translate.'__name ASC' // then sort by name
            ]
        ]);
        $colors = $this->Rats->Colors->find('list', [
            'limit' => 200,
            'order' => [
                'CASE WHEN Colors__id = 1 THEN 0 ELSE 1 END', // first sort by id=1
                'Colors'.$translate.'__name ASC' // then sort by name
            ]
        ]);
        $eyecolors = $this->Rats->Eyecolors->find('list', [
            'limit' => 200,
            'order' => [
                'CASE WHEN Eyecolors__id = 1 THEN 0 ELSE 1 END', // first sort by id=1
                'Eyecolors'.$translate.'__name ASC' // then sort by name
            ]
        ]);
        $dilutions = $this->Rats->Dilutions->find('list', [
            'limit' => 200,
            'order' => [
                'CASE WHEN Dilutions__id = 1 THEN 0 ELSE 1 END', // first sort by id=1
                'Dilutions'.$translate.'__name ASC' // then sort by name
            ]
        ]);
        $markings = $this->Rats->Markings->find('list', [
            'limit' => 200,
            'order' => [
                'CASE WHEN Markings__id = 1 THEN 0 ELSE 1 END', // first sort by id=1
                'Markings'.$translate.'__name ASC' // then sort by name
            ]
        ]);
        $earsets = $this->Rats->Earsets->find('list', [
            'limit' => 200,
            'order' => [
                'CASE WHEN Earsets__id = 1 THEN 0 ELSE 1 END', // first sort by id=1
                'Earsets'.$translate.'__name ASC' // then sort by name
            ]
        ]);
        $singularities = $this->Rats->Singularities->find('list', [
            'limit' => 200,
            'order' => [
                'Singularities'.$translate.'__name ASC' // sort by name
            ]
        ]);

        $generic = $this->Rats->Ratteries->find()->where(['is_generic IS' => true])->all()->combine('id', 'full_name');

        // keeps "Unknown" as first cause and "Other" as last, sort the rest alphabetically
        // collation explicitly added to manage French character "Œ"
        $lastId = $this->Rats->DeathPrimaryCauses->find()->count();
        $deathPrimaryCauses = $this->Rats->DeathPrimaryCauses->find('list')
            ->order([
                'CASE WHEN DeathPrimaryCauses__id = 1 THEN 0 WHEN DeathPrimaryCauses__id = ' . $lastId . ' THEN 2 ELSE 1 END', // first sort by id=1
                'DeathPrimaryCauses'.$translate.'__name COLLATE utf8mb4_unicode_ci ASC' // then sort by name
            ]);

        if (! $rat->is_alive && ! is_null($rat->death_primary_cause_id)) {
            $death_secondary_causes_model = $this->fetchModel('DeathSecondaryCauses');
            $deathSecondaryCauses = $death_secondary_causes_model
                ->find('all')
                ->select(['id', 'name'])
                ->where(['death_primary_cause_id IS' => $rat->death_primary_cause_id])
                ->order(['id' => 'ASC'])
                ->all()->combine('id', 'name')->toArray();
            $this->set(compact('deathSecondaryCauses'));
        }

        $placeholders = json_encode([
            'colors' => __('Type here to filter colors...'),
            'eyecolors' => __('Type here to filter eyecolors...'),
            'coats' => __('Type here to filter coats...'),
            'dilutions' => __('Type here to filter dilutions...'),
            'earsets' => __('Type here to filter earsets...'),
            'markings' => __('Type here to filter markings...'),
            'singularities' => __('Type here to filter singularities...'),
        ]);

        $user = $this->request->getAttribute('identity');
        $show_staff = ! is_null($user) && $user->can('staffEdit', $rat);

        if ($user->can('ownerEdit', $rat) && ! $user->can('staffEdit', $rat)) {
            $this->Flash->warning( __('For data coherence, modifications of rats are restricted. Please, use the “optional notification” field at the end of this form to request origins or birth date change.'));
        }

        $js_messages = json_encode([
            __('Please, read carefully information that will appear below to check the fitness of your choice.'),
            __('Please answer the following questions about euthanasia, diagnostics and analyses.'),
        ]);

        $this->set(compact(
            'rat',
            'colors',
            'eyecolors',
            'dilutions',
            'markings',
            'earsets',
            'coats',
            'singularities',
            'deathPrimaryCauses',
            'placeholders',
            'js_messages',
            'generic',
            'user',
            'show_staff'
        ));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $rat = $this->Rats->get($id, [
            'contain' => [
                'Ratteries',
                'BredLitters',
                'BredLitters.Contributions',
                'BredLitters.Sire',
                'BredLitters.Dam',
                'BredLitters.Users',
                'BredLitters.States',
                'BirthLitters',
                'BirthLitters.Contributions',
                'BirthLitters.Contributions.Ratteries',
                'RatMessages',
                'RatSnapshots',
                'RatSnapshots.States',
                'States'
            ]
        ]);

        $this->Authorization->authorize($rat);

        $deletable = count($rat->bred_litters) == 0;

        if ($this->request->is(['patch', 'post', 'put'])) {

            // if rat has no bred litters, it can be deleted
            if ($deletable) {
                if ($this->Rats->delete($rat)) {
                    $this->Flash->success(__('The rat sheet has been deleted. You can inform its creator by mail from their sheet below.'));
                    return $this->redirect(['controller' => 'Users', 'action' => 'view', $rat->creator_user_id]);
                } else {
                    $this->Flash->error(__('The rat sheet could not be deleted. It still wanted to live.'));
                    return $this->redirect(['action' => 'delete', $rat->id]);
                }
            }
        }

        if ($deletable) {
            $this->Flash->default(__('This rat has no offspring and can be deleted. Related messages and snapshots will be deleted. This operation is irreversible!'));

        } else {
            $this->Flash->error(__('This rat has offspring. You must edit or delete their bred litters before being allowed to delete the sheet.'));
        }

        $snap_diffs = [];
        foreach ($rat->rat_snapshots as $snapshot) {
            $snap_diffs[$snapshot->id] = $this->Rats->snapDiffListAsString($rat, $snapshot->id);
        }

        $identity = $this->request->getAttribute('identity');
        $show_staff = ! is_null($identity) && $identity->can('edit', $rat);

        $this->set(compact('rat', 'identity', 'deletable', 'snap_diffs'));
    }

    /** Search functions **/

    /**
     * Search method
     *
     * Search rats by multiple criteria, from a form entry.
     *
     * @param
     * @return
     */

     public function search()
     {
         $this->Authorization->skipAuthorization();
         $rat = $this->Rats->newEmptyEntity();

         $options = $this->request->getQueryParams();

         if (empty($options)) {
            $new_search = true;
         } else {
            $new_search = false;
            $rats = $this->Rats
             ->find('multisearch', [
                 'options' => $options,
                 'searchable_only' => $this->searchable_only
             ])
             ->contain([
                 'OwnerUsers',
                 'Ratteries',
                 'BirthLitters',
                 'BirthLitters.Contributions',
                 'BirthLitters.Ratteries',
                 'States'
             ]);

            $settings = [
                'sortableFields' => [
                    'state_id',
                    'pedigree_identifier',
                    'Ratteries.prefix',
                    'name',
                    'pup_name',
                    'birth_date',
                    'OwnerUsers.username',
                    'sex'
                ]
            ];

            $rats = $this->paginate($rats, $settings);
            $this->set(compact('rats','options'));
         }
         $this->set(compact('new_search'));

         $colors = $this->Rats->Colors->find('list', ['limit' => 200]);
         $eyecolors = $this->Rats->Eyecolors->find('list', ['limit' => 200]);
         $dilutions = $this->Rats->Dilutions->find('list', ['limit' => 200]);
         $markings = $this->Rats->Markings->find('list', ['limit' => 200]);
         $earsets = $this->Rats->Earsets->find('list', ['limit' => 200]);
         $coats = $this->Rats->Coats->find('list', ['limit' => 200]);
         $states = $this->Rats->States->find('list', ['limit' => 200]);
         $singularities = $this->Rats->Singularities->find('list', ['limit' => 200]);

         $placeholders = json_encode([
             'colors' => __('Type here to filter colors...'),
             'eyecolors' => __('Type here to filter eyecolors...'),
             'coats' => __('Type here to filter coats...'),
             'dilutions' => __('Type here to filter dilutions...'),
             'earsets' => __('Type here to filter earsets...'),
             'markings' => __('Type here to filter markings...'),
             'singularities' => __('Type here to filter singularities...'),
         ]);

         $this->set(compact('rat', 'colors', 'eyecolors', 'dilutions', 'markings', 'earsets', 'coats', 'states', 'singularities', 'placeholders'));
     }

    public function results() {
        $this->Authorization->skipAuthorization();
        $url['action'] = 'search';
        $options = $this->request->getData();
        $query_string = [];
		foreach ($options as $key => $value){
			if ( $value != '' ) {
                $query_string[$key] = $value;
            }
		}
        $url['?'] = $query_string;
		$this->redirect($url);
    }

    /**
     * Restore method
     *
     * Restores a Rat from a previous snapshot.
     *
     * @param string|null $id Rat id.
     * @param string|null $snapshot_id RatSnapshot id.
     * @return \Cake\Http\Response|null Redirects to view.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function restore($id = null, $snapshot_id = null)
    {
        $rat = $this->Rats->get($id, ['contain' => ['Ratteries', 'States']]);
        $this->Authorization->authorize($rat);
        $this->Rats->removeBehavior('State');
        if ($this->Rats->snapRestore($rat, $snapshot_id)) {
            $this->Flash->success(__('The snapshot has been restored.'));
        } else {
            $this->Flash->error(__('The snapshot could not be loaded. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', $rat->id]);
    }

    /**
     * Names method
     *
     * Search rats by name.
     *
     * @param
     * @return
     */
    public function named()
    {
        $this->Authorization->skipAuthorization();

        if($this->request->is(['post']))
        {
            $names = [$this->request->getData('name')];
        } else
            {
                // The 'pass' key is provided by CakePHP and contains all
                // the passed URL path segments in the request.
                $names = $this->request->getParam('pass');
        }

        //
        // Use the RatsTable to find named rats.
        $rats = $this->Rats
            ->find('named', [
                'names' => $names,
                'searchable_only' => $this->searchable_only,
            ])
            ->contain([
                'OwnerUsers',
                'Ratteries',
                'States',
                'BirthLitters',
                'BirthLitters.Contributions',
                'BirthLitters.Ratteries'
            ]);

        // Pass variables into the view template context.
        $settings = [
            'order' => [
                'birth_date' => 'desc',
            ],
            'sortableFields' => [
                'state_id',
                'pedigree_identifier',
                'Ratteries.prefix',
                'name',
                'pup_name',
                'birth_date',
                'OwnerUsers.username',
                'sex'
            ]
        ];

        $rats = $this->paginate($rats, $settings);

        $this->set(compact('rats', 'names'));
    }

    /**
     * fromRattery method
     *
     * Search rats by ratteries.
     *
     * @param
     * @return
     */
    public function fromRattery()
    {
        $this->Authorization->skipAuthorization();
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $ratteries = $this->request->getParam('pass');

        $rats = $this->Rats
            ->find('fromRattery', [
                'ratteries' => $ratteries,
                'searchable_only' => $this->searchable_only
            ])
            ->contain([
                'OwnerUsers',
                'Ratteries',
                'BirthLitters',
                'BirthLitters.Contributions',
                'States'
            ]);

        $rats = $this->paginate($rats);

        $this->set(compact('rats', 'ratteries'));
    }

    /**
     * fromRattery method
     *
     * Search rats by ratteries.
     *
     * @param
     * @return
     */
    public function byRattery()
    {
        $this->Authorization->skipAuthorization();
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $ratteries = $this->request->getParam('pass');
        $rattery = $this->Rats->Ratteries->get($ratteries);
        $rats = $this->Rats
            ->find('byRatteryId', [
                'ratteries' => $ratteries,
                'searchable_only' => $this->searchable_only
            ])
            ->contain([
                'OwnerUsers',
                'Ratteries',
                'BirthLitters',
                'BirthLitters.Contributions',
                'DeathPrimaryCauses',
                'DeathSecondaryCauses',
                'States'
            ]);

        $settings = [
            'order' => [
                'birth_date' => 'desc',
            ],
            'sortableFields' => [
                'state_id',
                'pedigree_identifier',
                'Ratteries.prefix',
                'name',
                'pup_name',
                'birth_date',
                'sex'
            ],
        ];
        $rats = $this->paginate($rats, $settings);

        $this->set(compact('rats', 'rattery'));
    }

    /**
     * ownedBy method
     *
     * Search rats by owner user name like.
     *
     * @param
     * @return
     */
    public function ownedBy()
    {
        $this->Authorization->skipAuthorization();
        $owners = $this->request->getParam('pass');

        $rats = $this->Rats
            ->find('ownedBy', [
                'owners' => $owners,
                'searchable_only' => $this->searchable_only
            ])
            ->contain([
                'OwnerUsers',
                'Ratteries',
                'BirthLitters',
                'BirthLitters.Contributions',
                'States'
            ],
        );

        $rats = $this->paginate($rats);
        $this->set(compact('rats', 'owners'));
    }

    /**
     * byOwner method
     *
     * Search rats by owner user id.
     *
     * @param
     * @return
     */
    public function byOwner()
    {
        $this->Authorization->skipAuthorization();
        $owners = $this->request->getParam('pass');
        $owner = $this->Rats->OwnerUsers->get($owners);
        $rats = $this->Rats
            ->find('byOwnerId', ['owners' => $owners, 'searchable_only' => $this->searchable_only])
            ->contain([
                'OwnerUsers',
                'Ratteries',
                'BirthLitters',
                'BirthLitters.Contributions',
                'DeathPrimaryCauses',
                'DeathSecondaryCauses',
                'States'
            ]);

        $settings = [
            'order' => [
                'birth_date' => 'desc',
            ],
            'sortableFields' => [
                'state_id',
                'pedigree_identifier',
                'Ratteries.prefix',
                'name',
                'pup_name',
                'birth_date',
                'sex'
            ],
        ];

        $rats = $this->paginate($rats, $settings);
        $this->set(compact('rats', 'owner'));
    }

    /**
     * bornBefore method
     *
     * Search rats by birthdate.
     *
     * @param
     * @return
     */
    public function bornBefore()
    {
        $this->Authorization->skipAuthorization();
        $bornBefore = $this->request->getParam('pass');
        $rats = $this->Rats
            ->find('bornBefore', [
                'bornBefore' => $bornBefore,
                'searchable_only' => $this->searchable_only
            ])
            ->contain([
                'OwnerUsers',
                'Ratteries',
                'BirthLitters',
                'BirthLitters.Contributions',
                'DeathPrimaryCauses',
                'DeathSecondaryCauses',
                'States'
            ]);

        // Pass variables into the view template context.
        $rats = $this->paginate($rats);

        $this->set([
            'rats' => $rats,
            'bornBefore' => $bornBefore
        ]);
    }

    public function bornAfter()
    {
        $this->Authorization->skipAuthorization();
        $bornAfter = $this->request->getParam('pass');

        $rats = $this->Rats
            ->find('bornAfter', [
                'bornAfter' => $bornAfter,
                'searchable_only' => $this->searchable_only
            ])
            ->contain([
                'OwnerUsers',
                'Ratteries',
                'BirthLitters',
                'BirthLitters.Contributions',
                'DeathPrimaryCauses',
                'DeathSecondaryCauses',
                'States'
            ]);

        $rats = $this->paginate($rats);

        $this->set([
            'rats' => $rats,
            'bornAfter' => $bornAfter
        ]);
    }

    public function inState()
    {
        $this->Authorization->authorize($this->Rats, 'filterByState');

        $inState = $this->request->getParam('pass');
        $rats = $this->Rats
            ->find('inState', ['inState' => $inState])
            ->contain(
                [
                    'OwnerUsers',
                    'Ratteries',
                    'BirthLitters',
                    'BirthLitters.Contributions',
                    'DeathPrimaryCauses',
                    'DeathSecondaryCauses',
                    'States'
                ]);

        $settings = [
            'sortableFields' => [
                'pedigree_identifier',
                'name',
                'birth_date',
                'OwnerUsers.username',
                'sex'
            ]
        ];
        $rats = $this->paginate($rats, $settings);

        $this->set([
            'rats' => $rats,
            'inState' => $inState,
            'user' => $this->request->getAttribute('identity'),
        ]);
    }

    public function needsStaff()
    {
        $this->Authorization->authorize($this->Rats, 'filterByState');

        $rats = $this->Rats
            ->find('needsStaff')
            ->contain([
                'OwnerUsers',
                'Ratteries',
                'BirthLitters',
                'BirthLitters.Contributions',
                'RatSnapshots' => ['sort' => ['RatSnapshots.created' => 'DESC']],
                'RatMessages'=> ['sort' => ['RatMessages.created' => 'DESC']],
                'States'
            ]);

        $settings = [
            'order' => [
                'modified' => 'desc',
            ],
            'sortableFields' => [
                'state_id',
                'pedigree_identifier',
                'OwnerUsers.username',
                'modified',
            ]
        ];
        $rats = $this->paginate($rats, $settings);

        $user = $this->request->getAttribute('identity');
        $this->set(compact('rats', 'user'));
    }

    /* Autocomplete for forms function */

    public function autocomplete() {
        $this->Authorization->skipAuthorization();
        if ($this->request->is(['ajax'])) {
            $searchkey = $this->request->getQuery('searchkey');
            $sex = $this->request->getQuery('sex');

            if (! is_null($sex)) {
                $items = $this->Rats->find('incipit', ['names' => [$searchkey], 'searchable_only' => $this->searchable_only])
                    ->where(['sex IS' => $sex])
                    ->select(['id' => 'Rats.id', 'Rats__state_id' => 'Rats.state_id',
                        'label' => "concat(Rats.name, ' (', Rats.pedigree_identifier, ')')"
                    ]);
            } else {
                $items = $this->Rats->find('identified', ['names' => [$searchkey], 'searchable_only' => $this->searchable_only])
                    ->select(['id' => 'Rats.id', 'Rats__state_id' => 'Rats.state_id',
                        'label' => "concat(Rats.name, ' (', Rats.pedigree_identifier, ')')"
                    ]);
            }
            $this->set('items', $items);
            $this->viewBuilder()->setOption('serialize', ['items']);
        }
    }

    /* Pedigree functions */

    public function parentsTree($id = null) {
        $this->Authorization->skipAuthorization();

        if ($this->request->is(['ajax'])) {
            $id = $this->request->getQuery('id');
        }

        $rat = $this->Rats->get($id, [
            'contain' => ['Ratteries', 'BirthLitters', 'BirthLitters.Ratteries', 'BirthLitters.Contributions',
            'BirthLitters.Sire', 'BirthLitters.Sire.BirthLitters', 'BirthLitters.Sire.BirthLitters.Contributions',
            'BirthLitters.Dam', 'BirthLitters.Dam.BirthLitters', 'BirthLitters.Dam.BirthLitters.Contributions',
            'BirthLitters.Dam.DeathPrimaryCauses','BirthLitters.Dam.DeathSecondaryCauses',
            'BirthLitters.Sire.Colors', 'BirthLitters.Sire.Dilutions', 'BirthLitters.Sire.Markings', 'BirthLitters.Sire.Earsets', 'BirthLitters.Sire.Coats', 'BirthLitters.Sire.DeathPrimaryCauses', 'BirthLitters.Sire.DeathSecondaryCauses',
            'BirthLitters.Dam.Colors', 'BirthLitters.Dam.Dilutions', 'BirthLitters.Dam.Markings', 'BirthLitters.Dam.Earsets', 'BirthLitters.Dam.Coats', 'BirthLitters.Dam.DeathPrimaryCauses', 'BirthLitters.Dam.DeathSecondaryCauses',
            'States'],
        ]);

        $parents = $rat->parents_array;
        $this->set('_parents', $parents);

        if ($this->request->is(['ajax'])) {
            $this->viewBuilder()->setOption('serialize', ['_parents']);
        } else {
            return $parents;
        }
    }

    public function childrenTree() {
        $this->Authorization->skipAuthorization();

        if ($this->request->is(['ajax'])) {
            $id = $this->request->getQuery('id');

            $rat = $this->Rats->get($id, [
                'contain' => ['BredLitters',
                'BredLitters.OffspringRats','BredLitters.OffspringRats.Ratteries',
                'BredLitters.OffspringRats.Coats','BredLitters.OffspringRats.Colors','BredLitters.OffspringRats.Dilutions','BredLitters.OffspringRats.Markings','BredLitters.OffspringRats.Earsets',
                'BredLitters.OffspringRats.DeathPrimaryCauses','BredLitters.OffspringRats.DeathSecondaryCauses',
                'BredLitters.OffspringRats.BirthLitters','BredLitters.OffspringRats.BirthLitters.Contributions'],
            ]);

            $children = $rat->children_array;

            $this->set('_children', $children);
            $this->viewBuilder()->setOption('serialize', ['_children']);
        }
    }

    public function pedigree($id = null)
    {
        $this->Authorization->skipAuthorization();
        $rat = $this->Rats->get($id, [
            'contain' => ['Colors', 'Eyecolors', 'Dilutions', 'Markings', 'Earsets', 'Coats', 'Singularities', 'DeathPrimaryCauses', 'DeathSecondaryCauses', 'States', 'Ratteries',
            'BirthLitters', 'BirthLitters.Ratteries', 'BirthLitters.Contributions',
            'BirthLitters.Sire', 'BirthLitters.Sire.BirthLitters', 'BirthLitters.Sire.BirthLitters.Contributions',
            'BirthLitters.Dam', 'BirthLitters.Dam.BirthLitters', 'BirthLitters.Dam.BirthLitters.Contributions',
            'BirthLitters.Dam.DeathPrimaryCauses','BirthLitters.Dam.DeathSecondaryCauses',
            'BirthLitters.Sire.Colors', 'BirthLitters.Sire.Dilutions', 'BirthLitters.Sire.Markings', 'BirthLitters.Sire.Earsets', 'BirthLitters.Sire.Coats', 'BirthLitters.Sire.DeathPrimaryCauses', 'BirthLitters.Sire.DeathSecondaryCauses',
            'BirthLitters.Dam.Colors', 'BirthLitters.Dam.Dilutions', 'BirthLitters.Dam.Markings', 'BirthLitters.Dam.Earsets', 'BirthLitters.Dam.Coats', 'BirthLitters.Dam.DeathPrimaryCauses', 'BirthLitters.Dam.DeathSecondaryCauses',
            'BredLitters',
            'BredLitters.OffspringRats','BredLitters.OffspringRats.Ratteries',
            'BredLitters.OffspringRats.Coats','BredLitters.OffspringRats.Colors','BredLitters.OffspringRats.Dilutions','BredLitters.OffspringRats.Markings','BredLitters.OffspringRats.Earsets',
            'BredLitters.OffspringRats.DeathPrimaryCauses','BredLitters.OffspringRats.DeathSecondaryCauses',
            'BredLitters.OffspringRats.BirthLitters','BredLitters.OffspringRats.BirthLitters.Contributions',
            'CreatorUsers'],
        ]);

        $family = [
            //'id' => $rat->pedigree_identifier,
            'id' => $rat->id,
            'true_id' => $id,
            'name' => $rat->usual_name,
            'link' => Router::Url(['controller' => 'Rats', 'action' => 'view', $rat->id]),
            'sex' => 'X', // we want a different color for the root of the tree
            'description' => $rat->variety,
            'death' => $rat->short_death_cause . ' (' . $rat->short_age_string . ')',
            '_parents' => $rat->parents_array,
            '_children' => $rat->children_array,
        ];

        $json = json_encode($family);
        $user = $this->request->getAttribute('identity');
        $this->set(compact('rat', 'json', 'user'));
    }

    public function family($id = null) {
        $this->Authorization->skipAuthorization();
        $rat = $this->Rats->get($id, [
            'contain' => [
                'States',
                'Ratteries',
                'BirthLitters',
                'BirthLitters.Ratteries',
                'BirthLitters.Contributions',
                'BredLitters'
            ]
        ]);

        $this->Rats->States->removeBehavior('Translate');
        $stats = $rat->wrapFamilyStatistics();

        $this->set(compact('rat', 'stats'));
    }

    public function legacy($id = null) {
        $this->Authorization->skipAuthorization();

        $rat = $this->Rats->get($id, [
            'contain' => [
                'States',
                'Ratteries',
                'BirthLitters',
                'BirthLitters.Ratteries',
                'BirthLitters.Contributions'
            ]
        ]);

        $descendance = [];
        $rat->computeDescendance($rat->id, $descendance);

        $query = $this->Rats->find()
            ->where(['Rats.id in' => $descendance, 'Rats.is_alive' => true])
            ->contain(['OwnerUsers', 'Ratteries', 'BirthLitters', 'BirthLitters.Contributions', 'States'])
            ->order(['Rats.birth_date' => 'DESC']);

        $this->set('rats', $this->paginate($query));
        $this->set(compact('rat'));

    }

    public function print($id = null)
    {
        $this->Authorization->skipAuthorization();
        $rat = $this->Rats->get($id, [
            'contain' => ['Colors', 'Eyecolors', 'Dilutions', 'Markings', 'Earsets', 'Coats', 'Singularities',
            'DeathPrimaryCauses', 'DeathSecondaryCauses', 'Ratteries', 'OwnerUsers',
            'BirthLitters', 'BirthLitters.Ratteries', 'BirthLitters.Contributions',
            'BirthLitters.Sire', 'BirthLitters.Sire.BirthLitters', 'BirthLitters.Sire.BirthLitters.Contributions',
            'BirthLitters.Dam', 'BirthLitters.Dam.BirthLitters', 'BirthLitters.Dam.BirthLitters.Contributions',
            'BirthLitters.Dam.DeathPrimaryCauses','BirthLitters.Dam.DeathSecondaryCauses',
            'BirthLitters.Sire.Colors', 'BirthLitters.Sire.Dilutions', 'BirthLitters.Sire.Markings', 'BirthLitters.Sire.Earsets', 'BirthLitters.Sire.Coats', 'BirthLitters.Sire.DeathPrimaryCauses', 'BirthLitters.Sire.DeathSecondaryCauses',
            'BirthLitters.Dam.Colors', 'BirthLitters.Dam.Dilutions', 'BirthLitters.Dam.Markings', 'BirthLitters.Dam.Earsets', 'BirthLitters.Dam.Coats', 'BirthLitters.Dam.DeathPrimaryCauses', 'BirthLitters.Dam.DeathSecondaryCauses',
            'BredLitters.OffspringRats.Coats','BredLitters.OffspringRats.Colors','BredLitters.OffspringRats.Dilutions','BredLitters.OffspringRats.Markings','BredLitters.OffspringRats.Earsets',
            'BredLitters.OffspringRats.DeathPrimaryCauses','BredLitters.OffspringRats.DeathSecondaryCauses',
            'BredLitters.OffspringRats.BirthLitters','BredLitters.OffspringRats.BirthLitters.Contributions',
            ],
        ]);

        $depth = 4;
        $tree = $rat->buildFamilyTree($id, $depth);
        $tree['sex'] = 'X';

        $json = json_encode($tree);
        $this->set(compact('rat', 'json', 'depth'));
        $this->viewBuilder()->setLayout('pdf');
    }

    /**
     * ChangePicture method
     *
     * @param string|null $id Rat id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changePicture($id = null)
    {
        $rat = $this->Rats->get($id, [
            'contain' => ['States', 'Ratteries', 'BirthLitters', 'BirthLitters.Contributions'],
        ]);
        $this->Authorization->authorize($rat, 'microEdit');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $rat = $this->Rats->patchEntity($rat, $this->request->getData());

            if ($this->request->getData('action') === 'delete') {
                $rat->picture = '';
                $rat->picture_thumbnail = '';
                if ($this->Rats->save($rat, ['checkRules' => false])) {
                    $this->Flash->success(__('The rat’s picture has been deleted.'));
                    return $this->redirect(['action' => 'view', $rat->id]);
                }
                $this->Flash->error(__('The rat’s picture could not be deleted. Please, try again.'));
            }

            if ($this->request->getData('action') === 'upload') {
                if ($this->Rats->save($rat, ['checkRules' => false])) {
                    $this->Flash->warning(__('The rat’s new picture has been saved. A staff member still has to validate it.'));
                    return $this->redirect(['action' => 'view', $rat->id]);
                }
                $this->Flash->error(__('The rat’s new picture could not be saved. Please, try again.'));
            }
        } else {
            $this->Flash->default(__('Pictures must be in jpeg, gif or png format and less than 8 MB.') . ' ' . __x('pictures', 'Large images will be automatically resized.'));
        }
        $user = $this->request->getAttribute('identity');
        $this->set(compact('rat', 'user'));
    }

    /**
     * ChangeOwner method
     *
     * @param string|null $id Rat id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function transferOwnership($id = null)
    {
        $rat = $this->Rats->get($id, [
            'contain' => ['CreatorUsers', 'OwnerUsers', 'States', 'Ratteries',
            'BirthLitters', 'BirthLitters.Contributions', 'BirthLitters.Contributions.Ratteries',],
        ]);
        $this->Authorization->authorize($rat, 'microEdit');

        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->request->getData('owner_user_id')) {
                $rat->set('owner_user_id', $this->request->getData('owner_user_id'));
                $rat->set('comments', $this->request->getData('comments'));
            }
            if ($this->Rats->save($rat, ['checkRules' => false])) {
                $this->Flash->success(__('The rat has been transferred to its new owner.'));
                return $this->redirect(['action' => 'view', $rat->id]);
            }
            $this->Flash->error(__('The rat ownership could not be changed. Please, try again.'));
        }
        $this->set(compact('rat'));
    }

    /**
     * DeclareDeath method
     *
     * @param string|null $id Rat id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function declareDeath($id = null)
    // this change is authorized to owner and staff, and brings rat to next_ok_state
    {
        $rat = $this->Rats->get($id, [
            'contain' => [
                'CreatorUsers',
                'OwnerUsers',
                'States',
                'Ratteries',
                'BirthLitters',
                'BirthLitters.Contributions',
                'BirthLitters.Contributions.Ratteries',
                'DeathPrimaryCauses',
                'DeathSecondaryCauses',
            ],
        ]);
        $this->Authorization->authorize($rat, 'microEdit');

        $death_primary_causes_model = $this->fetchModel('DeathPrimaryCauses');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $rat->is_alive = false;
            $rat = $this->Rats->patchEntity($rat, $this->request->getData());
            // refresh rat association with death primary causes for rules on is_oldster/is_infant
            $rat->death_primary_cause = $death_primary_causes_model->get($rat->death_primary_cause_id);
            if ($this->Rats->save($rat)) {
                $this->Flash->success(__('Sorry for your loss. Your rat’s death has been recorded.'));
                return $this->redirect(['action' => 'view', $rat->id]);
            }
            $this->Flash->error(__('Your rat’s death could not be recorded. Please, try again.'));
        } else {
            $this->Flash->default(__('We are sorry for your loss. Please fill the information below to record the rat death. Date and primary cause are mandatory.'));
        }

        // keeps "Unknown" as first cause and "Other" as last, sort the rest alphabetically
        // collation explicitly added to manage French character "Œ"
        $translate = (I18n::getLocale() == I18n::getDefaultLocale()) ? '' : 'Translation';
        $lastId = $this->Rats->DeathPrimaryCauses->find()->count();
        $deathPrimaryCauses = $this->Rats->DeathPrimaryCauses->find('list')
            ->order([
                'CASE WHEN DeathPrimaryCauses__id = 1 THEN 0 WHEN DeathPrimaryCauses__id = ' . $lastId . ' THEN 2 ELSE 1 END', // first sort by id=1
                'DeathPrimaryCauses'.$translate.'__name COLLATE utf8mb4_unicode_ci ASC' // then sort by name
            ]);

        if (! $rat->is_alive && ! is_null($rat->death_primary_cause_id)) {
            $death_secondary_causes_model = $this->fetchModel('DeathSecondaryCauses');
            $deathSecondaryCauses = $death_secondary_causes_model
                ->find('all')
                ->select(['id', 'name'])
                ->where(['death_primary_cause_id IS' => $rat->death_primary_cause_id])
                ->order(['id' => 'ASC'])
                ->all()->combine('id', 'name')->toArray();
            $this->set(compact('deathSecondaryCauses'));
        }

        $js_messages = json_encode([
            __('Please, read carefully information that will appear below to check the fitness of your choice.'),
            __('Please answer the following questions about euthanasia, diagnostics and analyses.'),
        ]);
        $user = $this->request->getAttribute('identity');
        $this->set(compact('rat', 'deathPrimaryCauses', 'js_messages', 'user'));
    }

    /**
     * EditComment method
     *
     * @param string|null $id Rat id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editComment($id = null)
    {
        $rat = $this->Rats->get($id, [
            'contain' => [
                'CreatorUsers',
                'OwnerUsers',
                'States',
                'Ratteries',
                'BirthLitters',
                'BirthLitters.Contributions',
                'BirthLitters.Contributions.Ratteries',
                'DeathPrimaryCauses',
                'DeathSecondaryCauses',
            ],
        ]);

        $this->Authorization->authorize($rat, 'microEdit');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rat = $this->Rats->patchEntity($rat, $this->request->getData());

            if ($rat->state->needs_user_action) {
                // remove comments from safe properties to trigger state change
                $this->Rats->removeBehavior('State');
                $this->Rats->addBehavior('State', [
                    'safe_properties' => [
                        'name',
                        'pup_name',
                        'owner_user_id',
                    ],
                ]);
            }

            if ($this->Rats->save($rat)) {
                $this->Flash->success(__('Your new comment about the rat has been saved.'));
                return $this->redirect(['action' => 'view', $rat->id]);
            }
            $this->Flash->error(__('Your new comment about the rat could not be saved. Please, try again.'));
        }

        $user = $this->request->getAttribute('identity');
        $show_staff = ! is_null($user) && $user->can('staffEdit', $rat);

        $this->set(compact('rat', 'user', 'show_staff'));
    }

    /* State changes */

    public function moderate($id)
    {
        $rat = $this->Rats->get($id, [
            'contain' => [
                'States',
            ],
        ]);
        $rat = $this->Rats->patchEntity($rat, $this->request->getData());
        if ($this->Rats->save($rat, ['checkRules' => false])) {
            // state_id is up to date but not $rat->state entity, reload for updated flash message
            $this->Flash->success(__('This rat sheet is now in state: {0}.', [$this->fetchModel('States')->get($rat->state_id)->name]));
            if (! empty($this->request->getData('side_message'))) {
                $this->Flash->default(__('The following custom moderation message has been sent: {0}', [$this->request->getData('side_message')]));
            }
        } else {
            $this->Flash->error(__('We could not moderate the sheet. Please retry or contact an administrator.'));
        };
        return $this->redirect(['action' => 'view', $rat->id]);
    }

    public function dispute($id) {
        $rat = $this->Rats->get($id, [
            'contain' => [
                'States',
                'BirthLitters',
                'BirthLitters.Contributions',
                'BirthLitters.Contributions.Ratteries',
                'Ratteries',
                'RatMessages' => ['sort' => 'RatMessages.created DESC'],
                'RatMessages.Users'
            ],
        ]);

        $this->Authorization->authorize($rat);

        if ($this->request->is('post')) {
            // send back to staff and emit message
            $rat = $this->Rats->patchEntity($rat, $this->request->getData());

            if ($this->Rats->save($rat, ['checkRules' => false])) {
                $this->Flash->success(__('The sheet has been sent back to staff with your message.'));
                return $this->redirect(['action' => 'view', $rat->id]);
            } else {
                $this->Flash->success(__('Something went wrong. Please, try again or contact an administrator.'));
                return $this->redirect(['action' => 'view', $rat->id]);
            }
        }

        $identity = $this->request->getAttribute('identity');
        $this->set(compact('rat', 'identity'));
    }

    public function freeze($id)
    {
        $this->request->allowMethod(['get', 'post']);
        $rat = $this->Rats->get($id, ['contain' => ['States']]);
        $this->Authorization->authorize($rat, 'changeState');

        if ($this->Rats->freeze($rat) && $this->Rats->save($rat, ['checkRules' => false])) {
            $this->Flash->success(__('This rat sheet is now frozen.'));
        } else {
            $this->Flash->error(__('We could not freeze the sheet. Please retry or contact an administrator.'));
        }
        return $this->redirect(['action' => 'view', $rat->id]);
    }

    public function thaw($id)
    {
        $this->request->allowMethod(['get', 'post']);
        $rat = $this->Rats->get($id, ['contain' => ['States']]);
        $this->Authorization->authorize($rat, 'editFrozen');

        if ($this->Rats->thaw($rat) && $this->Rats->save($rat, ['checkRules' => false])) {
            $this->Flash->success(__('This rat sheet is now unfrozen.'));
        } else {
            $this->Flash->error(__('We could not thaw the sheet. Please retry or contact an administrator.'));
        }
        return $this->redirect(['action' => 'view', $rat->id]);
    }

    public function approve($id)
    {
        $this->request->allowMethod(['get', 'post']);
        $rat = $this->Rats->get($id, ['contain' => ['States']]);
        $this->Authorization->authorize($rat, 'changeState');

        if ($this->Rats->approve($rat) && $this->Rats->save($rat, ['checkRules' => false])) {
            $this->Flash->success(__('This rat sheet has been approved.'));
        } else {
            $this->Flash->error(__('We could not approve the sheet. Please retry or contact an administrator.'));
        }
        return $this->redirect(['action' => 'view', $rat->id]);
    }

    public function blame($id)
    {
        $this->request->allowMethod(['get', 'post']);
        $rat = $this->Rats->get($id, ['contain' => ['States']]);
        $this->Authorization->authorize($rat, 'changeState');

        if ($this->Rats->blame($rat) && $this->Rats->save($rat, ['checkRules' => false])) {
            $this->Flash->success(__('This rat sheet has been unapproved.'));
        } else {
            $this->Flash->error(__('We could not unapprove the sheet. Please retry or contact an administrator.'));
        }
        return $this->redirect(['action' => 'view', $rat->id]);
    }

    public function blameNeglected() {
        return $this->Rats->blameNeglected($this->Rats);
    }

    // utils
    public function sortTailByName($collection)
    {
        $head = $collection->filter(function ($item) {
            return $item['id'] == 1;
        });

        $tail = $collection->reject(function ($item) {
            return $item['id'] == 1;
        });

        $sortedTail = $tail->sortBy('name', SORT_ASC, SORT_STRING);
        $sortedCollection = (new Collection([$head]))->append($sortedTail->toList());
        //$sortedCollection = (new Collection($sortedTail))->prepend($head->toList());
        //$sortedCollection = new Collection($sortedTail->prepend($head));
        //$sortedCollection = (new Collection($sortedTail->toList()))->prepend($head->toList());
        dd($sortedCollection->toArray());
        return $sortedCollection;
        //$sortedList = (new Collection($sortedCollection))->combine('id', 'name');
        //return $sortedList;
    }
}
