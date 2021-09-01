<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;

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
        return ($this->is_alive ? '' : ' 💤');
    }

    /* Statistics */

    protected function _getChampion() {
    /* should return usual name with double prefix instead of name */

        $candidate = null;
        $maxAge = 0;
        foreach($this->rats as $rat) {
            if (!$rat->is_alive & isset($rat->death_date) & ($rat->death_primary_cause_id != '1')) {
                if($rat->precise_age > $maxAge) {
                    $maxAge = $rat->precise_age;
                    $candidate = $rat;
                }
            }
        }

        if($candidate==null) {
            return $champion = ['id' => null, 'name' => 'Could not find champion', 'ageInWords' => ''];
        } else {
            return $champion = ['id' => $candidate->id, 'name' => $candidate->usual_name, 'ageInWords' => $candidate->champion_age_string];
        }
    }

    protected function _getRatStat() {
        $ratCount = count($this->rats);
        if($ratCount>0) {
            $femaleCount = 0;
            $maleCount = 0;
            foreach($this->rats as $rat) {
                if ($rat->sex==='M') {
                    $maleCount++;
                } else {
                    $femaleCount++;
                }
            }
            $stats = [
                'ratCount' => $ratCount,
                'femaleCount' => $femaleCount,
                'maleCount' => $maleCount,
                'femaleProportion' => round($femaleCount/$ratCount*100,1),
                'maleProportion' => round($maleCount/$ratCount*100,1),
            ];
        }
        else {
            $stats = [
                'ratCount' => 0,
                'femaleCount' => 0,
                'maleCount' => 0,
                'femaleProportion' => 0,
                'maleProportion' => 0,
            ];
        }
        return $stats;
    }

    protected function _getBreedingStat()
    {
        /* counter for activity stats, will be updated in appropriate loops later */
        $firstYear = FrozenTime::maxValue();
        $lastYear = FrozenTime::minValue();

        /* litter stats */
        $inLitter = 0;
        $outLitter = 0;
        $inRats = 0;
        $outRats = 0;

        foreach($this->litters as $litter)
        {
            if ($litter->contributions['0']->rattery_id == $this->id)
            {
                $inLitter++;
                $inRats += $litter->pups_number;
            } else {
                $outLitter++;
                $outRats += $litter->pups_number;
            }

            if($litter->has('birth_date')) { // for debug: this should not be possible
                if($litter->birth_date->lessThan($firstYear)) {
                    $firstYear = $litter->birth_date;
                }
                if($lastYear->lessThan($litter->birth_date)) {
                    $lastYear = $litter->birth_date;
                }
            }
        }
        $litterstats = [
            'inLitterCount' => $inLitter,
            'outLitterCount' => $outLitter,
            'inRatCount' => $inRats,
            'outRatCount' => $outRats,
        ];


        /* rat stats */
        $ratCount = count($this->rats);
        if($ratCount>0) {
            $femaleCount = 0;
            $maleCount = 0;
            foreach($this->rats as $rat) {
                if ($rat->sex==='M') {
                    $maleCount++;
                } else {
                    $femaleCount++;
                }
            }
            $stats = [
                'ratCount' => $ratCount,
                'femaleCount' => $femaleCount,
                'maleCount' => $maleCount,
                'femaleProportion' => round($femaleCount/$ratCount*100,1),
                'maleProportion' => round($maleCount/$ratCount*100,1),
            ];
        }
        else {
            $stats = [
                'ratCount' => 0,
                'femaleCount' => 0,
                'maleCount' => 0,
                'femaleProportion' => 0,
                'maleProportion' => 0,
            ];
        }

        // update activity years from rats birthdates when no recorded litter
        // (this should not happen since ratteries must have litters, but...)
        // if($outLitter==0) {
        foreach($this->rats as $rat) {
            if($rat->birth_date->lessThan($firstYear)) {
                $firstYear = $rat->birth_date;
            }
            if($lastYear->lessThan($rat->birth_date)) {
                $lastYear = $rat->birth_date;
            }
        }
        //}

        /* finalize activity stats */

        /* option 1 with diffInYears :
        * Needs to add one year to difference, which is "floored" instead of "ceiled" by diffInYears function
        * Needs also to treats plural and add "years" to final string
        *
        * $duration = $firstYear->diffInYears($lastYear)+1;
        * $plural = ( $duration > 1 ) ? 's' : '';
        * $activitystats['activityYears'] = $firstYear->year . '–' . $lastYear->year . ' (' . $duration . ' year' . $plural . ')';
        */

        /* option 2 with timeAgoInWords :
        * call to timeAgoInWords in the "wrong" date order to avoid "ago" to be added to the string
        */
        if(($inLitter+$outLitter)==1) {
            $activitystats['activityYears'] = $firstYear->year . ' (one-shot rattery)';
        } else {
            $duration = $lastYear->timeAgoInWords(['from' => $firstYear, 'accuracy' => ['year' => 'month', 'month => week', 'week' => 'week']]);
            if($firstYear->year==$lastYear->year) {
                $activitystats['activityYears'] = $firstYear->year . ' (' . $duration . ')';
            } else {
                $activitystats['activityYears'] = $firstYear->year . '–' . $lastYear->year . ' (' . $duration . ')';
            }
        }

        return $stats = array_merge($litterstats,$activitystats,$stats);
    }

    protected function _getHealthStat()
    {
        $breedingstats = $this->breeding_stat;

        /* counter for presumed dead rats */
        $lostRatCount = 0;

        /* counters for global lifespan (stillborn excluded) */
        $deadFCount = 0;
        $deadMCount = 0;
        $cumFAge = 0;
        $cumMAge = 0;

        /* counters for adult lifespan (infant mortality excluded) */
        $deadFCountAdult = 0;
        $deadMCountAdult = 0;
        $cumFAgeAdult = 0;
        $cumMAgeAdult = 0;

        /* counters for healthy lifespan (infant mortality and accidents excluded) */
        $deadFCountHealthy = 0;
        $deadMCountHealthy = 0;
        $cumFAgeHealthy = 0;
        $cumMAgeHealthy = 0;

        /* variables for death causes */
        /* death causes stats */
        /* death causes stats */
        $deathprimarystats = array();
        $deathsecondarystats = array();

        if($breedingstats['ratCount'] > 0) {
            foreach($this->rats as $rat) {
                // first, process rats who are lost and presumed dead
                if(
                    (!$rat->is_alive && !isset($rat->_fields['death_primary_cause']))
                    || (!$rat->is_alive && isset($rat->_fields['death_primary_cause']) && $rat->death_primary_cause_id == 1 && !isset($rat->_fields['death_secondary_cause']))
                    || (!$rat->is_alive && isset($rat->_fields['death_primary_cause']) && $rat->death_primary_cause_id == 1 && isset($rat->_fields['death_primary_cause']) && $rat->death_secondary_cause_id == 1)
                    || ($rat->is_alive && $rat->age>54)
                ) {
                    $lostRatCount++;
                } else {
                    if(!$rat->is_alive) {
                        if($rat->sex === 'M') {
                            $deadMCount++;
                            $cumMAge += $rat->precise_age;
                        } else {
                            $deadFCount++;
                            $cumFAge += $rat->precise_age;
                        }

                        // count only rats dead after weaning
                        // alternative condition: infant mortality : isset($rat->_fields['secondary_death_cause']) && $rat->death_secondary_cause['id'] != 30)
                        if ($rat->precise_age > 42) {
                            if($rat->sex === 'M') {
                                $deadMCountAdult++;
                                $cumMAgeAdult += $rat->precise_age;
                            } else {
                                $deadFCountAdult++;
                                $cumFAgeAdult += $rat->precise_age;
                            }
                        }

                        // exclude accidental death
                        if ($rat->precise_age > 42 && $rat->death_primary_cause_id != 2) {
                            if($rat->sex==='M') {
                                $deadMCountHealthy++;
                                $cumMAgeHealthy += $rat->precise_age;
                            } else {
                                $deadFCountHealthy++;
                                $cumFAgeHealthy += $rat->precise_age;
                            }
                        }

                        // update death causes counters
                        if(isset($rat->death_primary_cause)) {
                            if (isset($deathprimarystats[$rat->death_primary_cause->name])) {
                                $deathprimarystats[$rat->death_primary_cause->name]++;
                            } else {
                                $deathprimarystats[$rat->death_primary_cause->name] = 1;
                            }

                            if(isset($rat->death_secondary_cause)) {
                                if (isset($deathsecondarystats[$rat->death_secondary_cause->name])) {
                                    $deathsecondarystats[$rat->death_secondary_cause->name]++;
                                } else {
                                    $deathsecondarystats[$rat->death_secondary_cause->name] = 1;
                                }
                            // if secondary cause is not set, record primary cause as secondary
                            } else {
                                if (isset($deathsecondarystats[$rat->death_primary_cause->name])) {
                                    $deathsecondarystats[$rat->death_primary_cause->name]++;
                                } else {
                                    $deathsecondarystats[$rat->death_primary_cause->name] = 1;
                                }
                            }
                        }
                    }
                }
            }

            /* package results */
            $presumedDeadRatCount = $deadMCount+$deadFCount+$lostRatCount;
            $deadRatCount = $deadMCount+$deadFCount;
            $deadAdultCount = $deadMCountAdult+$deadFCountAdult;
            $deadHealthyCount = $deadMCountHealthy+$deadFCountHealthy;
            $healthstats = [
                'presumedDeadRatCount' => $presumedDeadRatCount,
                'deadRatCount' => $deadRatCount,
                'lostRatCount' => $lostRatCount,
                'deadRatProportion' => round($presumedDeadRatCount/$breedingstats['ratCount']*100,1),
                'deadRatAge' => 'N/A',
                'deadMaleCount' => $deadMCount,
                'deadMaleAge' => 'N/A',
                'deadFemaleCount' => $deadFCount,
                'deadFemaleAge' => 'N/A',
            ];

            if($deadRatCount>0) {
                $healthstats['deadRatAge'] = round(2*($cumMAge+$cumFAge)/$deadRatCount/30.5)/2;
                $healthstats['lostRatProportion'] = round($lostRatCount/$presumedDeadRatCount*100,1);
                $healthstats['followedRatProportion'] = 100-round($lostRatCount/$presumedDeadRatCount*100,1);
            } else {
                $healthstats['deadRatAge'] = 'N/A';
                $healthstats['lostRatProportion'] = 'N/A';
                $healthstats['followedRatProportion'] = 'N/A';
            }
            if($deadMCount>0) {
                $healthstats['deadMaleAge'] = round(2*$cumMAge/$deadMCount/30.5)/2;
            }
            if($deadFCount>0) {
                $healthstats['deadFemaleAge'] = round(2*$cumFAge/$deadFCount/30.5)/2;
            }

            if($deadAdultCount>0) {
                $healthstats['deadRatAgeAdult'] = round(2*($cumMAgeAdult+$cumFAgeAdult)/$deadAdultCount/30.5)/2;
            }
            if($deadMCountAdult>0) {
                $healthstats['deadMaleAgeAdult'] = round(2*$cumMAgeAdult/$deadMCountAdult/30.5)/2;
            }
            if($deadFCountAdult>0) {
                $healthstats['deadFemaleAgeAdult'] = round(2*$cumFAgeAdult/$deadFCountAdult/30.5)/2;
            }

            if($deadHealthyCount>0) {
                $healthstats['deadRatAgeHealthy'] = round(2*($cumMAgeHealthy+$cumFAgeHealthy)/$deadHealthyCount/30.5)/2;
            }
            if($deadMCountHealthy>0) {
                $healthstats['deadMaleAgeHealthy'] = round(2*$cumMAgeHealthy/$deadMCountHealthy/30.5)/2;
            }
            if($deadFCountHealthy>0) {
                $healthstats['deadFemaleAgeHealthy'] = round(2*$cumFAgeHealthy/$deadFCountHealthy/30.5)/2;
            }

            arsort($deathprimarystats);
            arsort($deathsecondarystats);

            $deathprimarystats = array_map(function($count) use ($deadRatCount){return round($count/$deadRatCount*100,1);},$deathprimarystats);
            $deathsecondarystats = array_map(function($count) use ($deadRatCount){return round($count/$deadRatCount*100,1);},$deathsecondarystats);

            $deathstats = [
                'deathPrimary' => $deathprimarystats,
                'deathSecondary' => $deathsecondarystats,
            ];

            $stats = array_merge($breedingstats,$healthstats,$deathstats);
            return $stats;
        }
        else {
            $healthstats = [
                'deadRatCount' => 0,
                'deadRatProportion' => 'N/A',
                'deadRatAge' => 'N/A',
                'deadMaleCount' => 'N/A',
                'deadMaleAge' => 'N/A',
                'deadFemaleCount' => 'N/A',
                'deadFemaleAge' => 'N/A',
                'deadRatAgeAdult' => 'N/A',
                'deadMaleCountAdult' => 'N/A',
                'deadMaleAgeAdult' => 'N/A',
                'deadFemaleCountAdult' => 'N/A',
                'deadFemaleAgeAdult' => 'N/A',
                'deadRatAgeHealthy' => 'N/A',
                'deadMaleCountHealthy' => 'N/A',
                'deadMaleAgeHealthy' => 'N/A',
                'deadFemaleCountHealthy' => 'N/A',
                'deadFemaleAgeHealthy' => 'N/A',
            ];
        }

        $stats = array_merge($breedingstats,$healthstats);
        return $stats;
    }
}
