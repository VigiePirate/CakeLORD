<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Chronos\Chronos;
use Cake\I18n\I18n;
use Cake\I18n\FrozenTime;
use Cake\Mailer\Mailer;
use Cake\Mailer\MailerAwareTrait;
use App\Model\Entity\Lord;
use App\Model\Table\RatsTable;

class LordController extends AppController
{
    use MailerAwareTrait;

    public function initialize(): void
    {
        parent::initialize();
        /* $this->loadComponent('Security'); */
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions([
            'parse',
            'search',
            'webstats',
            'contact',
            'acknowledge',
            'switchLanguage',
        ]);
        /* $this->Security->setConfig('unlockedActions', ['transferOwnership, declareDeath']); */
    }

    public function my() {
        $lord = new Lord();

        $model = $this->fetchModel('Rats');
        $query = $model->find('needsStaff')
            ->order('Rats.modified DESC')
            ->contain([
                'States',
                'OwnerUsers',
                'Ratteries',
                'BirthLitters',
                'BirthLitters.Contributions',
                'RatSnapshots' => ['sort' => ['RatSnapshots.created' => 'DESC']],
                'RatMessages'=> ['sort' => ['RatMessages.created' => 'DESC']],
            ]);
        $count['rats'] = $query->count();
        $rats = $query->limit(5);

        $model = $this->fetchModel('Ratteries');
        $query = $model->find('needsStaff')
            ->order('Ratteries.modified DESC')
            ->contain([
                'Countries',
                'States',
                'Users',
                'RatterySnapshots' => ['sort' => ['RatterySnapshots.created' => 'DESC']],
                'RatteryMessages'=> ['sort' => ['RatteryMessages.created' => 'DESC']],
            ]);
        $count['ratteries'] = $query->count();
        $ratteries = $query->limit(5);

        $model = $this->fetchModel('Litters');
        $query = $model->find('needsStaff')
            ->order('Litters.modified DESC')
            ->contain([
                'States',
                'Contributions',
                'Contributions.Ratteries',
                'Sire',
                'Dam',
                'Users',
                'LitterSnapshots' => ['sort' => ['LitterSnapshots.created' => 'DESC']],
                'LitterMessages'=> ['sort' => ['LitterMessages.created' => 'DESC']],
            ]);
        $count['litters'] = $query->count();
        $litters = $query->limit(5);

        $model = $this->fetchModel('Issues');
        $query = $model->findByIsOpen(true)
            ->order('Issues.created DESC')
            ->contain(['FromUsers', 'ClosingUsers']);
        $count['issues'] = $query->count();
        $issues = $query->limit(5);

        $sheet_options = [
            'Rats' => __('Rats'),
            'Ratteries' => __('Ratteries'),
            'Litters' => __('Litters')
        ];

        $states = $this->fetchModel('States');
        $state_options = $states->find()->all()->combine('id', 'name');

        $user = $this->request->getAttribute('identity');
        $this->Authorization->authorize($lord);

        $this->set(compact(
            'user',
            'count',
            'rats',
            'litters',
            'ratteries',
            'issues',
            'sheet_options',
            'state_options'
        ));
    }

    public function parse() {
        $this->Authorization->skipAuthorization();

        if($this->request->is(['post'])) {
            $key = $this->request->getData('key');
            $this->redirect(['action' => 'search', $key]);
        }
    }

    public function search() {
        $this->Authorization->skipAuthorization();

        $names = $this->request->getParam('pass');

        $model = $this->fetchModel('Rats');
        $query = $model->find('identified', ['names' => $names])
            ->order('Rats.modified DESC')
            ->contain(['States', 'OwnerUsers', 'Ratteries', 'BirthLitters', 'BirthLitters.Contributions']);
        $count['rats'] = $query->count();
        $rats = $query->limit(10);

        $model = $this->fetchModel('Ratteries');
        $query = $model->find('named', ['names' => $names])
            ->order('Ratteries.modified DESC')
            ->contain(['Countries', 'States', 'Users']);
        $count['ratteries'] = $query->count();
        $ratteries = $query->limit(10);

        $model = $this->fetchModel('Users');
        $query = $model->find('named', ['names' => $names])
            ->order('Users.modified DESC')
            ->contain(['Roles', 'Ratteries']);
        $count['users'] = $query->count();
        $users = $query->limit(10);

        $this->set(compact('names', 'count', 'rats', 'ratteries', 'users'));
    }

