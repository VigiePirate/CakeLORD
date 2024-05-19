<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\Datasource\FactoryLocator;
use Cake\Chronos\Chronos;
use Cake\Collection\Collection;
use App\Model\Table\RatsTable;

trait StatisticsTrait
{
    public function countAll($name, $options = [])
    {
        $model = FactoryLocator::get('Table')->get($name);
        $query = $model->find()->where($options);

        if ($model->associations()->has('States')) {
            $query = $query->innerJoinWith('States', function ($q) {
                return $q->where(['States.is_reliable IS' => true]);
            });
        }

        return $query->count();
    }

    public function countMy($name, $key, $options = [])
    {
        $model = FactoryLocator::get('Table')->get($name);
        $filter = [$key.'_id' => $this->id];
        if (! empty($options)) {
            $filter = array_merge($filter, $options);
        }

        $query = $model->find()->where($filter);

        if (! isset($options['litter_id']) && $model->associations()->has('States')) {
            $query = $query->innerJoinWith('States', function ($q) {
                return $q->where(['States.is_reliable IS' => true]);
            });
        }

        return $query->count();
    }

    public function countHaving($name, $key, $options = [])
    {
        $model = FactoryLocator::get('Table')->get($name);

        $query = $model->find()
            ->matching($key, function ($q) use ($key) {
                return $q->where([$key.'.id' => $this->id]);
            });

        if (! empty($options)) {
            $query = $query->where($options);
        }

        if ($model->associations()->has('States')) {
            $query = $query->innerJoinWith('States', function ($q) {
                return $q->where(['States.is_reliable IS' => true]);
            });
        }

        return $query->count();
    }

    public function frequencyOfMy($name, $key, $options = [])
    {
        $model = $this->countMy($name, $key, $options);
        $all = $this->countAll($name, $options);
        return round (100 * $model / $all, 2);
    }

    public function frequencyOfHaving($name, $key, $options = [])
    {
        $model = $this->countHaving($name, $key, $options);
        $all = $this->countAll($name, $options);
        return round (100 * $model / $all, 2);
    }

    public function countAllByCreationYear($name, $options = [])
    {
        $model = FactoryLocator::get('Table')->get($name);
        $filter = ['created !=' => '1981-08-01'];
        if (! empty($options)) {
            $filter = array_merge($filter, $options);
        }
        $histogram = $model->find()->where($filter);

        if ($model->associations()->has('States')) {
            $histogram = $histogram
                ->innerJoinWith('States', function ($q) {
                    return $q->where(['States.is_reliable IS' => true]);
                })
                ->select([$name.'__state_id' => $name.'.state_id']);
        }

        $histogram->select([
            'year' => 'YEAR(created)',
            'count' => 'COUNT('.$name.'.id)'
        ])
            ->group('year')
            ->order(['year' => 'ASC']);
        return $histogram;
    }

    public function countRats($options = [], $exclude_generic = false) {
        $model = FactoryLocator::get('Table')->get('Rats');
        $query = $model->find();

        $filter = [];
        if (! empty($options)) {
            $filter = array_merge($filter, $options);
        }

        $query->where($filter);

        // exclude unreliable sheets everywhere but on user personal stats
        if (! isset($options['owner_user_id']) && ! isset($options['creator_user_id'])) {
            $query->innerJoinWith('States', function ($q) {
                return $q->where(['States.is_reliable IS' => true]);
            });
        }

        if ($exclude_generic) {
            $query = $query
                ->innerJoinWith('Ratteries', function ($q) {
                    return $q->where(['Ratteries.is_generic IS' => false]);
                });
        }

        return $query->count();
    }

    public function countRatsByContributor($rattery_id, $options = []) {
        $model = FactoryLocator::get('Table')->get('Rats');

        $filter1 = ['Rats.rattery_id' => $rattery_id];
        $filter2 = [
            'Rats.rattery_id !=' => $rattery_id,
            'Contributions.rattery_id' => $rattery_id,
            'Contributions.contribution_type_id >' => 1
        ];

        if (! empty($options)) {
            $filter1 = array_merge($filter1, $options);
            $filter2 = array_merge($filter2, $options);
        }

        $result1 = $model
            ->find()
            ->innerJoinWith('States', function ($q) {
                return $q->where(['States.is_reliable IS' => true]);
            })
            ->where($filter1)
            ->count();

        $result2 = $model
            ->find()
            ->innerJoinWith('BirthLitters.Contributions', function ($q) use ($rattery_id) {
                return $q->where(['Contributions.rattery_id' => $rattery_id]);
            })
            ->innerJoinWith('States', function ($q) {
                return $q->where(['States.is_reliable IS' => true]);
            })
            ->where($filter2)
            ->count();

        return ($result1 + $result2);
    }

