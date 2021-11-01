<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\Datasource\FactoryLocator;
use Cake\Chronos\Chronos;
use Cake\Collection\Collection;

trait StatisticsTrait
{

    public function countAll($name)
    {
        $model = FactoryLocator::get('Table')->get($name);
        return $model->find()->count();
    }

    public function countMy($name)
    {
        $model = FactoryLocator::get('Table')->get($name);
        return $model->find()->where([$this->toString().'_id' => $this_id])->count();
    }

    public function countAllByCreationYear($name)
    {
        $model = FactoryLocator::get('Table')->get($name);
        $histogram = $model->find()
            ->where(['created IS NOT' => '1981-08-01'])
            ->select(['year' => 'YEAR(created)', 'count' => 'COUNT(id)'])
            ->group('year')
            ->order(['year' => 'ASC']);
        return $histogram;
    }

    public function countRats($options = []) {
        $model = FactoryLocator::get('Table')->get('Rats');
        return $model->find()->where($options)->count();
    }

    public function countMyRats($options = [])
    {
        $model = FactoryLocator::get('Table')->get('Rats');
        $rats = $model->find()->where([$options['field'] => $this->id]);
        return $rats->count();
    }

    public function frequencyOfMyRats($options = [])
    {
        $model = FactoryLocator::get('Table')->get('Rats');
        $rats = $model->find()->where([$options['field'] => $this->id]);
        $allrats = $model->find();
        return round (100 * $rats->count() / $allrats->count(),1);
    }

    public function countRatsByYear()
    {
        $model = FactoryLocator::get('Table')->get('Rats');
        $histogram = $model->find()
            ->where(['birth_date IS NOT' => '1981-08-01'])
            ->select(['year' => 'YEAR(birth_date)', 'count' => 'COUNT(id)'])
            ->group('year')
            ->order(['year' => 'ASC']);
        return $histogram;
    }

    public function countRatsByPrimaryDeath() {
        $model = FactoryLocator::get('Table')->get('Rats');
        $histogram = $model->find()
            ->where([
                'birth_date IS NOT' => '1981-08-01',
                'OR' => [
                    'death_secondary_cause_id !=' => '1',
                    'death_secondary_cause_id IS' => null,
                ],
                'is_alive' => false
            ])
            ->contain(['DeathPrimaryCauses', 'DeathSecondaryCauses'])
            ->select([
                'id' => 'Rats.death_primary_cause_id',
                'name' => 'DeathPrimaryCauses.name',
                'count' => 'COUNT(Rats.id)'])
            ->group('id')
            ->order(['count' => 'DESC'])
            ->enableHydration(false);
        return $histogram;
    }

    public function countRatsBySecondaryDeath() {
        $model = FactoryLocator::get('Table')->get('Rats')->find();

        $histogram_1 = $model
            ->where([
                'birth_date IS NOT' => '1981-08-01',
                'death_secondary_cause_id !=' => '1',
                'is_alive' => false
            ])
            ->contain(['DeathSecondaryCauses'])
            ->select([
                'name' => 'DeathSecondaryCauses.name',
                'count' => 'COUNT(Rats.id)'])
            ->group('name')
            ->order(['count' => 'DESC'])
            ->enableHydration(false);

        $histogram_2 = FactoryLocator::get('Table')->get('Rats')->find()
            ->where([
                'birth_date IS NOT' => '1981-08-01',
                'death_secondary_cause_id IS' => null,
                'is_alive' => false
            ])
            ->contain(['DeathSecondaryCauses','DeathPrimaryCauses'])
            ->select([
                'name' => 'concat("*", DeathPrimaryCauses.name)',
                'count' => 'COUNT(Rats.id)'])
            ->group('name')
            ->order(['count' => 'DESC'])
            ->enableHydration(false);

        $causes = array_merge($histogram_1->toArray(),$histogram_2->toArray());
        usort($causes, function ($cause1, $cause2) {
            return $cause2['count'] <=> $cause1['count'];
        });
        return $causes;
    }

