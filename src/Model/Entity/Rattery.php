<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use Cake\Datasource\FactoryLocator;
use App\Model\Entity\StatisticsTrait;

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
        // dagger is preceded with a non breakable fine space, do not edit!
        return ($this->is_alive ? ' ☼' : ' ☾');
    }

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
                    'DATEDIFF(NOW(), birth_date) >' => '1645'
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
            $stats['femaleProportion'] = 'N/A';
            $stats['maleProportion'] = 'N/A';
            $stats['deadRatCount'] = 0;
        }

        if (! $this->is_generic) {
            $stats['avg_mother_age'] = $this->computeAvgMotherAge(['Contributions.rattery_id' => $this->id]);
            $stats['avg_father_age'] = $this->computeAvgFatherAge(['Contributions.rattery_id' => $this->id]);
            $stats['avg_litter_size'] = $this->computeAvgLitterSize(['Contributions.rattery_id' => $this->id]);
            $stats['debiased_avg_litter_size'] = $this->computeAvgLitterSize(['Contributions.rattery_id' => $this->id, 'pups_number >=' => '6', 'pups_number <=' => '16']);

            // Currently compute at the rat-level. Switch to litter-level?
            $stats['avg_sex_ratio'] = $this->computeRatSexRatioInWords([
                'OR' => [
                    'Contributions.rattery_id' => $this->id,
                    'Rats.rattery_id' => $this->id // for rats with rattery_id but no litter_id
                ]], 12);

            $stats['primaries'] = $this->countRatsByPrimaryDeath(['rattery_id' => $this->id])->toArray();
            $stats['secondaries'] = $this->countRatsBySecondaryDeath(['rattery_id' => $this->id]);
            $stats['tumours'] = $this->countRatsByTumour()->toArray(['rattery_id' => $this->id]);
        }

        return $stats;
    }

    public function lifetimeInWords($options = [], $productivity = []) {
        $model = FactoryLocator::get('Table')->get('Contributions');

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
            $productivity = $this->countLitters($options);
        }

        if (is_null($lifetimes['first_birth'])) {
            return 'N/A';
        } else {
            $first_birth = FrozenTime::createFromFormat('Y-m-d', $lifetimes['first_birth']);
            $last_birth = FrozenTime::createFromFormat('Y-m-d', $lifetimes['last_birth']);

            if($productivity==1) {
                $lifetime = $first_birth->year . ' (one-shot rattery)';
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
}