    public function countRatsByYear()
    {
        $model = FactoryLocator::get('Table')->get('Rats');
        $filter = ['birth_date !=' => '1981-08-01'];
        if (! empty($options)) {
            $filter = array_merge($filter, $options);
        }
        $histogram = $model->find()
            ->where($filter)
            ->innerJoinWith('States', function ($q) {
                return $q->where(['States.is_reliable IS' => true]);
            })
            ->select([
                'Rats__state_id' => 'Rats.state_id',
                'year' => 'YEAR(birth_date)',
                'count' => 'COUNT(Rats.id)'
            ])
            ->group('year')
            ->order(['year' => 'ASC']);
        return $histogram;
    }

    // will compute sex ratio of a (sub)set of rats
    // for litter-based sex ratio, see computeLitterSexRatio* functions
    public function computeRatSexRatioInWords($options = [], $max_denominator = 10) {
        $model = FactoryLocator::get('Table')->get('Rats');

        $filter_F = ['sex' => 'F'];
        $filter_M = ['sex' => 'M'];

        if (! empty($options)) {
            $filter_F = array_merge($filter_F, $options);
            $filter_M = array_merge($filter_M, $options);
        }

        $females = $model->find()
            ->where($filter_F)
            ->leftJoinWith('BirthLitters.Contributions')
            ->innerJoinWith('States', function ($q) {
                return $q->where(['States.is_reliable IS' => true]);
            })
            ->distinct()
            ->count();
        $males = $model->find()
            ->where($filter_M)
            ->leftJoinWith('BirthLitters.Contributions')
            ->innerJoinWith('States', function ($q) {
                return $q->where(['States.is_reliable IS' => true]);
            })
            ->distinct()
            ->count();

        if ($females == 0) {
            return __('Male-only');
        }

        $sex_ratio = $males/$females;

        if ($sex_ratio == 0) {
            return __('Female-only');
        }

        $sex_ratio = round($sex_ratio,3);

        if ($sex_ratio == 1) {
            return __('Balanced (1 male for 1 female)');
        }

        //FIXME: deal with singular/plural
        if ($sex_ratio > 1) {
            $operands = $this->computeFareyApproximation($sex_ratio, $max_denominator);
            return __('{0, number} (about {1, plural, =1{1 male} other{# males}} for {2, plural, =1{1 female} other{# females}})', [$sex_ratio, $operands[0], $operands[1]]);
        } else {
            $inverse_ratio = round(1/$sex_ratio,2);
            $operands = $this->computeFareyApproximation($inverse_ratio, $max_denominator);
            return __('{0, number} (about {1, plural, =1{1 female} other{# females}} for {2, plural, =1{1 male} other{# males}})', [$sex_ratio, $operands[0], $operands[1]]);
        }
    }

    // FIXME rewrite from DeathPrimaryCausesTable or get translated alias 'name' directly in select
    public function countRatsByPrimaryDeath($options = []) {
        $model = FactoryLocator::get('Table')->get('Rats');

        $filter = [
            'birth_date IS NOT' => '1981-08-01',
            'OR' => [
                'death_secondary_cause_id !=' => '1',
                'death_secondary_cause_id IS' => null,
            ],
            'is_alive' => false
        ];

        if (! empty($options)) {
            $filter = array_merge($filter,$options);
        }

        $histogram = $model->find()
            ->where($filter)
            ->innerJoinWith('States', function ($q) {
                return $q->where(['States.is_reliable IS' => true]);
            })
            ->contain([
                'DeathPrimaryCauses',
                'DeathSecondaryCauses',
            ])
            ->select([
                'id' => 'Rats.death_primary_cause_id',
                'count' => 'COUNT(Rats.id)',
                'Rats__state_id' => 'Rats.state_id',
                'DeathPrimaryCauses__id' => 'Rats.death_primary_cause_id',
            ])
            ->group('id')
            ->order(['count' => 'DESC'])
            ->toArray();

        // add name in array (not done in select query because of translations)
        $causes = FactoryLocator::get('Table')->get('DeathPrimaryCauses');
        foreach ($histogram as $idx => $cause) {
            $histogram[$idx]['name'] = $causes->get($cause->death_primary_cause->id)->name;
        }

        return $histogram;
    }

