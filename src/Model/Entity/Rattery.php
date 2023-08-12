<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;
use Cake\Collection\Collection;
use Cake\Datasource\FactoryLocator;
use Cake\Utility\Inflector;
use App\Model\Entity\StatisticsTrait;
use App\Model\Table\RatsTable;

/**
 * Rattery Entity
 *
 * @property int $id
 * @property string $prefix
 * @property string $name
 * @property int $owner_user_id
 * @property string|null $birth_year
 * @property bool $is_alive
 * @property bool $is_generic
 * @property string|null $district
 * @property string|null $zip_code
 * @property int $country_id
 * @property string|null $website
 * @property string|null $comments
 * @property bool $wants_statistic
 * @property string $picture
 * @property int $state_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Conversation[] $conversations
 * @property \App\Model\Entity\Rat[] $rats
 * @property \App\Model\Entity\RatterySnapshot[] $rattery_snapshots
 * @property \App\Model\Entity\Litter[] $litters
 */
class Rattery extends Entity
{
    use StatisticsTrait;

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'prefix' => true,
        'name' => true,
        'owner_user_id' => true,
        'birth_year' => true,
        'is_alive' => true,
        'is_generic' => true,
        'district' => true,
        'zip_code' => true,
        'country_id' => true,
        'website' => true,
        'comments' => true,
        'wants_statistic' => true,
        'picture' => true,
        'state_id' => true,
        'created' => true,
        'modified' => true,
        'latitude' => true,
        'longitude' => true,
        'user' => true,
        'country' => true,
        'state' => true,
        'conversations' => true,
        'rats' => true,
        'rattery_snapshots' => true,
        'litters' => true,
    ];

    protected function _getFullName()
    {
        return $this->prefix . ' – ' . $this->name;
    }

    protected function _getIsAliveSymbol()
    {
        return ($this->is_alive ? '☼' : ' ☾ ');
    }

    protected function _getNextAliveSymbol()
    {
        return ($this->is_alive ? ' ☾ ' : '☼');
    }

    // different from the previous; shows a symbol only if ratterie is inactive
    protected function _getIsInactiveSymbol()
    {
        // moon is preceded with a non breakable fine space, do not edit!
        return ($this->is_alive ? '' : ' ☾');
    }

    protected function _getCountryName()
    {
        return $this->country->name;
    }

    // /* Rule : active rattery = litter born in the last 2 years */
    // public function coherentActivityState() {
    //     $litters = $this->bred_litters
    //     foreach ($this->offspring_rats as $rat) {
    //         $rat->birth_date = $this->birth_date;
    //         if (! $rats->save($rat, ['checkrules' => false, 'atomic' => false])) {
    //             return false;
    //         }
    //     }
    //     $rats->addBehavior('State');
    //     return true;
    // }

    // /* Rule : one active rattery per user */
    // public function checkSisters()
    // {
    //     $ratteries = FactoryLocator::get('Table')->get('ratteries');
    //     $owner_id = $this->owner_user_id;
    //     $sisters = $ratteries->find('ownedById', ['users' => $owner_id]);
    //
    //     if ($this->is_alive) {
    //         foreach ($sisters as $sister) {
    //             if ($sister->user_id == $this->owner_id) {
    //                 $ratteries->removeBehavior('State');
    //                 $sister->is_alive = false;
    //                 if (! $ratteries->save($sister, ['checkrules' => false, 'atomic' => false])) {
    //                     $ratteries->addBehavior('State');
    //                     return false;
    //                 }
    //                 $ratteries->addBehavior('State');
    //             }
    //         }
    //     }
    //     return true;
    // }

    /* Statistics */

    public function wrapStatistics() {
        $stats['inLitterCount'] = $this->countContributions(['rattery_id' => $this->id, 'contribution_type_id' => '1']);
        $stats['outLitterCount'] = $this->countContributions(['rattery_id' => $this->id, 'contribution_type_id >' => '1']);

        $stats['inRatCount'] = $this->countPups(['rattery_id' => $this->id, 'contribution_type_id' => '1']);;
        $stats['outRatCount'] = $this->countPups(['rattery_id' => $this->id, 'contribution_type_id >' => '1']);;

        $stats['ratCount'] = $this->countMy('Rats', 'rattery');
        $stats['femaleCount'] = $this->countRats(['rattery_id' => $this->id, 'sex' => 'F']);
        $stats['maleCount'] = $this->countRats(['rattery_id' => $this->id, 'sex' => 'M']);

        if (! $this->is_generic) {
            $stats['activityYears'] = $this->lifetimeInWords(['rattery_id' => $this->id], $stats['inLitterCount']+$stats['outLitterCount']);
        }

        if ($stats['ratCount'] != 0) {
            $stats['femaleProportion'] = 100 * round($stats['femaleCount'] / $stats['ratCount'], 3);
            $stats['maleProportion'] = 100 * round($stats['maleCount'] / $stats['ratCount'], 3);
            $stats['presumedDeadRatCount'] = $this->countRats([
                'rattery_id' => $this->id,
                'OR' => [
                    'is_alive IS' => false,
                    'DATEDIFF(NOW(), birth_date) >' => RatsTable::MAXIMAL_AGE
                ]
            ]);
            $stats['deadRatProportion'] = round(100*$stats['presumedDeadRatCount'] / $stats['ratCount'], 1);
            $stats['deadRatCount'] = $this->countRats([
                'rattery_id' => $this->id,
                'is_alive IS' => false,
                'OR' => [
                    'death_secondary_cause_id !=' => '1',
                    'AND' => [
                        'death_primary_cause_id !=' => '1',
                        'death_secondary_cause_id IS' => null
                    ]
                ]
            ]);
            if ($stats['presumedDeadRatCount'] > 0) {
                $stats['followedRatProportion'] = round(100*$stats['deadRatCount'] / $stats['presumedDeadRatCount'], 1);
                $stats['lostRatCount'] = $stats['presumedDeadRatCount'] - $stats['deadRatCount'];
                $stats['lostRatProportion'] = round(100*$stats['lostRatCount'] / $stats['presumedDeadRatCount'], 1);
            } else {
                $stats['followedRatProportion'] = 100;
                $stats['lostRatCount'] = 0;
                $stats['lostRatProportion'] = 100;
            }

            $stats['deadRatAge'] = $this->roundLifespan(['rattery_id' => $this->id]);
            $stats['deadFemaleAge'] = $this->roundLifespan(['rattery_id' => $this->id,'sex' => 'F']);
            $stats['deadMaleAge'] = $this->roundLifespan(['rattery_id' => $this->id,'sex' => 'M']);

            $stats['deadRatAgeAdult'] = $this->roundLifespan(['rattery_id' => $this->id, 'DeathPrimaryCauses.is_infant IS' => false]);
            $stats['deadFemaleAgeAdult'] = $this->roundLifespan(['rattery_id' => $this->id, 'sex' => 'F', 'DeathPrimaryCauses.is_infant IS' => false]);
            $stats['deadMaleAgeAdult'] = $this->roundLifespan(['rattery_id' => $this->id, 'sex' => 'M', 'DeathPrimaryCauses.is_infant IS' => false]);

            $stats['deadRatAgeHealthy'] = $this->roundLifespan(['rattery_id' => $this->id, 'DeathPrimaryCauses.is_infant IS' => false, 'DeathPrimaryCauses.is_accident IS' => false]);
            $stats['deadFemaleAgeHealthy'] = $this->roundLifespan(['rattery_id' => $this->id, 'sex' => 'F', 'DeathPrimaryCauses.is_infant IS' => false, 'DeathPrimaryCauses.is_accident IS' => false]);
            $stats['deadMaleAgeHealthy'] = $this->roundLifespan(['rattery_id' => $this->id, 'sex' => 'M', 'DeathPrimaryCauses.is_infant IS' => false, 'DeathPrimaryCauses.is_accident IS' => false]);

        } else {
            $stats['femaleProportion'] = __('N/A');
            $stats['maleProportion'] = __('N/A');
            $stats['deadRatCount'] = 0;
        }

        if (! $this->is_generic) {
            $stats['avg_mother_age'] = $this->computeAvgMotherAge(['Contributions.rattery_id' => $this->id]);
            $stats['avg_father_age'] = $this->computeAvgFatherAge(['Contributions.rattery_id' => $this->id]);
            $stats['avg_litter_size'] = $this->computeAvgLitterSize(['Contributions.rattery_id' => $this->id]);
            $stats['debiased_avg_litter_size'] = $this->computeAvgLitterSize(['Contributions.rattery_id' => $this->id, 'pups_number >=' => '6', 'pups_number <=' => '16']);

            // load copy of the rattery with all litters ($this is limited to the 10 most recent litters)
            $rattery_id = $this->id;
            $copy = \Cake\Datasource\FactoryLocator::get('Table')->get('Ratteries')->get($this->id, ['contain' => ['Litters']]);
            $avg_sex_ratio = (new Collection($copy->litters))
                ->map(function ($value, $key) use ($rattery_id) {
                    return $value->computeLitterSexRatio(['litter_id' => $value->id]);
                })
                ->avg();

            $stats['avg_sex_ratio'] = $this->computeLitterSexRatioInWords([], 10, $avg_sex_ratio);

            $stats['primaries'] = $this->countRatsByPrimaryDeath(['rattery_id' => $this->id])->toArray();
            $stats['secondaries'] = $this->countRatsBySecondaryDeath(['rattery_id' => $this->id]);
            $stats['tumours'] = $this->countRatsByTumour()->toArray(['rattery_id' => $this->id]);
        }

        return $stats;
    }

    public function lifetimeInWords($options = [], $productivity = []) {
        $model = FactoryLocator::get('Table')->get('Contributions');

        //FIXME: use $rattery->is_generic
        $filter = ['rattery_id >' => 6, 'rattery_id' => $this->id];

        if(!empty($options)) {
            $filter = array_merge($filter,$options);
        }

        $lifetimes = $model->find()
            ->select([
                'first_birth' => 'MIN(Litters.birth_date)',
                'last_birth' => 'MAX(Litters.birth_date)',
            ])
            ->innerJoinWith('Litters')
            ->where($filter)
            ->enableAutoFields(true) // should be replaced by selecting only useful fields
            ->first();

        if (empty($productivity)) {
            $productivity = $this->countLitters($options, false);
        }

        if (is_null($lifetimes['first_birth'])) {
            return __('N/A');
        } else {
            $first_birth = FrozenTime::createFromFormat('Y-m-d', $lifetimes['first_birth']);
            $last_birth = FrozenTime::createFromFormat('Y-m-d', $lifetimes['last_birth']);

            if($productivity==1) {
                $lifetime = $first_birth->year . __(' (one-shot rattery)');
            } else {
                $duration = $last_birth->timeAgoInWords(['from' => $first_birth, 'accuracy' => ['year' => 'month', 'month => week', 'week' => 'week']]);
                if($first_birth->year == $last_birth->year) {
                    $lifetime = $first_birth->year . ' (' . $duration . ')';
                } else {
                    $lifetime = $first_birth->year . '–' . $last_birth->year . ' (' . $duration . ')';
                }
            }

            return $lifetime;
        }
    }

    protected function _getLastSnapshotId()
    {
        if (! empty($this->rattery_snapshots)) {
            return $this->rattery_snapshots['0']->id;
        }
    }

    public function buildFromSnapshot($id)
    {
        $snap_rattery = new Rattery();
        $snap_diffs = FactoryLocator::get('Table')->get('Ratteries')->snapCompare($this, $id);
        $properties = $this->_fields;

        foreach ($properties as $key => $value) {
            if (in_array($key, array_keys($snap_diffs))) {
                // if different key is a foreign key to a contained association, fetch and replace the latter
                if (substr($key, -3) == '_id') {
                    $association = substr($key, 0, -3);
                    if (! empty($association)) {
                        if ($this->has($association)) {
                            $tableName = $this->$association->getSource();
                            $table = FactoryLocator::get('Table')->get($tableName);
                            $snap_rattery->set($association, $table->get($snap_diffs[$key]));
                        } else {
                            $tableName = Inflector::pluralize(Inflector::classify($association));
                            if (TableRegistry::getTableLocator()->exists($tableName)) {
                                $table = FactoryLocator::get('Table')->get($tableName);
                                $snap_rattery->set($association, $table->get($snap_diffs[$key]));
                            }
                        }
                    }
                }
                // in any case, replace the key
                $snap_rattery->set($key, $snap_diffs[$key]);
            } else {
                // no difference between snap and rat, copy if and only if it is not an association
                // (associations where dealt with above)
                if (isset($this->$key)) {
                    $foreign_key = $key . '_id';
                    if (! in_array($foreign_key, array_keys($snap_diffs))) {
                        $snap_rattery->set($key, $value);
                    }
                }
            }
        }

        // // recast dates from string to dates
        // if (in_array('birth_date', array_keys($snap_diffs)) && $snap_rat->has('birth_date')) {
        //     $snap_rat->set('birth_date', FrozenTime::createFromFormat('Y-m-d', $snap_rat->birth_date));
        // }
        //
        // if (in_array('death_date', array_keys($snap_diffs)) && $snap_rat->has('death_date')) {
        //     $snap_rat->set('death_date', FrozenTime::createFromFormat('Y-m-d', $snap_rat->death_date));
        // }

        return $snap_rattery;
    }
}