    public function inState()
    {
        $this->Authorization->skipAuthorization();

        if($this->request->is(['post'])) {
            $controller = $this->request->getData('controller');
            $state_id = $this->request->getData('state_id');
            $this->redirect(['controller' => $controller, 'action' => 'inState', $state_id]);
        }
    }

    public function stats()
    {
        $lord = new Lord();
        $this->Authorization->skipAuthorization();
        $rats = $this->fetchModel('Rats');

        $rat_count = $lord->countAll('Rats');
        $female_count = $lord->countRats(['sex' => 'F']);
        $male_count = $lord->countRats(['sex' => 'M']);
        $female_frequency = round(100 * $female_count / $rat_count,2);
        $male_frequency = round(100 * $male_count / $rat_count,2);

        $dead_rat_count = $lord->countRats(['OR' => ['is_alive IS' => false, 'DATEDIFF(NOW(), birth_date) >' => RatsTable::MAXIMAL_AGE]]);
        $dead_rat_frequency = round(100*$dead_rat_count/$rat_count,1);
        $knowingly_dead_rat_count = $lord->countRats([
            'is_alive IS' => false,
            'OR' => [
                'death_secondary_cause_id !=' => '1',
                'AND' => [
                    'death_primary_cause_id !=' => '1',
                    'death_secondary_cause_id IS' => null
                ]
            ]
        ]);
        $knowingly_dead_rat_frequency = round(100*$knowingly_dead_rat_count/$dead_rat_count,1);

        $alive_males_distribution = json_encode($lord->computeAgeDistribution(['sex' => 'M']));
        $alive_females_distribution = json_encode($lord->computeAgeDistribution(['sex' => 'F']));

        $rattery_count = $lord->countRatteries(['is_generic IS' => false]);
        $active_count = $lord->countRatteries(['is_alive IS' => true, 'is_generic IS' => false]);
        $active_frequency = round(100 * $active_count / $rattery_count, 2);
        $rattery_lifetime = $lord->computeAvgRatteryLifetime();

        $offset_option =  ['birth_date <=' => Chronos::today()->modify('-3 years')];
        $lifespan = $lord->roundLifespan($offset_option);
        $female_lifespan = $lord->roundLifespan(['sex' => 'F', 'birth_date <=' => Chronos::today()->modify('-3 years')]);
        $male_lifespan = $lord->roundLifespan(['sex' => 'M', 'birth_date <=' => Chronos::today()->modify('-3 years')]);

        $not_infant_lifespan = $lord->roundLifespan(['DeathPrimaryCauses.is_infant IS' => false, 'birth_date <=' => Chronos::today()->modify('-3 years')]);
        $not_infant_female_lifespan = $lord->roundLifespan(['sex' => 'F', 'DeathPrimaryCauses.is_infant IS' => false, 'birth_date <=' => Chronos::today()->modify('-3 years')]);
        $not_infant_male_lifespan = $lord->roundLifespan(['sex' => 'M', 'DeathPrimaryCauses.is_infant IS' => false, 'birth_date <=' => Chronos::today()->modify('-3 years')]);

        $not_accident_lifespan = $lord->roundLifespan(['DeathPrimaryCauses.is_infant IS' => false, 'DeathPrimaryCauses.is_accident IS' => false, 'birth_date <=' => Chronos::today()->modify('-3 years')]);
        $not_accident_female_lifespan = $lord->roundLifespan(['sex' => 'F', 'DeathPrimaryCauses.is_infant IS' => false, 'DeathPrimaryCauses.is_accident IS' => false, 'birth_date <=' => Chronos::today()->modify('-3 years')]);
        $not_accident_male_lifespan = $lord->roundLifespan(['sex' => 'M', 'DeathPrimaryCauses.is_infant IS' => false, 'DeathPrimaryCauses.is_accident IS' => false, 'birth_date <=' => Chronos::today()->modify('-3 years')]);

        $champion = $lord->findChampion();
        $champion = $rats->get($champion->id, ['contain' => ['Ratteries', 'BirthLitters']]);

        $distribution = $lord->computeMortalityDistribution()->enableHydration(false)->toArray();
        $survival = $lord->computeSurvivalRate($distribution);
        $median = $lord->computeDeathMedian($survival);
        $quartiles = $lord->computeDeathInterquartile($survival);
        $max = $lord->computeDeathPeak($distribution);
        $rate = json_encode($lord->computeMortalityRate($distribution));
        $expectancy = json_encode($lord->computeLifespanByYear(['birth_date <=' => Chronos::today()->modify('-3 years')])->toArray());
        $mortality = json_encode($distribution);
        $survival = json_encode($survival);

        $primaries = $lord->countRatsByPrimaryDeath();
        $secondaries = $lord->countRatsBySecondaryDeath();
        $tumours = $lord->countRatsByTumour();
        $tumour_dead_count = array_sum(array_column($tumours,'count'));

        $avg_mother_age = $lord->computeAvgMotherAge();
        $avg_father_age = $lord->computeAvgFatherAge();
        $avg_litter_size = $lord->computeAvgLitterSize();
        $debiased_avg_litter_size = $lord->computeAvgLitterSize(['pups_number >=' => '6', 'pups_number <=' => '16']);
        $litters_by_rattery = $lord->computeLittersByRattery();
        $litters_by_birthplace = $lord->computeLittersByRattery(['Contributions.contribution_type_id' => '1']);
        $litters_by_contributor = $lord->computeLittersByRattery(['Contributions.contribution_type_id >' => '1']);
        $pups_by_rattery = $lord->computePupsByRattery();
        $avg_sex_ratio = $lord->computeLitterSexRatioInWords([], 100);

        //FIXME: use $rattery->is_generic property
        $nongeneric_litter_count = $lord->countLitters([], true);
        $littersize_distribution = json_encode($lord->computeLitterSizeDistribution());
        $females_in_litter_distribution = json_encode($lord->computeLitterSexDistribution(['sex' => 'F']));
        $males_in_litter_distribution = json_encode($lord->computeLitterSexDistribution(['sex' => 'M']));

        // translations for javascript chart
        $js_legends = json_encode([
            'Females' => __('Females'),
            'Males' => __('Males'),
            'Age (in months)' => __('Age (in months)'),
            'Number of alive rats' => __('Number of alive rats'),
            'Age' => __('Age'),
            'Age pyramid' => __('Age pyramid'),
            '(presumed) alive rats' => __('(presumed) alive rats'),
            'Age: between ' => __x('litter statistics', 'Age: between '),
            ' and ' => __(' and '),
            'months' => __('months'),
            ' months' => __(' months'),
            'All-time average' => __('All-time average'),
            'All-time average:' => __('All-time average:'),
            'Average lifespan by birth year' => __('Average lifespan by birth year'),
            'Birth year' => __('Birth year'),
            'Average lifespan (in days)' => __('Average lifespan (in days)'),
            'Average lifespan:' => __('Average lifespan:'),
            'Life expectancy' => __('Life expectancy'),
            'days' => __('days'),
            'Rats born in' => __('Rats born in'),
            'Total litter size' => __('Total litter size'),
            'Litter size (number of pups)' => __('Litter size (number of pups)'),
            'Proportion of litters (%)' => __('Proportion of litters (%)'),
            'Litter size distribution (% of litters)' => __('Litter size distribution (% of litters)'),
            '% of litters' => __('% of litters'),
            'pups' => __('pups'),
            'Number of pups of the given sex' => __('Number of pups of the given sex'),
            'Litter size distribution by sex (% of litters)' => __('Litter size distribution by sex (% of litters)'),
            'Litters with' => __x('sex ratio', 'Litters with'),
            'Mortality distribution' => __('Mortality distribution'),
            'Mortality probability' => __('Mortality probability'),
            'Death probabilities (%)' => __('Death probabilities (%)'),
            'Survival rate' => __('Survival rate'),
            'Survival rate (%)' => __('Survival rate (%)'),
            'All-time survival and mortality by age' => __('All-time survival and mortality by age'),
            '% of all rats reach this age' => __('% of all rats reach this age'),
            '% of all deaths occur in rats of this age' => __('% of all deaths occur in rats of this age'),
            '% of all rats reaching this age die in the following month' => __('% of all rats reaching this age die in the following month'),
        ]);

        $this->set(compact(
            'rat_count', 'female_count', 'male_count', 'female_frequency', 'male_frequency',
            'dead_rat_count', 'dead_rat_frequency',
            'knowingly_dead_rat_count', 'knowingly_dead_rat_frequency',
            'alive_males_distribution', 'alive_females_distribution',
            'rattery_count', 'active_count', 'active_frequency', 'rattery_lifetime',
            'avg_mother_age', 'avg_father_age', 'avg_litter_size', 'debiased_avg_litter_size',
            'litters_by_rattery', 'litters_by_birthplace', 'litters_by_contributor',
            'pups_by_rattery', 'avg_sex_ratio',
            'nongeneric_litter_count', 'littersize_distribution', 'females_in_litter_distribution', 'males_in_litter_distribution',
            'lifespan', 'female_lifespan', 'male_lifespan',
            'not_infant_lifespan', 'not_infant_female_lifespan', 'not_infant_male_lifespan',
            'not_accident_lifespan', 'not_accident_female_lifespan', 'not_accident_male_lifespan',
            'champion',  'mortality', 'expectancy', 'survival', 'rate', 'median', 'max', 'quartiles',
            'primaries', 'secondaries', 'tumours', 'tumour_dead_count',
            'js_legends'
        ));
    }