    // should be able to reuse previous function with an option ['is_tumour' => true]
    public function countRatsByTumour() {
        $model = FactoryLocator::get('Table')->get('Rats');
        $histogram = $model->find()
            ->where([
                'birth_date IS NOT' => '1981-08-01',
                'death_secondary_cause_id !=' => '1',
                'is_alive' => false,
                'is_tumor' => true,
            ])
            ->contain(['DeathSecondaryCauses'])
            ->select([
                'name' => 'DeathSecondaryCauses.name',
                //'is_tumor' => 'DeathSecondaryCauses.is_tumor',
                'count' => 'COUNT(Rats.id)'])
            ->group('name')
            ->order(['count' => 'DESC'])
            ->enableHydration(false);
        return $histogram;
    }

    public function countRatteries($options = []) {
        $model = FactoryLocator::get('Table')->get('Ratteries');
        return $model->find()->where($options)->count();
    }

    public function countLitters($options = []) {
        $model = FactoryLocator::get('Table')->get('Litters');
        return $model->find()->where($options)->innerJoinWith('Contributions')->count();
    }

    /* I don't understand why this function works, but it is probably twisted */
    public function computeAvgRatteryLifetime($options = []) {
        $model = FactoryLocator::get('Table')->get('Ratteries');

        $filter = [];

        if(!empty($options)) {
            $filter = array_merge($filter,$options);
        }

        $lifetimes = $model->find()
            ->select([
                'rattery_id' => 'Ratteries.id',
                'lifetime' => 'DATEDIFF(MAX(Litters.birth_date),MIN(Litters.birth_date))'
            ])
            ->innerJoinWith('Contributions.Litters')
            ->where(['is_generic IS' => false])
            ->group('rattery_id')
            ->enableAutoFields(true) // should be replaced by selecting only useful fields
            ->enableHydration(false)
            ->toArray();

        $lifetime = array_column($lifetimes, 'lifetime');
        return round(array_sum($lifetime)/count($lifetime));
    }

    public function computeLittersByRattery($litter_options = [], $rattery_options = []) {
        $litter_count = $this->countLitters(array_merge($litter_options, ['Contributions.rattery_id >' => '6']));
        $rattery_count = $this->countRatteries(array_merge($rattery_options, ['is_generic IS' => false]));
        return round($litter_count/$rattery_count,1);
    }

    public function computePupsByRattery($rat_options = [], $rattery_options = []) {
        $rat_count = $this->countRats(array_merge($rat_options, ['rattery_id >' => '6']));
        $rattery_count = $this->countRatteries(array_merge($rattery_options, ['is_generic IS' => false]));
        return round($rat_count/$rattery_count,1);
    }

    public function computeAvgMotherAge($options = []) {
        $model = FactoryLocator::get('Table')->get('Rats');
        $avg = $model->find()
            ->select([
                'avg' => 'AVG(DATEDIFF(BredLitters.birth_date, Rats.birth_date))'
                ])
            ->where(['sex' => 'F'])
            ->leftJoinWith('BredLitters')
            ->enableAutoFields(true)
            ->first();
        return $avg['avg'];
    }

    public function computeAvgFatherAge($options = []) {
        $model = FactoryLocator::get('Table')->get('Rats');
        $avg = $model->find()
            ->select([
                'avg' => 'AVG(DATEDIFF(BredLitters.birth_date, Rats.birth_date))'
                ])
            ->where(['sex' => 'M'])
            ->leftJoinWith('BredLitters')
            ->enableAutoFields(true)
            ->first();
        return $avg['avg'];
    }

    public function computeAvgLitterSize($options = []) {
        $model = FactoryLocator::get('Table')->get('Litters');
        $filter = ['Contributions.rattery_id >' => '6'];
        if(!empty($options)) {
            $filter = array_merge($filter,$options);
        }
        $avg = $model->find()
            ->select(['avg' => 'AVG(pups_number)'])
            ->leftJoinWith('Contributions')
            ->enableAutoFields(true)
            ->where($filter)
            ->first();
        return round($avg['avg'],1);
    }