    // FIXME rewrite from Death(Primary|Secondary)CausesTable or get translated alias 'name' directly in select
    // uses 2 queries in order to deal with 'null' secondary deaths
    public function countRatsBySecondaryDeath($options = []) {
        $model = FactoryLocator::get('Table')->get('Rats');

        $filter_1 = [
            'birth_date !=' => '1981-08-01',
            'death_secondary_cause_id !=' => '1',
            'is_alive' => false
        ];

        if (! empty($options)) {
            $filter_1 = array_merge($filter_1,$options);
        }

        $histogram_1 = $model
            ->find()
            ->where($filter_1)
            ->innerJoinWith('States', function ($q) {
                return $q->where(['States.is_reliable IS' => true]);
            })
            ->contain(['DeathSecondaryCauses'])
            ->select([
                'id' => 'DeathSecondaryCauses.id',
                //'name' => 'DeathSecondaryCauses.name',
                'Rats__state_id' => 'Rats.id',
                'Rats__death_secondary_cause_id' => 'DeathSecondaryCauses.id',
                'count' => 'COUNT(Rats.id)'
            ])
            ->group('id')
            ->order(['count' => 'DESC'])
            ->toArray();

        // add name in array (not done in select query because of translations)
        $causes = FactoryLocator::get('Table')->get('DeathSecondaryCauses');
        foreach ($histogram_1 as $idx => $cause) {
            $histogram_1[$idx]['name'] = $causes->get($cause->id)->name;
        }

        $filter_2 = [
            'birth_date !=' => '1981-08-01',
            'death_secondary_cause_id IS' => null,
            'is_alive' => false
        ];

        if (! empty($options)) {
            $filter_2 = array_merge($filter_2,$options);
        }

        $histogram_2 = $model
            ->find()
            ->where($filter_2)
            ->innerJoinWith('States', function ($q) {
                return $q->where(['States.is_reliable IS' => true]);
            })
            ->contain(['DeathSecondaryCauses','DeathPrimaryCauses'])
            ->select([
                'id' => 'DeathPrimaryCauses.id',
                //'name' => 'concat("*", DeathPrimaryCauses.name)',
                'count' => 'COUNT(Rats.id)',
                'Rats__state_id' => 'Rats.id',
                'Rats__death_primary_cause_id' => 'DeathPrimaryCauses.id',
                'Rats__death_secondary_cause_id' => 'DeathSecondaryCauses.id',
            ])
            ->group('id')
            ->order(['count' => 'DESC'])
            ->toArray();

        // add name in array (not done in select query because of translations)
        $causes = FactoryLocator::get('Table')->get('DeathPrimaryCauses');
        foreach ($histogram_2 as $idx => $cause) {
            $histogram_2[$idx]['name'] = "*" . $causes->get($cause->id)->name;
        }

        $causes = array_merge($histogram_1, $histogram_2);
        usort($causes, function ($cause1, $cause2) {
            return $cause2['count'] <=> $cause1['count'];
        });
        return $causes;
    }

