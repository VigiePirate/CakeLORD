<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\FrozenTime;
//use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Collection\Collection;
use Cake\Datasource\FactoryLocator;
use App\Model\Entity\StatisticsTrait;
use App\Model\Table\LittersTable;
use App\Model\Table\RatsTable;

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
 * @property \App\Model\Entity\LitterMessage[] $litter_messages
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
        'litter_messages' => true,
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

    protected function _getParentsName()
    {
        if (isset ($this->dam[0])) {
            $name = $this->dam[0]->usual_name;
        } else {
            $name = __('Unknown mother');
        }

        if (isset ($this->sire[0])) {
            $name .= ' × ' . $this->sire[0]->usual_name;
        } else {
            $name .= ' × ' . __('Unknown father');
        }
        return $name;
    }

    protected function _getNameFromSire()
    {
        $date = isset($this->birth_date) ? $this->birth_date->i18nFormat('dd/MM/yyyy') : '??/??/????';
        $partname = $date . ' – ' . __('{0, plural, =1{1 pup} other{# pups}}', [$this->pups_number]);
        if (isset ($this->dam[0])) {
            $partname .= __(' with ') . $this->dam[0]->usual_name;
        } else {
            $partname .= __(' (unknown mother)');
        }
        return $partname;
    }

    protected function _getNameFromDam()
    {
        $date = isset($this->birth_date) ? $this->birth_date->i18nFormat('dd/MM/yyyy') : '??/??/????';
        $partname = $date . ' – ' . __('{0, plural, =1{1 pup} other{# pups}}', [$this->pups_number]);

        if (isset ($this->sire[0])) {
            $partname .= __(' with ') . $this->sire[0]->usual_name;
        } else {
            $partname .= __(' (unknown father)');
        }
        return $partname;
    }

    protected function _getSireAge() // now with litter birth date, should be with mating date?
    {
        if (isset($this->birth_date)) {
            $agedate = $this->birth_date;
            return $agedate->diffInDays($this->sire[0]->birth_date, true);
        } else { // should raise exception
            return 0;
        }
    }

    protected function _getSireAgeInMonths() // now with litter birth date, should be with mating date?
    {
        if (isset($this->birth_date)) {

            if ($this->sire[0]->id == 1) { // Unknown mother
                return __x('age', '– ?? –');
            }

            if ($this->sire_age <= 0) { // Should raise exception
                return $age = __('Negative age?!');
            }
            if ($this->sire_age > RatsTable::MAXIMAL_AGE) {
                return $age = '– ?? –';
            }

            $agedate = $this->birth_date;
            return __('{0, plural, =1{1 month} other{# months}}', [$agedate->diffInMonths($this->sire[0]->birth_date, true)]);
        } else { // should raise exception
            return __x('age', 'Unknown');
        }
    }

    protected function _getDamAge() // now with litter birth date, should be with mating date?
    {
        if (isset($this->birth_date)) {
            $agedate = $this->birth_date;
            return $agedate->diffInDays($this->dam[0]->birth_date, true);
        } else { // should raise exception
            return 0;
        }
    }

    protected function _getDamAgeInMonths() // now with litter birth date, should be with mating date?
    {
        if (isset($this->birth_date)) {
            if ($this->dam[0]->id == 1) { // Unknown mother
                return __x('age', '– ?? –');
            }
            if ($this->dam_age <= 0) { // Should raise exception
                return $age = __('Negative age?!');
            }
            if ($this->dam_age > RatsTable::MAXIMAL_AGE) {
                return $age = '– ?? –';
            }

            $agedate = $this->birth_date;
            return __('{0, plural, =1{1 month} other{# months}}', [$agedate->diffInMonths($this->dam[0]->birth_date, true)]);
        } else { // should raise exception
            return __x('age', 'Unknown');
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
            $now = \Cake\I18n\FrozenTime::now();
            //TODO: replace by age in human form: months weeks days etc.
            //return __('{0, plural, =0{<1 month} =1{1 month} other{# months}}', [$agedate->diffInMonths()]);
            return $now->timeAgoInWords(['from' => $agedate, 'accuracy' => ['year' => 'day']]);
        } else { // should raise exception
            return __x('age', 'Unknown');
        }
    }

    protected function _getReliablePupsNumber()
    {
        $total = count($this->offspring_rats);
        $offspring = new Collection($this->offspring_rats);
        $lost = $offspring->filter(function ($rat, $key) {
            return $rat->death_secondary_cause_id == '1';
        })->count();
        return ($total-$lost);
    }

    protected function _getLastSnapshotId()
    {
        if (! empty($this->litter_snapshots)) {
            return $this->litter_snapshots['0']->id;
        }
    }

    public function buildFromSnapshot($id)
    {
        $snap_litter = new Litter();
        $snap_diffs = FactoryLocator::get('Table')->get('Litters')->snapCompare($this, $id);
        $properties = $this->_fields;

        foreach ($properties as $key => $value) {
            if (in_array($key, array_keys($snap_diffs))) {
                // if $key is a foreign key to a contained association, fetch and replace the latter
                if (substr($key, -3) == '_id') {
                    $association = substr($key, 0, -3);
                    if (! empty($association)) {
                        if ($this->has($association)) {
                            $tableName = $this->$association->getSource();
                            $table = FactoryLocator::get('Table')->get($tableName);
                            if (! is_null($snap_diffs[$key])) {
                                $snap_litter->set($association, $table->get($snap_diffs[$key]));
                            }
                        } else {
                            $tableName = Inflector::pluralize(Inflector::classify($association));
                            if (TableRegistry::getTableLocator()->exists($tableName)) {
                                $table = FactoryLocator::get('Table')->get($tableName);
                                $snap_litter->set($association, $table->get($snap_diffs[$key]));
                            }
                        }
                    }
                }
                // in any case, replace the key
                $snap_litter->set($key, $snap_diffs[$key]);
            } else {
                // no difference between snap and litter, copy if and only if it is not an association
                // (associations where dealt with above)
                if (isset($this->$key)) {
                    $foreign_key = $key . '_id';
                    if (! in_array($foreign_key, array_keys($snap_diffs))) {
                        $snap_litter->set($key, $value);
                    }
                }
            }
        }

        // recast dates from string to dates
        if (in_array('birth_date', array_keys($snap_diffs)) && $snap_litter->has('birth_date')) {
            $snap_litter->set('birth_date', FrozenTime::createFromFormat('Y-m-d', $snap_litter->birth_date));
        }

        if (in_array('mating_date', array_keys($snap_diffs)) && $snap_litter->has('mating_date')) {
            $snap_litter->set('mating_date', FrozenTime::createFromFormat('Y-m-d', $snap_litter->mating_date));
        }

        return $snap_litter;
    }

    /* rules */

    public function hasBirthPlace()
    {
        return ! is_null($this->contributions) && ! is_null($this->contributions['0']->rattery_id);
    }

    public function hasActivableBirthPlace()
    {
        if (! is_null($this->contributions) && ! is_null($this->contributions['0']->rattery_id)) {
            $ratteries = \Cake\Datasource\FactoryLocator::get('Table')->get('Ratteries');
            $rattery = $ratteries->get($this->contributions['0']->rattery_id, ['contain' => ['Users', 'Users.Ratteries']]);

            if ($rattery->is_generic) {
                return true;
            } else {
                return ($rattery->id == $rattery->user->main_rattery->id);
            }
        }
        // the error has been or will be catched by rule "hasBirthPlace"
        else {
            return true;
        }
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

    public function hasValidOrigins()
    {
        if (is_null($this->contributions) || empty($this->contributions)) {
            return false;
        }

        if (! isset($this->contributions[0]->rattery)) {
            $ratteries = \Cake\Datasource\FactoryLocator::get('Table')->get('Ratteries');
            $this->contributions[0]->rattery = $ratteries->get($this->contributions[0]->rattery_id);
        }

        return ($this->contributions[0]->rattery->is_generic && ! empty($this->comments))
            || (! $this->contributions[0]->rattery->is_dam_required && ! empty($this->comments))
            || (! $this->contributions[0]->rattery->is_generic && ! empty($this->parent_rats));
    }

    public function isBornFuture()
    {
        return $this->birth_date->isFuture();
    }

    public function hasTooCloseSiblings()
    {
        $dam = (new Collection($this->parent_rats))->match(['sex' => 'F'])->toList();
        if (empty($dam)) {
            return false;
        }

        $concurrents = FactoryLocator::get('Table')->get('Litters')->find('fromBirthRange', [
            'birth_date' => $this->birth_date,
            'mother_id' => $dam[0]->id,
        ]);

        return ! empty($concurrents->toArray());
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
                    return $this->birth_date->greaterThanOrEquals($parent['birth_date']);
                }
            }
        }
        return true;
    }

    public function wasBornFather() {
        if(! empty($this->parent_rats)) {
            foreach($this->parent_rats as $parent) {
                if ($parent['sex'] == 'M') {
                    return $this->birth_date->greaterThanOrEquals($parent['birth_date']);
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

    // offspring of a litter must have the same birth dates
    public function homogeneizeBirthDates() {
        $rats = FactoryLocator::get('Table')->get('rats');
        $rats->removeBehavior('State');
        if (! is_null($this->offspring_rats)) {
            foreach ($this->offspring_rats as $rat) {
                $rat->birth_date = $this->birth_date;
                if (! $rats->save($rat, ['checkrules' => false, 'atomic' => false])) {
                    return false;
                }
            }
        }
        $rats->addBehavior('State');
        return true;
    }

    // offspring of a litter must have coherent prefix
    public function homogeneizePrefixes() {
        $rats = FactoryLocator::get('Table')->get('rats');
        if ($rats->hasBehavior('State')) {
            $rats->removeBehavior('State');
        }
        if (! is_null($this->offspring_rats)) {
            foreach ($this->offspring_rats as $rat) {
                $rat->rattery_id = $this->contributions['0']->rattery_id;
                $rat->is_pedigree_custom = true;
                if (! $rats->save($rat, ['checkrules' => false])) {
                    $rats->addBehavior('State');
                    return false;
                }
            }
        }
        $rats->addBehavior('State');
        return true;
    }

    // pup count cannot be lower than actual number of offspring
    public function checkPupCount() {
        if (! empty($this->offspring_rats)) {
            return $this->pups_number >= count($this->offspring_rats);
        } else {
            return true;
        }
    }

    public function checkStillbornCount() {
        return $this->pups_number >= $this->pups_number_stillborn;

    }

    public function checkMaxPupCount() {
        return $this->pups_number <= LittersTable::MAXIMAL_PUP_NUMBER;

    }

    public function checkMaxStillbornCount() {
        return $this->pups_number <= LittersTable::MAXIMAL_PUP_NUMBER;

    }

    /* Statistics */

    // survival rate in litter does not use StatisticsTrait because of right censoring
    public function computeIntermediateSurvivalRate($offsprings = []) {
        $offsprings = new Collection($offsprings);
        $total = $offsprings->count();

        $ages = [];
        $k_max = min([RatsTable::MAXIMAL_AGE_MONTHS, $this->max_age]);
        foreach($offsprings as $offspring) {
            array_push($ages, $offspring->age);
        }
        for ($k=0; $k<=$k_max; $k++) {
            $deaths = array_filter($ages, function ($age) use ($k) {
                return $age < $k;
            });
            $survival[$k]['months'] = $k;
            $survival[$k]['count'] = $total == 0 ? 0 : 100*round(1-count($deaths)/$total,2);
        }
        if ($k_max < RatsTable::MAXIMAL_AGE_MONTHS) {
            for ($j=$k_max+1; $j<=RatsTable::MAXIMAL_AGE_MONTHS; $j++) {
                $survival[$j]['months'] = $j;
            }
        }
        return $survival;
    }

    public function wrapStatistics($offsprings) {

        // we avoid using: $this->computeLitterSexes(['litter_id' => $this->id])->toArray();
        // so that we can filter out rats which state is not "visible"
        $stats['sexes'] = [[
            'F' => $offsprings->cleanCopy()->where(['OffspringRats.sex' => 'F'])->count(),
            'M' => $offsprings->cleanCopy()->where(['OffspringRats.sex' => 'M'])->count(),
        ]];

        // exclude lost rats from statistics
        $offsprings = $offsprings->where([
            'OR' => [
                'death_secondary_cause_id !=' => '1',
                'death_secondary_cause_id IS' => null,
            ]
        ]);

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

        // survival: could be cheaper if called on $litter->offsprings with trait in RatsTable?
        $stats['survivors'] = $this->reliable_pups_number == 0
            ? 0
            : 100 * round($this->countMy('rats', 'litter', [
                'is_alive IS' => true,
                'litter_id' => $this->id,
                ])/$this->reliable_pups_number,2);
        $stats['survival'] = $this->computeIntermediateSurvivalRate($offsprings);

        return $stats;
    }

    /* genealogy and inbreeding functions */

    public function spanningTree($path = '', &$genealogy = null, &$index = null)
    {
        $rats = \Cake\Datasource\FactoryLocator::get('Table')->get('rats');
        $litters = \Cake\Datasource\FactoryLocator::get('Table')->get('litters');

        if (isset($this->id)) {
            $id = $this->id;
            $parents = $rats->find()
                ->select(['id', 'litter_id', 'sex'])
                ->matching('BredLitters', function ($query) use ($id) {
                    return $query->where(['BredLitters.id' => $id]);
                })
                ->enableHydration(false)
                ->all();
        } else {
            $parents = $this->parent_rats;
        }

        // no test on parent existence, since a litter must have at least one parent
        foreach ($parents as $parent) {
            $new_path = $path . $parent['sex'];

            if (in_array($parent['id'], array_values($genealogy))) {
                if (is_null($parent['litter_id'])) {
                    $new_path = $new_path . 'X';
                } else {
                    $new_path = $new_path . 'Y';
                }
                $genealogy[$new_path] = $parent['id'];
                if (! array_key_exists('name', $index[$parent['id']])) { // write name if not known
                    // fetch full name - could we get it with raw SQL query to save server time?
                    $rat = $rats->get($parent['id'], ['contain' => ['Ratteries', 'BirthLitters', 'BirthLitters.Contributions']]);
                    $index[$parent['id']]['name'] = $rat->usual_name;
                }
            } else {
                $index[$parent['id']] = ['path' => $new_path];
                if (is_null($parent['litter_id'])) {
                    $new_path = $new_path . 'X';
                    $genealogy[$new_path] = $parent['id'];
                } else {
                    // since we have never been there and there is more, we continue exploring upwards
                    $newlitter = $litters->find()->where(['id' => $parent['litter_id']])->first();
                    if (! is_null($newlitter)) {
                        $newlitter->spanningTree($new_path, $genealogy, $index);
                        $genealogy[$new_path] = $parent['id'];
                    }
                }
            }
        }
        return null;
    }

    // predict prefix in virtual litter (without declared birth place)
    // 'IND' should not be hardcoded but this would be a lot of work for a very small feature
    function predictPrefix() {
        $first = $this->dam->owner_user->main_rattery;
        if (empty($first)) {
            $prefix = 'IND';
        } else {
            $prefix = $first->prefix;
        }
        $second = $this->sire->owner_user->main_rattery;
        if (! empty($second) && $prefix != $second->prefix) {
            $prefix .= '-' . $second->prefix;
        }

        return $prefix;
    }

}