    // should exclude generic ratteries as an option
    // (for litter sex count, since there are litters with generic prefix)
    // (average global stat should exclude them however)
    public function computeLitterSexes($options = []) {
        $query = FactoryLocator::get('Table')->get('Litters')
            ->find()
            ->where($options)
            ->innerJoinWith('OffspringRats');
        $females = $query->newExpr()
            ->addCase(
                $query->newExpr()->add(['sex' => 'F']),
                1,
                'integer'
            );
        $males = $query->newExpr()
            ->addCase(
                $query->newExpr()->add(['sex' => 'M']),
                1,
                'integer'
            );

        $query = $query
            ->select([
                'litter_id' => 'litter_id',
                'F' => $query->func()->count($females),
                'M' => $query->func()->count($males)
            ])
            ->group('litter_id');

        return $query->enableHydration(false);
    }

    // use real php function to compute averages!
    public function computeLitterSexRatio($options = []) {
        $litters = $this->computeLitterSexes($options)->toArray();
        $valid_litters_count = 0;
        $male_proportion_sum = 0;
        foreach ($litters as $litter) {
            $litter_size = $litter['M'] + $litter['F'];
            if ($litter_size > 1) {
                $valid_litters_count++;
                $male_proportion_sum += $litter['M'] / $litter_size;
            }
        }
        $avg_male_proportion = $male_proportion_sum/$valid_litters_count;
        $avg_female_proportion = 1 - $avg_male_proportion;
        return $avg_male_proportion/$avg_female_proportion;
    }

    public function computeLitterSexRatioInWords($options = []) {
        $sex_ratio = round($this->computeLitterSexRatio($options),2);
        if ($sex_ratio >= 1) {
            $operands = $this->computeFareyApproximation($sex_ratio,100);
            return h($sex_ratio) . ' (about ' . h($operands[0]) . __(' males for ' . h($operands[1]) . ' females') . ')';
        } else {
            $inverse_ratio = round(1/$sex_ratio,2);
            $operands = $this->computeFareyApproximation($inverse_ratio,100);
            return h($sex_ratio) . ' (about ' . h($operands[0]) . __(' females for ' . h($operands[1]) . ' males') . ')';
        }
    }

    // output format should be changed to match that of LitterSizeDistribution?
    public function computeLitterSexDistribution($sex) {
        $histogram = $this->computeLitterSexes()->toArray();
        $histogram = array_count_values(array_column($histogram, $sex['sex']));
        return $histogram;
    }

    public function computeLitterSizeDistribution() {
        $model = FactoryLocator::get('Table')->get('Litters');
        if(!empty($options)) {
            $filter = array_merge($filter,$options);
        }
        $histogram = $model->find()
            ->select([
                'size' => 'pups_number',
                'count' => 'COUNT(Litters.id)',
                //'Litters__id' => 'litter_id',
                //'Contributions__litter_id' => 'Contributions.litter_id'
            ])
            ->matching('Contributions.Ratteries', function ($q) {
                return $q->where(['Ratteries.is_generic IS' => false]);
            })
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->group('size')
            ->order(['size' => 'ASC']);
        return $histogram;
    }

    public function computeLifespan($options = []) {
        $model = FactoryLocator::get('Table')->get('Rats');

        $filter = [
            'is_alive IS' => false,
            'birth_date IS NOT' => null,
            'birth_date IS NOT' => null,
            'birth_date <=' => Chronos::today()->modify('-3 years'),
            'birth_date IS NOT' => '1981-08-01',
            'death_date IS NOT' => '1981-08-01',
            'OR' => [
                'death_secondary_cause_id !=' => '1',
                'death_secondary_cause_id IS' => null,
            ]
        ];

        if(!empty($options)) {
            $filter = array_merge($filter,$options);
        }

        $lifespan = $model->find()->contain(['DeathPrimaryCauses'])->where($filter);

        $lifespan = $lifespan
            ->select(['lifespan' => 'ROUND(AVG(DATEDIFF(death_date,birth_date)))'])
            ->where(['DATEDIFF(death_date,birth_date) <' => '1645']);
        return $lifespan;
    }