    // does not reuse previous with option ['is_tumour' => true] to avoid double query
    public function countRatsByTumour($options = []) {
        $model = FactoryLocator::get('Table')->get('Rats');

        $filter = [
            'birth_date !=' => '1981-08-01',
            'death_secondary_cause_id !=' => '1',
            'is_alive' => false,
            'is_tumor' => true,
        ];

        if (! empty($options)) {
            $filter = array_merge($filter, $options);
        }

        $histogram = $model->find()
            ->where($filter)
            ->innerJoinWith('States', function ($q) {
                return $q->where(['States.is_reliable IS' => true]);
            })
            ->contain(['DeathSecondaryCauses'])
            ->select([
                // 'name' => 'DeathSecondaryCauses.name',
                'id' => 'DeathSecondaryCauses.id',
                'count' => 'COUNT(Rats.id)',
                'Rats__state_id' => 'Rats.state_id',
                'Rats__death_secondary_cause_id' => 'DeathSecondaryCauses.id',
            ])
            ->group('id')
            ->order(['count' => 'DESC'])
            ->toArray();

        // add name in array (not done in select query because of translations)
        $causes = FactoryLocator::get('Table')->get('DeathSecondaryCauses');
        foreach ($histogram as $idx => $cause) {
            $histogram[$idx]['name'] = $causes->get($cause->death_secondary_cause_id)->name;
        }

        return $histogram;
    }

    public function countRatteries($options = []) {
        $model = FactoryLocator::get('Table')->get('Ratteries');
        return $model
            ->find()
            ->where($options)
            ->innerJoinWith('States', function ($q) {
                return $q->where(['States.is_reliable IS' => true]);
            })
            ->count();
    }

    public function countLitters($options = [], $exclude_generic = false) {
        $model = FactoryLocator::get('Table')->get('Litters');
        $query = $model
            ->find()
            ->where($options)
            ->innerJoinWith('States', function ($q) {
                return $q->where(['States.is_reliable IS' => true]);
            });

        if ($exclude_generic) {
            $query = $query
                ->innerJoinWith('Contributions')
                ->innerJoinWith('Contributions.Ratteries', function ($q) {
                    return $q->where(['Ratteries.is_generic IS' => false]);
                });
        } else {
            $query = $query->innerJoinWith('Contributions');
        }

        return $query->count();
    }

    public function countContributions($options = []) {
        $model = FactoryLocator::get('Table')->get('Contributions');
        return $model
            ->find()
            ->where($options)
            ->innerJoinWith('Litters')
            ->innerJoinWith('Litters.States', function ($q) {
                return $q->where(['States.is_reliable IS' => true]);
            })
            ->count();
    }

    public function countPups($options = []) {
        $model = FactoryLocator::get('Table')->get('Contributions');
        $pups = $model->find()
            ->select([
                //'Litters__state_id' => 'Litters.state_id',
                'Contributions__litter_id' => 'Contributions.litter_id',
                'sum' => 'SUM(Litters.pups_number)'
            ])
            ->where($options)
            ->innerJoinWith('Litters.States', function ($q) {
                return $q->where(['States.is_reliable IS' => true]);
            })
            ->first();

        return is_null($pups['sum']) ? 0 : intval($pups['sum']) ;
    }

    public function computeAvgRatteryLifetime($options = []) {
        $model = FactoryLocator::get('Table')->get('Contributions');

        $filter = [];

        if (! empty($options)) {
            $filter = array_merge($filter,$options);
        }

        $lifetimes = $model->find()
            ->select([
                'Litters__id' => 'Litters.id',
                'Ratteries__id' => 'Ratteries.id',
                'Contributions__rattery_id' => 'Contributions.rattery_id',
                'lifetime' => 'DATEDIFF(MAX(Litters.birth_date),MIN(Litters.birth_date))'
            ])
            ->innerJoinWith('Litters')
            ->innerJoinWith('Ratteries', function ($q) {
                return $q->innerJoinWith('States', function ($q) {
                    return $q->where(['States.is_reliable IS' => true]);
                })->where(['Ratteries.is_generic IS' => false]);
            })
            ->group('rattery_id')
            ->toArray();

        $lifetime = array_column($lifetimes, 'lifetime');
        return round(array_sum($lifetime)/count($lifetime));
    }

    public function computeLittersByRattery($litter_options = [], $rattery_options = []) {
        $litter_count = $this->countLitters($litter_options, true);
        $rattery_count = $this->countRatteries(array_merge($rattery_options, ['is_generic IS' => false]));
        return round($litter_count/$rattery_count,1);
    }

    public function computePupsByRattery($rat_options = [], $rattery_options = []) {
        $rat_count = $this->countRats($rat_options, true);
        $rattery_count = $this->countRatteries(array_merge($rattery_options, ['is_generic IS' => false]));
        return round($rat_count/$rattery_count,1);
    }

