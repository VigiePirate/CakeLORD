<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Chronos\Chronos;
use App\Model\Entity\Lord;

class LordController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        /* $this->loadComponent('Security'); */
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['search', 'webstats']);
        /* $this->Security->setConfig('unlockedActions', ['transferOwnership, declareDeath']); */
    }

    public function search() {

        $this->Authorization->skipAuthorization();

        if($this->request->is(['post'])) {
            $names = [$this->request->getData('name')];
        } else {
                $names = $this->request->getParam('pass');
        }

        $model = $this->loadModel('Rats');
        $query = $model->find('identified', ['names' => $names])
            ->order('Rats.modified DESC')
            ->contain(['States', 'OwnerUsers', 'Ratteries', 'BirthLitters', 'BirthLitters.Contributions']);
        $count['rats'] = $query->count();
        $rats = $query->limit(10);

        $model = $this->loadModel('Ratteries');
        $query = $model->find('named', ['names' => $names])
            ->order('Ratteries.modified DESC')
            ->contain(['Countries', 'States', 'Users']);
        $count['ratteries'] = $query->count();
        $ratteries = $query->limit(10);

        $model = $this->loadModel('Users');
        $query = $model->find('named', ['names' => $names])
            ->order('Users.modified DESC')
            ->contain(['Roles', 'Ratteries']);
        $count['users'] = $query->count();
        $users = $query->limit(10);

        $this->set(compact('names', 'count', 'rats', 'ratteries', 'users'));
    }

    public function stats()
    {
        $lord = new Lord();
        $rats = $this->loadModel('Rats');

        $rat_count = $lord->countAll('Rats');
        $female_count = $lord->countRats(['sex' => 'F']);
        $male_count = $lord->countRats(['sex' => 'M']);
        $female_frequency = round(100 * $female_count / $rat_count,2);
        $male_frequency = round(100 * $male_count / $rat_count,2);

        $dead_rat_count = $lord->countRats(['OR' => ['is_alive IS' => false, 'DATEDIFF(NOW(), birth_date) >' => '1645']]);
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
        $active_count = $lord->countRatteries(['is_alive IS' => true]);
        $active_frequency = round(100 * $active_count / $rattery_count,2);
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
        $champion = $rats->get($champion->id, ['contain' => ['Ratteries','BirthLitters']]);

        $distribution = $lord->computeMortalityDistribution()->enableHydration(false)->toArray();
        $survival = $lord->computeSurvivalRate($distribution);
        $median = $lord->computeDeathMedian($survival);
        $quartiles = $lord->computeDeathInterquartile($survival);
        $max = $lord->computeDeathPeak($distribution);
        $rate = json_encode($lord->computeMortalityRate($distribution));
        $expectancy = json_encode($lord->computeLifespanByYear(['birth_date <=' => Chronos::today()->modify('-3 years')])->toArray());
        $mortality = json_encode($distribution);
        $survival = json_encode($survival);

        $primaries = $lord->countRatsByPrimaryDeath()->toArray();
        $secondaries = $lord->countRatsBySecondaryDeath();
        $tumours = $lord->countRatsByTumour()->toArray();
        $tumour_dead_count = array_sum(array_column($tumours,'count'));

        $avg_mother_age = $lord->computeAvgMotherAge();
        $avg_father_age = $lord->computeAvgFatherAge();
        $avg_litter_size = $lord->computeAvgLitterSize();
        $debiased_avg_litter_size = $lord->computeAvgLitterSize(['pups_number >=' => '6', 'pups_number <=' => '16']);
        $litters_by_rattery = $lord->computeLittersByRattery();
        $litters_by_birthplace = $lord->computeLittersByRattery(['Contributions.contribution_type_id' => '1']);
        $litters_by_contributor = $lord->computeLittersByRattery(['Contributions.contribution_type_id >' => '1']);
        $pups_by_rattery = $lord->computePupsByRattery();
        $avg_sex_ratio = $lord->computeLitterSexRatioInWords(['OffspringRats.rattery_id >' => '6'], 100);

        $nongeneric_litter_count = $lord->countLitters(['rattery_id >' => '6']);
        $littersize_distribution = json_encode($lord->computeLitterSizeDistribution()->toArray());
        $females_in_litter_distribution = json_encode($lord->computeLitterSexDistribution(['sex' => 'F']));
        $males_in_litter_distribution = json_encode($lord->computeLitterSexDistribution(['sex' => 'M']));

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
            'primaries', 'secondaries', 'tumours', 'tumour_dead_count'
        ));
    }

    public function webstats()
    {
        $lord = new Lord();
        $user_count = $lord->countAll('Users');
        $rattery_count = $lord->countAll('Ratteries');
        $litter_count = $lord->countAll('Litters');
        $rat_count = $lord->countAll('Rats');
        $rat_birth = json_encode($lord->countRatsByYear());
        $user_creation = json_encode($lord->countAllByCreationYear('Users'));
        $rattery_creation = json_encode($lord->countAllByCreationYear('Ratteries'));
        //$rat_creation = json_encode($lord->countAllByCreationYear('Rats'));
        $this->set(compact('user_count', 'rattery_count', 'litter_count', 'rat_count',
            'user_creation', 'rattery_creation', 'rat_birth'));
    }
}