    public function webstats()
    {
        $lord = new Lord();
        $this->Authorization->skipAuthorization();
        $user_count = $lord->countAll('Users');
        $rattery_count = $lord->countAll('Ratteries');
        $litter_count = $lord->countAll('Litters');
        $rat_count = $lord->countAll('Rats');
        $rat_birth = json_encode($lord->countRatsByYear());
        $user_creation = json_encode($lord->countAllByCreationYear('Users'));
        $rattery_creation = json_encode($lord->countAllByCreationYear('Ratteries'));

        $js_legends = json_encode([
            'Rats' => __('Rats'),
            'Rats by birth year' => __('Rats by birth year'),
            'Users' => __('Users'),
            'Users by registration year' => __('Users by registration year'),
            'Ratteries' => __('Ratteries'),
            'Ratteries by registration year' => __('Ratteries by registration year'),
        ]);

        $this->set(compact('user_count', 'rattery_count', 'litter_count', 'rat_count',
            'user_creation', 'rattery_creation', 'rat_birth', 'js_legends'));
    }

    public function hallOfFame() {
        $this->Authorization->skipAuthorization();
        $lord = new Lord();

        $depth = implode($this->request->getParam('pass'));
        if (empty($depth)) {
            $depth=10;
        }

        if ($depth > 100) {
            $date = FrozenTime::createFromFormat('Y-m-d', '2020-03-19');
            $interval = FrozenTime::today()->diff($date);
            $years = __dn('cake', '{0} year', '{0} years', $interval->y, $interval->y);
            $months = __dn('cake', '{0} month', '{0} months', $interval->m, $interval->m);
            $days = __dn('cake', '{0} day', '{0} days', $interval->d, $interval->d);
            $egg = trim(implode(', ', array_filter([$years, $months, $days], function ($val) {return ! str_starts_with($val, '0 ');})));
            $this->Flash->error(__('Game over! Thanks for playing with us. Oh, by the way, it’s been {0} that Artefact has quit smoking.', [$egg]));
            $this->redirect(['action' => 'hallOfFame']);
            $depth=10;
        }

        // rats by lifespan
        $champions = $lord->findChampions([], $depth);

        // ratteries by activity
        $lifetimes = $this->fetchModel('Contributions')
            ->find()
            ->select([
                'rattery_id' => 'Contributions.rattery_id',
                'rattery_prefix' => 'Ratteries.prefix',
                'rattery_name' => 'Ratteries.name',
                'Litters__id' => 'Litters.id',
                'Ratteries__id' => 'Ratteries.id',
                'Contributions__rattery_id' => 'Contributions.rattery_id',
                'lifetime' => 'DATEDIFF(MAX(Litters.birth_date), MIN(Litters.birth_date))',
                'first_birth' => 'MIN(Litters.birth_date)',
                'last_birth' => 'MAX(Litters.birth_date)',
            ])
            ->innerJoinWith('Litters')
            ->innerJoinWith('Ratteries', function ($q) {
                return $q->innerJoinWith('States', function ($q) {
                    return $q->where(['States.is_reliable IS' => true]);
                })->where(['Ratteries.is_generic IS' => false]);
            })
            ->group('rattery_id')
            ->order(['lifetime' => 'desc'])
            ->limit($depth)
            ->all()
            ->toArray();

        foreach ($lifetimes as &$lifetime) {
            $first_birth = FrozenTime::createFromFormat('Y-m-d', $lifetime['first_birth']);
            $last_birth = FrozenTime::createFromFormat('Y-m-d', $lifetime['last_birth']);
            $interval = $first_birth->diff($last_birth);
            $years = __dn('cake', '{0} year', '{0} years', $interval->y, $interval->y);
            $months = __dn('cake', '{0} month', '{0} months', $interval->m, $interval->m);
            //$days = __dn('cake', '{0} day', '{0} days', $interval->d, $interval->d);
            $lifetime['lifetime'] = trim(implode(', ', array_filter([$years, $months], function ($val) {return ! str_starts_with($val, '0 ');})));
        }

        // users by number of owned rats
        $rats = $this->fetchModel('Rats')->find();
        $users = $rats->select([
                'user_id' => 'owner_user_id',
                'user_email' => 'OwnerUsers.email',
                'user_name' => 'OwnerUsers.username',
                'count' => $rats->func()->count('*')
            ])
            ->contain('OwnerUsers')
            ->where(['OwnerUsers.email NOT LIKE' => '%@lord-rat.org%'])
            ->group('user_id')
            ->order(['count' => 'desc'])
            ->limit($depth)
            ->all()
            ->toArray();

        // ratteries by number of litters
        $contributions = $this->fetchModel('Contributions')->find();
        $ratteries = $contributions
            ->select([
                'rattery_id' => 'rattery_id',
                'rattery_prefix' => 'Ratteries.prefix',
                'rattery_name' => 'Ratteries.name',
                'count' => $contributions->func()->count('*')
            ])
            ->contain('Ratteries')
            ->where([
                'Ratteries.is_generic' => false,
                //'contribution_type_id' => 1
            ])
            ->group('rattery_id')
            ->order(['count' => 'desc'])
            ->limit($depth)
            ->all()
            ->toArray();

        $this->set(compact('champions', 'lifetimes', 'ratteries', 'users', 'depth'));
}