    public function computeAvgMotherAge($options = []) {
        $model = FactoryLocator::get('Table')->get('Litters');

        $filter = [
            'Dam.id >' => 1,
            'Litters.birth_date !=' => '1981-08-01',
            'Dam.birth_date !=' => '1981-08-01',
            'Dam.birth_date IS NOT' => null
        ];

        if (! empty($options)) {
            $filter = array_merge($filter,$options);
        }

        $avg = $model->find()
            ->select([
                'avg' => 'AVG(DATEDIFF(Litters.birth_date, Dam.birth_date))',
                'Litters__id' => 'Litters.id',
                'Litters__state_id' => 'Litters.state_id',
                ])
            ->where($filter)
            ->leftJoinWith('Dam')
            ->leftJoinWith('Contributions')
            ->innerJoinWith('States', function ($q) {
                return $q->where(['is_reliable IS' => true]);
            })
            ->first();
        return $avg['avg'];
    }

    public function computeAvgFatherAge($options = []) {
        $model = FactoryLocator::get('Table')->get('Litters');

        $filter = [
            'Sire.id >' => 2,
            'Litters.birth_date !=' => '1981-08-01',
            'Sire.birth_date !=' => '1981-08-01',
            'Sire.birth_date IS NOT' => null
        ];

        if (! empty($options)) {
            $filter = array_merge($filter,$options);
        }

        $avg = $model->find()
            ->select([
                'avg' => 'AVG(DATEDIFF(Litters.birth_date, Sire.birth_date))',
                'Litters__id' => 'Litters.id',
                'Litters__state_id' => 'Litters.state_id',
            ])
            ->where($filter)
            ->leftJoinWith('Sire')
            ->leftJoinWith('Contributions')
            ->innerJoinWith('States', function ($q) {
                return $q->where(['is_reliable IS' => true]);
            })
            ->first();
        return $avg['avg'];
    }

    public function computeAvgLitterSize($options = []) {
        $model = FactoryLocator::get('Table')->get('Litters');

        $filter = [];
        if (! empty($options)) {
            $filter = array_merge($filter, $options);
        }

        $avg = $model->find()
            ->select([
                'avg' => 'AVG(pups_number)',
                'Litters__id' => 'Litters.id',
                'Litters__state_id' => 'Litters.state_id',
            ])
            ->leftJoinWith('Contributions')
            ->innerJoinWith('Contributions.Ratteries', function ($q) {
                return $q->where(['Ratteries.is_generic IS' => false]);
            })
            ->innerJoinWith('States', function ($q) {
                return $q->where(['is_reliable IS' => true]);
            })
            ->where($filter)
            ->first();

        return round(floatval($avg['avg']), 1);
    }

    public function computeLitterSexes($options = [])
    {
        $query = FactoryLocator::get('Table')->get('Litters')
            ->find()
            ->where($options)
            ->innerJoinWith('OffspringRats');

        if (! isset($options['litter_id'])) {
            $query = $query
                ->innerJoinWith('OffspringRats.Ratteries', function ($q) {
                    return $q->where(['Ratteries.is_generic IS' => false]);
                })
                ->innerJoinWith('States', function ($q) {
                    return $q->where(['is_reliable IS' => true]);
                });
        }
        // always exclude non visible, even on litter sheet?
        // else { // FIXME use is_visible instead
        //     $query = $query->where(['OffspringRats.state_id !=' => 7]);
        // }

        $females = $query->newExpr()->case()->when(['sex' => 'F'])->then(1, 'integer');
        $males = $query->newExpr()->case()->when(['sex' => 'M'])->then(1, 'integer');

        $query = $query
            ->select([
                'litter_id' => 'OffspringRats.litter_id',
                'Litters__state_id' => 'Litters.state_id',
                'F' => $query->func()->count($females),
                'M' => $query->func()->count($males)
            ])
            ->group('litter_id');

        return $query->enableHydration(false);
    }

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

