<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use Cake\ORM\Locator\LocatorAwareTrait;
use App\Model\Entity\StatisticsTrait;

/**
 * Litter Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate|null $mating_date
 * @property \Cake\I18n\FrozenDate $birth_date
 * @property int $pups_number
 * @property int|null $pups_number_stillborn
 * @property string|null $comments
 * @property int $creator_user_id
 * @property int $state_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Conversation[] $conversations
 * @property \App\Model\Entity\LitterSnapshot[] $litter_snapshots
 * @property \App\Model\Entity\Rat[] $parent_rats
 * @property \App\Model\Entity\Rattery[] $ratteries
 */
class Litter extends Entity
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
        'mating_date' => true,
        'birth_date' => true,
        'pups_number' => true,
        'pups_number_stillborn' => true,
        'comments' => true,
        'creator_user_id' => true,
        'state_id' => false,
        'created' => true,
        'modified' => true,
        'user' => true,
        'state' => true,
        'conversations' => true,
        'litter_snapshots' => true,
        'parent_rats' => true,
        'ratteries' => true,
        'contributions' => true,
    ];

    protected function _getFullName()
    {
        $date = isset($this->birth_date) ? $this->birth_date->i18nFormat('dd/MM/yyyy') : '??/??/????';
        $fullname = $date . ' – ' . $this->dam[0]->usual_name;
        if (isset ($this->sire[0])) {
            $fullname .= ' × ' . $this->sire[0]->usual_name;
        }
        return $fullname;
    }

    protected function _getNameFromSire()
    {
        $date = isset($this->birth_date) ? $this->birth_date->i18nFormat('dd/MM/yyyy') : '??/??/????';
        $partname = $date . ' – ' . $this->pups_number . ' pups';
        if (isset ($this->dam[0]) && $this->dam[0]['name'] != 'Mère inconnue') {
            $partname .= ' with ' . $this->dam[0]->usual_name;
        } else {
            $partname .= ' with unknown mother';
        }
        return $partname;
    }

    protected function _getNameFromDam()
    {
        $date = isset($this->birth_date) ? $this->birth_date->i18nFormat('dd/MM/yyyy') : '??/??/????';
        $partname = $date . ' – ' . $this->pups_number . ' pups';
        if (isset ($this->sire[0]) && $this->sire[0]['name'] != 'Père inconnu') {
            $partname .= ' with ' . $this->sire[0]->usual_name;
        } else {
            $partname .= ' with unknown father';
        }
        return $partname;
    }

    protected function _getSireAge() // now with litter birth date, should be with mating date?
    {
        if (isset($this->birth_date)) {
            $agedate = $this->birth_date;
            return $agedate->diffInDays($this->sire[0]->birth_date, true);
        } else { // should raise exception
            return __('Unknown');
            //return (1 + $agedate->diffInMonths($this->sire[0]->birth_date, true)) . ' months (estimated)';
        }
    }

    protected function _getSireAgeInMonths() // now with litter birth date, should be with mating date?
    {
        if (isset($this->birth_date)) {
            $agedate = $this->birth_date;
            return $agedate->diffInMonths($this->sire[0]->birth_date, true) .' months';
        } else { // should raise exception
            return __('Unknown');
            //return (1 + $agedate->diffInMonths($this->sire[0]->birth_date, true)) . ' months (estimated)';
        }
    }

    protected function _getDamAge() // now with litter birth date, should be with mating date?
    {
        if (isset($this->birth_date)) {
            $agedate = $this->birth_date;
            return $agedate->diffInDays($this->dam[0]->birth_date, true);
        } else { // should raise exception
            return 0;
            //return (1 + $agedate->diffInMonths($this->sire[0]->birth_date, true)) . ' months (estimated)';
        }
    }

    protected function _getDamAgeInMonths() // now with litter birth date, should be with mating date?
    {
        if (isset($this->birth_date)) {
            $agedate = $this->birth_date;
            return $agedate->diffInMonths($this->dam[0]->birth_date, true) .' months';
        } else { // should raise exception
            return __('Unknown');
            //return (1 + $agedate->diffInMonths($this->sire[0]->birth_date, true)) . ' months (estimated)';
        }
    }

    protected function _getMaxAge()
    {
        if (isset($this->birth_date)) {
            $agedate = $this->birth_date;
            return $agedate->diffInMonths();
        } else { // should raise exception
            return -1;
        }
    }

    protected function _getMaxAgeInWords()
    {
        if (isset($this->birth_date)) {
            $agedate = $this->birth_date;
            return $agedate->diffInMonths() .' months';
        } else { // should raise exception
            return __('Unknown');
        }
    }

    protected function _getInbreedingCoefficient()
    {

    }

    /* rules */

    public function hasBirthPlace()
    {
        return (! is_null($this->contributions['0']->rattery_id)) && ($this->contributions['0']->rattery_id != 0);
    }

    public function hasMother()
    {
        if(! empty($this->parent_rats)) {
            foreach($this->parent_rats as $parent) {
                if ($parent['sex'] == 'F') {
                    return true;
                }
            }
        }
        return false;
    }

    public function hasFather()
    {
        if(! empty($this->parent_rats)) {
            foreach($this->parent_rats as $parent) {
                if ($parent['sex'] == 'M') {
                    return true;
                }
            }
        }
        return false;
    }

    public function hasRealFather()
    {
        // should check if the declared father has a real ID
        return true;
    }

    public function isBornFuture()
    {
        return $this->birth_date->isFuture();
    }

    public function isAbnormalPregnancy()
    // normal pregnancy duration are taken from AFRMA sheets
    // superfetation is not allowed now
    // we could authorize up to 45 days if mother had a litter recently
    {
        return (
            $this->has('mating_date')
            &&
            (
                $this->mating_date->diffInDays($this->birth_date, false) < 20
                || $this->mating_date->diffInDays($this->birth_date, false) > 25
            )
        );
    }

    public function wasBornMother() {
        if(! empty($this->parent_rats)) {
            foreach($this->parent_rats as $parent) {
                if ($parent['sex'] == 'F') {
                    return $this->birth_date->gte($parent['birth_date']);
                }
            }
        }
        return true;
    }

    public function wasBornFather() {
        if(! empty($this->parent_rats)) {
            foreach($this->parent_rats as $parent) {
                if ($parent['sex'] == 'M') {
                    return $this->birth_date->gte($parent['birth_date']);
                }
            }
        }
        return true;
    }

    public function wasAliveMother() {
        if(! empty($this->parent_rats)) {
            foreach($this->parent_rats as $parent) {
                if ($parent['sex'] == 'F') {
                    return $parent['is_alive'] || $this->birth_date->lte($parent['death_date']);
                }
            }
        }
        return true;
    }

    public function wasAliveFather() {
        if(! empty($this->parent_rats)) {
            foreach($this->parent_rats as $parent) {
                if ($parent['sex'] == 'M') {
                    return $parent['is_alive'] || $this->birth_date->lte($parent['death_date']->addDays(25));
                }
            }
        }
        return true;
    }

    // parents are incompatible if one is dead before the other was born
    public function areCompatibleParents() {
        if(! empty($this->parent_rats)) {
            if(count($this->parent_rats) == 2) {
                $parent0 = $this->parent_rats['0'];
                $parent1 = $this->parent_rats['1'];
                return
                    ! (((! $parent0->is_alive) && $parent0->death_date->lte($parent1->birth_date))
                    || ((! $parent1->is_alive) && $parent1->death_date->lte($parent0->birth_date)));
            }
            return true;
        }
        return true;
    }

    /* Statistics */

    // survival rate in litter does not use StatisticsTrait because of right censoring
    public function computeIntermediateSurvivalRate($offsprings = []) {
        $total = $this->pups_number;
        $ages = [];
        $k_max = min([54, $this->max_age]);
        foreach($offsprings as $offspring) {
            array_push($ages, $offspring->age);
        }
        for ($k=0; $k<=$k_max; $k++) {
            $deaths = array_filter($ages, function ($age) use ($k) {
                return $age < $k;
            });
            $survival[$k]['months'] = $k;
            $survival[$k]['count'] = 100*round(1-count($deaths)/$total,2);
        }
        if ($k_max < 54) {
            for ($j=$k_max+1; $j<=54; $j++) {
                $survival[$j]['months'] = $j;
            }
        }
        return $survival;
    }

    public function wrapStatistics($offsprings) {
        // survival: could be cheaper if called on $litter->offsprings with trait in RatsTable?
        // or pass offsprings as optional argument?
        $stats['sexes'] = $this->computeLitterSexes(['litter_id' => $this->id])->toArray();

        $stats['max_age'] = $this->max_age_in_words;

        $stats['lifespan'] = $this->roundLifespan(['Rats.litter_id' => $this->id]);
        $stats['female_lifespan'] = $this->roundLifespan(['Rats.litter_id' => $this->id, 'Rats.sex' => 'F']);
        $stats['male_lifespan'] = $this->roundLifespan(['Rats.litter_id' => $this->id, 'Rats.sex' => 'M']);

        $stats['not_infant_lifespan'] = $this->roundLifespan(['Rats.litter_id' => $this->id, 'DeathPrimaryCauses.is_infant IS' => false]);
        $stats['female_not_infant_lifespan'] = $this->roundLifespan(['Rats.litter_id' => $this->id, 'Rats.sex' => 'F', 'DeathPrimaryCauses.is_infant IS' => false]);
        $stats['male_not_infant_lifespan'] = $this->roundLifespan(['Rats.litter_id' => $this->id, 'Rats.sex' => 'M', 'DeathPrimaryCauses.is_infant IS' => false]);

        $stats['not_accident_lifespan'] = $this->roundLifespan(['Rats.litter_id' => $this->id, 'DeathPrimaryCauses.is_infant IS' => false, 'DeathPrimaryCauses.is_accident IS' => false]);
        $stats['female_not_accident_lifespan'] = $this->roundLifespan(['Rats.litter_id' => $this->id, 'Rats.sex' => 'F', 'DeathPrimaryCauses.is_infant IS' => false, 'DeathPrimaryCauses.is_accident IS' => false]);
        $stats['male_not_accident_lifespan'] = $this->roundLifespan(['Rats.litter_id' => $this->id, 'Rats.sex' => 'M', 'DeathPrimaryCauses.is_infant IS' => false, 'DeathPrimaryCauses.is_accident IS' => false]);

        $stats['survivors'] = 100 * round($this->countMy('rats', 'litter', ['is_alive IS' => true])/$this->pups_number,2);
        $stats['survival'] = $this->computeIntermediateSurvivalRate($offsprings);

        return $stats;
    }

}