    public function contact() {
        $this->Authorization->skipAuthorization();

        $this->Flash->default(
            __('
                We strongly advised to consider alternative contact means before using this contact form, since our mailbox might not be regularly checked. Here are the recommended contact methods:

                <ul>
                    <li>
                        If you can connect to your LORD account, please use the “report” feature from the most appropriate sheet.
                    </li>
                    <li>
                        If you have or can create an account on <a href={0} class="flash">our support forum</a>, please try and reach out there.
                    </li>
                </ul>

                If none of these solutions suit you, you can proceed with the following form. We will do our best to answer your request in a timely manner.
                ',
                ["https://www.srfa.info/forums/forum/229-lord/"]
            ),
            ['escape' => false],
        );
    }

    public function acknowledge()
    {
        $this->Authorization->skipAuthorization();

        if ($this->request->is('post') && ! array_key_exists('message', $this->request->getData())) {
            if (strtolower($this->request->getData('captcha')) == 'domestique') {
                $initiator = $this->request->getData('initiator_email');
                $message = h($this->request->getData('email_content'));
                $mailer = $this->getMailer('User')->send('sendContactEmail', [$initiator, $message]);
                if ($mailer) {
                    $this->set(compact('message'));
                    return;
                } else {
                    $this->Flash->error(__('Error sending email. Please, retry or contact us by another mean.')); // . $email->smtpError);
                    return $this->redirect(['action => contact']);
                }
            } else {
                $this->Flash->error(__('This was not the expected answer! Sorry to insist, but we must check that you are not spam, sausage, spam, spam, bacon, spam, tomato and spam to protect our mailbox.'));
                $this->set(compact($message));
                return $this->redirect(['action => contact']);
            }
        } else {
            return $this->redirect(['action' => 'contact']);
        }
    }

    public function switchLanguage($lang)
    {
        $this->Authorization->skipAuthorization();

        // Set the language preference in the session
        $this->request->getSession()->write('Config.locale', $lang);

        // Redirect back to the referring page or any other desired page
        return $this->redirect($this->referer());
    }
}