        if ($valid_litters_count > 0) {
            $avg_male_proportion = $male_proportion_sum/$valid_litters_count;
            $avg_female_proportion = 1 - $avg_male_proportion;
            if ($avg_female_proportion == 0) {
                return -2;
            } else {
                return $avg_male_proportion/$avg_female_proportion;
            }
        } else {
            return -1;
        }
    }

    public function computeLitterSexRatioInWords($options = [], $max_denominator = 10, $sex_ratio = null) {
        if (is_null($sex_ratio)) {
            $sex_ratio = round($this->computeLitterSexRatio($options), 3);
        }

        if ($sex_ratio == -2) {
            return __('Only females');
        }

        if ($sex_ratio == -1) {
            return __('N/A');
        }

        if ($sex_ratio == 0) {
            return __('Only males');
        }

        if ($sex_ratio >= 1) {
            $operands = $this->computeFareyApproximation($sex_ratio, $max_denominator);
            return __('{0, number} (about {1, plural, =1{1 male} other{# males}} for {2, plural, =1{1 female} other{# females}})', [$sex_ratio, $operands[0], $operands[1]]);
        } else {
            $inverse_ratio = round(1/$sex_ratio,2);
            $operands = $this->computeFareyApproximation($inverse_ratio, $max_denominator);
            return __('{0, number} (about {1, plural, =1{1 female} other{# females}} for {2, plural, =1{1 male} other{# males}})', [$sex_ratio, $operands[0], $operands[1]]);
        }
    }

    // output format should be changed to match that of LitterSizeDistribution?
    public function computeLitterSexDistribution($sex) {
        $histogram = $this->computeLitterSexes()->toArray();
        $histogram = array_count_values(array_column($histogram, $sex['sex']));
        return $histogram;
    }

    public function computeLitterSexDifferenceDistribution() {
        $histogram = $this->computeLitterSexes()->toArray();

        foreach ($histogram as &$entry) {
            $entry['diff'] = $entry['M'] - $entry['F'];
        }

        $histogram = array_count_values(array_column($histogram, 'diff'));
        ksort($histogram);
        return $histogram;
    }

    public function computeLitterSizeDistribution($options = []) {
        $model = FactoryLocator::get('Table')->get('Litters');

        $filter = [];
        if (! empty($options)) {
            $filter = array_merge($filter,$options);
        }

        $histogram = $model->find()
            ->select([
                'size' => 'pups_number',
                'count' => 'COUNT(Litters.id)',
                'Litters__id' => 'Litters.id',
                'Litters__state_id' => 'Litters.state_id',
            ])
            ->innerJoinWith('Contributions.Ratteries', function ($q) {
                return $q->where(['Ratteries.is_generic IS' => false]);
            })
            ->innerJoinWith('States', function ($q) {
                return $q->where(['is_reliable IS' => true]);
            })
            ->group('size')
            ->order(['size' => 'ASC']);

        return $histogram->all()->combine('size', 'count');
    }

    public function computeLifespan($options = [], $having = null) {
        $model = FactoryLocator::get('Table')->get('Rats');

        $filter = [
            'is_alive IS' => false,
            'birth_date IS NOT' => null,
            'death_date IS NOT' => null,
            'birth_date !=' => '1981-08-01',
            'death_date !=' => '1981-08-01',
            'OR' => [
                'death_secondary_cause_id !=' => '1',
                'death_secondary_cause_id IS' => null,
            ]
        ];

        if (! empty($options)) {
            $filter = array_merge($filter,$options);
        }

        $lifespan = $model
            ->find()
            ->contain(['DeathPrimaryCauses'])
            ->where($filter);

        // for singularities (many to many associations, cannot be filtered through where(options))
        if (! is_null($having) && isset($having['singularity'])) {
            $value = $having['singularity']; // singularity->id
            $lifespan
                ->matching('Singularities', function ($q) use ($value) {
                    return $q->where(['Singularities.id' => $value]);
                });
        }

        // exclude unreliable sheets everywhere but on user personal stats
        if (! isset($options['owner_user_id']) && ! isset($options['Rats.litter_id'])) {
            $lifespan->innerJoinWith('States', function ($q) {
                return $q->where(['States.is_reliable IS' => true]);
            });
        }

        $lifespan = $lifespan
            ->select([
                'Rats__id' => 'Rats.id',
                'Rats__state_id' => 'Rats.state_id',
                'lifespan' => 'ROUND(AVG(DATEDIFF(death_date,birth_date)))'
            ])
            ->where([
                'DATEDIFF(death_date,birth_date) >=' => 0, // legacy data with negative age
                'DATEDIFF(death_date,birth_date) <' => RatsTable::MAXIMAL_AGE,
            ]);
        return $lifespan;
    }

    //FIXME: cut-off should be completely softcoded!
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

    public function roundLifespan($options = [], $having = null) {
        $lifespan = $this->computeLifespan($options, $having)->first();
        return $lifespan['lifespan'] == 0 ? __('N/A') : round($lifespan['lifespan']/30.5,1);
    }

    public function computeAgeDistribution($options = []) {
        $model = FactoryLocator::get('Table')->get('Rats');

        $filter = [
            'is_alive IS' => true,
            'birth_date IS NOT' => null,
            'birth_date !=' => '1981-08-01'
        ];

        if (! empty($options)) {
            $filter = array_merge($filter, $options);
        }

        $pyramid = $model
            ->find()
            ->where($filter)
            ->innerJoinWith('States', function ($q) {
                return $q->where(['is_reliable IS' => true]);
            });

        $pyramid = $pyramid
            ->select([
                'Rats__state_id' => 'Rats.state_id',
                'months' => 'FLOOR(DATEDIFF(NOW(),birth_date)/30.5)',
                'count' => 'COUNT(Rats.id)'
            ])
            ->where([
                'DATEDIFF(NOW(),birth_date) >=' => '0',
                'DATEDIFF(NOW(),birth_date) <' => RatsTable::MAXIMAL_AGE
            ])
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
            'birth_date !=' => '1981-08-01',
            'death_date !=' => '1981-08-01',
            'OR' => [
                'death_secondary_cause_id !=' => '1',
                'death_secondary_cause_id IS' => null,
            ],
            'death_primary_cause_id !=' => '6'
        ];

        if (! empty($options)) {
            $filter = array_merge($filter,$options);
        }

        $mortality = $model
            ->find()
            ->contain(['DeathPrimaryCauses'])
            ->where($filter)
            ->innerJoinWith('States', function ($q) {
                return $q->where(['is_reliable IS' => true]);
            });

        $mortality = $mortality
            ->select([
                'Rats__state_id' => 'Rats.id',
                'months' => 'FLOOR(DATEDIFF(death_date,birth_date)/30.5)',
                'count' => 'COUNT(Rats.id)'
            ])
            ->where([
                'DATEDIFF(death_date,birth_date) >=' => '0',
                'DATEDIFF(death_date,birth_date) <' => RatsTable::MAXIMAL_AGE
            ])
            ->group('months')
            ->order(['months' => 'ASC']);

        return $mortality;
    }

    public function computeSurvivalRate($mortality_distribution = [], $options = []) {

        if(empty($mortality_distribution)) {
            $mortality_distribution = $this->computeMortalityDistribution($options)
                ->enableHydration(false)
                ->toArray();
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

    public function computeMortalityRate($mortality_distribution = [], $options = []) {

        if(empty($mortality_distribution)) {
            $mortality_distribution = $this->computeMortalityDistribution($options);
        }

        $max_months = count($mortality_distribution);
        $rate = $mortality_distribution;
        $total_deaths = array_sum(array_column($rate, 'count'));
        $starters = $total_deaths;
        for ($i=0; $i < $max_months; $i++) {
            $finishers = $starters-$mortality_distribution[$i]['count'];
            $rate[$i]['count'] = 100*(1-$finishers/$starters);
            $starters = $finishers;
        }
        return $rate;
    }

    public function computeDeathMedian($survival = [], $options = []) {
        if(empty($survival)) {
            $survival = $this->computeSurvivalRate($options);
        }

        $median = 0;
        foreach ($survival as $slot) {
            if ($slot['count'] >= 50) {
                $median = $slot['months'];
            }
        }
        return $median+1;
    }

    public function computeDeathPeak($distribution = [], $options = []) {
        if(empty($distribution)) {
            $distribution = $this->computeMortalityDistribution($options);
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

    public function computeDeathInterquartile($survival = [], $options = []) {
        if(empty($survival)) {
            $survival = $this->computeSurvivalRate($options);
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

    public function findChampion($options = []) {
        $model = FactoryLocator::get('Table')->get('Rats');

        $filter = [
            'Rats.is_alive IS' => false,
            'Rats.birth_date IS NOT' => null,
            'Rats.death_date IS NOT' => null,
            'Rats.birth_date !=' => '1981-08-01',
            'Rats.death_date !=' => '1981-08-01',
            'OR' => [
                'death_secondary_cause_id !=' => '1',
                'death_secondary_cause_id IS' => null
            ],
            'States.is_reliable IS' => true,
            'DATEDIFF(Rats.death_date,Rats.birth_date) <' => RatsTable::MAXIMAL_AGE
        ];

        if (! empty($options)) {
            $filter = array_merge($filter,$options);
        }

        $max = $model->find()
            ->select(['max' => 'MAX(DATEDIFF(Rats.death_date,Rats.birth_date))'])
            ->where($filter)
            ->innerJoinWith('Ratteries', function ($q) {
                return $q->where(['Ratteries.is_generic IS' => false]);
                })
            ->contain(['States'])
            ->first();

        $max = $max['max'];

        if (! is_null($max)) {
            $champion = $model->find()
                ->select([
                    'id' => 'Rats.id',
                    'Rats__state_id' => 'Rats.state_id'
                ])
                ->where(array_merge($filter,['DATEDIFF(Rats.death_date,Rats.birth_date) =' => $max]))
                ->innerJoinWith('Ratteries', function ($q) {
                    return $q->where(['Ratteries.is_generic IS' => false]);
                    })
                ->innerJoinWith('States', function ($q) {
                    return $q->where(['States.is_reliable IS' => true]);
                    })
                ->first();
        } else {
            $champion = null;
        }

        return $champion;
    }

    public function findChampions($options = [], $n = 1) {
        $model = FactoryLocator::get('Table')->get('Rats');

        $filter = [
            'Rats.is_alive IS' => false,
            'Rats.birth_date IS NOT' => null,
            'Rats.death_date IS NOT' => null,
            'Rats.birth_date !=' => '1981-08-01',
            'Rats.death_date !=' => '1981-08-01',
            'OR' => [
                'death_secondary_cause_id !=' => '1',
                'death_secondary_cause_id IS' => null
            ],
            'States.is_reliable IS' => true,
            'DATEDIFF(Rats.death_date,Rats.birth_date) <' => RatsTable::MAXIMAL_AGE
        ];

        if (! empty($options)) {
            $filter = array_merge($filter,$options);
        }

        $champions = $model->find()
            ->select([
                'id' => 'Rats.id',
                'rat_id' => 'Rats.id',
                'rat_age' => 'DATEDIFF(Rats.death_date,Rats.birth_date)',
                'birth_date' => 'Rats.birth_date',
                'death_date' => 'Rats.death_date',
                'name' => 'Rats.name',
                'Rats__litter_id' => 'BirthLitters.id',
                'BirthLitters__id' => 'BirthLitters.id',
                'Rats__rattery_id' => 'Rats.rattery_id',
                'Rats__state_id' => 'Rats.state_id',
            ])
            ->where($filter)
            ->innerJoinWith('Ratteries', function ($q) {
                return $q->where(['Ratteries.is_generic IS' => false]);
                })
            ->contain(['States', 'Ratteries', 'BirthLitters', 'BirthLitters.Contributions'])
            ->group('rat_id')
            ->order(['rat_age' => 'desc'])
            ->limit($n)
            ->all()
            ->toArray();

        return $champions;
    }

    public function findBornToday($options = []) {
        $model = FactoryLocator::get('Table')->get('Rats');

        $filter = [
            'Rats.is_alive IS' => true,
            'Rats.birth_date IS NOT' => null,
            'Rats.birth_date !=' => '1981-08-01',
            'States.is_reliable IS' => true,
            'DAY(Rats.birth_date) ' => 'DAY(GETDATE())',
            'MONTH(Rats.birth_date) ' => 'MONTH(GETDATE())',
        ];

        if (! empty($options)) {
            $filter = array_merge($filter,$options);
        }

        $query = $model->find()->contain(['States'])->where($filter);

        return $query;
    }

    /* UTILITIES */
    function computeFareyApproximation($val, $lim) {
        if ($val < 0) {
            list($n, $d) = $this->computeFareyApproximation(-$val, $lim);
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