    // to be improved: cut-off should be softcoded!
    // first year: when enough rats to guarantee significance
    // last year: enough rats + 2 years before current date to avoid young-death bias
    public function computeLifespanByYear($options = []) {
        $expectancy = $this->computeLifespan($options);
        $expectancy = $expectancy
            ->select(['year' => 'YEAR(birth_date)'])
            ->where([
                'YEAR(birth_date) >' => '2000',
                'YEAR(birth_date) <=' => Chronos::today()->modify('-3 years'),
            ])
            ->group('year')
            ->order(['year' => 'ASC']);

        return $expectancy;
    }

    public function roundLifespan($options = []) {
        $lifespan = $this->computeLifespan($options)->first();
        return round($lifespan['lifespan']/30.5,1);
    }

    public function computeAgeDistribution($options = []) {
        $model = FactoryLocator::get('Table')->get('Rats');

        $filter = [
            'is_alive IS' => true,
            'birth_date IS NOT' => null,
            'birth_date IS NOT' => '1981-08-01'
        ];

        if(!empty($options)) {
            $filter = array_merge($filter, $options);
        }

        $pyramid = $model->find()->where($filter);

        $pyramid = $pyramid
            ->select(['months' => 'FLOOR(DATEDIFF(NOW(),birth_date)/30.5)', 'count' => 'COUNT(Rats.id)'])
            ->where(['DATEDIFF(NOW(),birth_date) >=' => '0', 'DATEDIFF(NOW(),birth_date) <' => '1645'])
            ->group('months')
            ->order(['months' => 'ASC']);

        return $pyramid;
    }

    public function computeMortalityDistribution($options = []) {
        $model = FactoryLocator::get('Table')->get('Rats');

        $filter = [
            'is_alive IS' => false,
            'birth_date IS NOT' => null,
            'birth_date IS NOT' => null,
            'birth_date IS NOT' => '1981-08-01',
            'death_date IS NOT' => '1981-08-01',
            'OR' => [
                'death_secondary_cause_id !=' => '1',
                'death_secondary_cause_id IS' => null,
            ],
            'death_primary_cause_id !=' => '6'
        ];

        if(!empty($options)) {
            $filter = array_merge($filter,$options);
        }

        $mortality = $model->find()->contain(['DeathPrimaryCauses'])->where($filter);

        $mortality = $mortality
            ->select(['months' => 'FLOOR(DATEDIFF(death_date,birth_date)/30.5)', 'count' => 'COUNT(Rats.id)'])
            ->where(['DATEDIFF(death_date,birth_date) >=' => '0', 'DATEDIFF(death_date,birth_date) <' => '1645'])
            ->group('months')
            ->order(['months' => 'ASC']);

        return $mortality;
    }

    /* to improve, prone to bug */
    /* (assumes mortality_distribution has no holes in the 'months' field) */
    public function computeSurvivalRate($mortality_distribution = []) {

        if(empty($mortality_distribution)) {
            $mortality_distribution = $this->computeMortalityDistribution();
        }

        $cumulative = 0;
        $deaths = array_map(function ($entry) use (&$cumulative) { return $cumulative += $entry; }, array_column($mortality_distribution,'count'));

        $survival = $mortality_distribution;
        $max_months = count($deaths);
        $total_deaths = array_sum(array_column($survival, 'count'));
        for ($i=0; $i < $max_months; $i++) {
            $survival[$i]['count'] = 100*round(1-$deaths[$i]/$total_deaths,5);
        }
        return $survival;
    }

    /* to improve, prone to bug */
    /* (assumes mortality_distrib has no holes in the 'months' field) */
    public function computeMortalityRate($mortality_distribution = []) {

        if(empty($mortality_distribution)) {
            $mortality_distribution = $this->computeMortalityDistribution();
        }

        $max_months = count($mortality_distribution);
        $rate = $mortality_distribution;
        $total_deaths = array_sum(array_column($rate, 'count'));
        $starters = $total_deaths;
        for ($i=0; $i < $max_months; $i++) {
            $finishers = $starters-$mortality_distribution[$i]['count'] ;
            $rate[$i]['count'] = 100*(1-$finishers/$starters);
            $starters = $finishers;
        }
        return $rate;
    }

    public function computeDeathMedian($survival = []) {
        if(empty($survival)) {
            $survival = $this->computeSurvivalRate();
        }

        $median = 0;
        foreach ($survival as $slot) {
            if ($slot['count'] >= 50) {
                $median = $slot['months'];
            }
        }
        return $median+1;
    }

    public function computeDeathPeak($distribution = []) {
        if(empty($distribution)) {
            $distribution = $this->computeMortalityDistribution();
        }

        $maximum = 0; $maximizer = 0;
        foreach ($distribution as $slot) {
            if ($slot['count'] >= $maximum) {
                $maximum = $slot['count'];
                $maximizer = $slot['months'];
            }
        }
        return $maximizer;
    }

    public function computeDeathInterquartile($survival = []) {
        if(empty($survival)) {
            $survival = $this->computeSurvivalRate();
        }

        $quartiles = [
            'first' => '0',
            'last' => '0'
        ];

        foreach ($survival as $slot) {
            if ($slot['count'] >= 75) {
                $quartiles['first'] = $slot['months'];
            }
            if ($slot['count'] >= 25) {
                $quartiles['last'] =  $slot['months'];
            }
        }

        return $quartiles;
    }

    public function findChampion() {
        $model = FactoryLocator::get('Table')->get('Rats');

        $max = $model->find()
            ->select(['max' => 'MAX(DATEDIFF(Rats.death_date,Rats.birth_date))'])
            ->where([
                'Rats.is_alive IS' => false,
                'Rats.birth_date IS NOT' => null,
                'Rats.death_date IS NOT' => null,
                'Rats.birth_date IS NOT' => '1981-08-01',
                'Rats.death_date IS NOT' => '1981-08-01',
                'OR' => [
                    'death_secondary_cause_id !=' => '1',
                    'death_secondary_cause_id IS' => null
                ],
                'States.is_reliable IS' => true,
                'DATEDIFF(Rats.death_date,Rats.birth_date) <' => '1645'
            ])
            ->innerJoinWith('Ratteries', function ($q) {
                return $q->where(['Ratteries.is_generic IS' => false]);
                })
            ->contain(['States'])
            ->first();

        $max = $max['max'];

        $champion = $model->find()
            ->select([
                'id' => 'Rats.id'
            ])
            ->where([
                'Rats.is_alive IS' => false,
                'Rats.birth_date IS NOT' => null,
                'Rats.birth_date IS NOT' => null,
                'Rats.birth_date IS NOT' => '1981-08-01',
                'Rats.death_date IS NOT' => '1981-08-01',
                'OR' => [
                    'Rats.death_secondary_cause_id !=' => '1',
                    'Rats.death_secondary_cause_id IS' => null
                ],
                'DATEDIFF(Rats.death_date,Rats.birth_date) =' => $max,
                'DATEDIFF(death_date,birth_date) <' => '1645'
            ])
            ->innerJoinWith('Ratteries', function ($q) {
                return $q->where(['Ratteries.is_generic IS' => false]);
                })
            ->innerJoinWith('States', function ($q) {
                return $q->where(['States.is_reliable IS' => true]);
                })
            ;

        return $champion;
    }

    /* UTILITIES */
    function computeFareyApproximation($val, $lim) {
        if($val < 0) {
            list($n, $d) = farey(-$val, $lim);
            return array(-$n, $d);
        }
        $z = $lim - $lim;
        list($lower, $upper) = array(array($z, $z+1), array($z+1, $z));
        while(true) {
            $mediant = array(($lower[0] + $upper[0]), ($lower[1] + $upper[1]));
            if($val * $mediant[1] > $mediant[0]) {
                if($lim < $mediant[1])
                    return $upper;
                $lower = $mediant;
            }
            else if($val * $mediant[1] == $mediant[0]) {
                if($lim >= $mediant[1])
                    return $mediant;
                if($lower[1] < $upper[1])
                    return $lower;
                return $upper;
            }
            else {
                if($lim < $mediant[1])
                    return $lower;
                $upper = $mediant;
            }
        }
    }
}
