<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\FrozenTime;
use Cake\Collection\Collection;
use Cake\Datasource\FactoryLocator;
use Cake\Routing\Router;
use App\Model\Entity\StatisticsTrait;
use App\Model\Table\RatsTable;

/**
 * Rat Entity
 *
 * @property int $id
 * @property string|null $pedigree_identifier
 * @property bool $is_pedigree_custom
 * @property int|null $owner_user_id
 * @property string $name
 * @property string|null $pup_name
 * @property string $sex
 * @property \Cake\I18n\FrozenDate $birth_date
 * @property int $rattery_id
 * @property int $litter_id
 * @property int $color_id
 * @property int $eyecolor_id
 * @property int $dilution_id
 * @property int $marking_id
 * @property int $earset_id
 * @property int $coat_id
 * @property bool $is_alive
 * @property \Cake\I18n\FrozenDate|null $death_date
 * @property int|null $death_primary_cause_id
 * @property int|null $death_secondary_cause_id
 * @property bool|null $death_euthanized
 * @property bool|null $death_diagnosed
 * @property bool|null $death_necropsied
 * @property string|null $comments
 * @property string|null $picture
 * @property string|null $picture_thumbnail
 * @property int $creator_user_id
 * @property int $state_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $owner_user
 * @property \App\Model\Entity\Rattery $rattery
 * @property \App\Model\Entity\Color $color
 * @property \App\Model\Entity\Eyecolor $eyecolor
 * @property \App\Model\Entity\Dilution $dilution
 * @property \App\Model\Entity\Marking $marking
 * @property \App\Model\Entity\Earset $earset
 * @property \App\Model\Entity\Coat $coat
 * @property \App\Model\Entity\DeathPrimaryCause $death_primary_cause
 * @property \App\Model\Entity\DeathSecondaryCause $death_secondary_cause
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Conversation[] $conversations
 * @property \App\Model\Entity\RatSnapshot[] $rat_snapshots
 * @property \App\Model\Entity\Litter[] $litters
 * @property \App\Model\Entity\Singularity[] $singularities
 */
class Rat extends Entity
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
        'pedigree_identifier' => true,
        'is_pedigree_custom' => true,
        'owner_user_id' => true, /* used to be false: why? */
        'name' => true,
        'pup_name' => true,
        'sex' => true,
        'birth_date' => true,
        'rattery_id' => true,
        'litter_id' => true,
        'color_id' => true,
        'eyecolor_id' => true,
        'dilution_id' => true,
        'marking_id' => true,
        'earset_id' => true,
        'coat_id' => true,
        'is_alive' => true,
        'death_date' => true,
        'death_primary_cause_id' => true,
        'death_secondary_cause_id' => true,
        'death_euthanized' => true,
        'death_diagnosed' => true,
        'death_necropsied' => true,
        'comments' => true,
        'picture' => true,
        'picture_thumbnail' => true,
        'creator_user_id' => false,
        'state_id' => false,
        'created' => true,
        'modified' => true,
        'owner_user' => true,
        'rattery' => true,
        'color' => true,
        'eyecolor' => true,
        'dilution' => true,
        'marking' => true,
        'earset' => true,
        'coat' => true,
        'death_primary_cause' => true,
        'death_secondary_cause' => true,
        'creator_user' => false,
        'state' => true,
        'conversations' => true,
        'rat_snapshots' => true,
        'litters' => true,
        'singularities' => true,
    ];

    protected function _getDoublePrefix()
    {
        $doublePrefix = $this->rattery->prefix;

        if (isset($this->birth_litter)
            && ! empty($this->birth_litter->contributions[1])
            && ! $this->birth_litter->contributions[1]->rattery->is_generic
            && ($this->rattery->prefix != $this->birth_litter->contributions[1])
        ) {
            $doublePrefix .= '-' . $this->birth_litter->contributions[1]->rattery->prefix;
        }
        return $doublePrefix;
    }

    protected function _getFullName()
    {
        return $this->pedigree_identifier . ' ' . $this->name . $this->is_alive_symbol;
    }

    protected function _getUsualName()
    {
        if($this->id > 2) {
            return $this->double_prefix . ' ' . $this->name;
        } else { // don't return prefix for unknown mother and unknown father special rats
            return $this->name;
        }
    }

    protected function _getIsAliveSymbol()
    {
        // dagger is preceded with a non breakable fine space, do not edit!
        return ($this->is_alive ? '' : ' †');
    }

    protected function _getSexName()
    {
        return $this->sex=='M' ? 'Male' : 'Female';
    }

    protected function _getSexSymbol()
    {
        return $this->sex=='M' ? '♂' : '♀';
    }

    protected function _getPictureThumbnail()
    {
        if (isset($this->_fields['picture_thumbnail'])) {
            return $this->_fields['picture_thumbnail'];
        }
        return 'thumbnails/Unknown.svg';
    }

    protected function _getPedigreeIdentifier()
    {
        if ($this->is_pedigree_custom || isset($this->_fields['pedigree_identifier'])) {
            return $this->_fields['pedigree_identifier'];
        } else if (isset ($this->rattery)) {
            return $this->rattery->prefix . $this->id . $this->sex ;
        } else {
            return '???';
        }
    }

    // protected function _setPedigreeIdentifier($pedigree_identifier)
    // {
    //     if ($this->is_pedigree_custom) {
    //         return $pedigree_identifier ;
    //     } else if (isset($this->_fields['id']) && isset($this->_fields['rattery'])) {
    //         if ($pedigree_identifier == $this->getOriginal('pedigree_identifier')) {
    //             $this->setDirty('pedigree_identifier', true);
    //         }
    //         return $this->rattery->prefix . $this->id . $this->sex ;
    //     } else {
    //         return '' ; // Should raise an exception
    //     }
    // }

    protected function _getAge()
    {
        $agedate = FrozenTime::now();
        /* debug while waiting for data conformity:
        there shouldn't be a death date if the rat is alive, but... */
        if (! $this->is_alive && isset($this->_fields['death_date'])) {
            $agedate = $this->_fields['death_date'];
        }

        // Compute diffInDays and round it rather than diffInMonths for consistency:
        // we want 1 month age for a 20 days rat rather than 0
        if (isset($this->birth_date)) {
            return round($agedate->diffInDays($this->_fields['birth_date'], true)/30.5);
        } else {
            return -1; // Should raise exception
        }
    }

    protected function _getAgeString()
    {
        if ($this->age < 0) { // Should raise exception
            return $age = 'Negative age!';
        }
        if ($this->age > RatsTable::MAXIMAL_AGE_MONTHS) {
            return $age = 'Unknown';
        }
        if (! $this->_fields['is_alive'] ) {
            $age = $this->has('death_date') ? ($this->age . ' months') : ('Unknown') ;//('supposed deceased, unknown age');
            return $age;
        }  else {
            if($this->age < 1) {
                return $age = $this->precise_age . ' days';
            } else {
                return $age = $this->age . ' months';
            }
        }
    }

    // used in pedigree only
    protected function _getShortAgeString()
    {
        if ($this->age < 0) { // Should raise exception
            return $age = 'Negative age!';
        }
        if ($this->age > RatsTable::MAXIMAL_AGE_MONTHS) {
            return $age = 'unknown';
        }
        if (! $this->_fields['is_alive'] ) {
            $age = $this->has('death_date') ? ($this->age . ' mo') : ('unknown') ;//('supposed deceased, unknown age');
            return $age;
        }  else {
            if($this->age < 1) {
                return $age = $this->precise_age . __(' d');
            } else {
                return $age = $this->age . __(' mo');
            }
        }
    }

    protected function _getPreciseAge()
    {
        $agedate = FrozenTime::now();
        /* debug while waiting for data conformity:
        there shouldn't be a death date if the rat is alive, but... */
        // if (! $this->_fields['is_alive'] && isset($this->_fields['death_date'])) {
        if (!$this->is_alive && isset($this->_fields['death_date'])) {
            $agedate = $this->_fields['death_date'];
        }
        if (isset($this->birth_date)) {
            return $agedate->diffInDays($this->_fields['birth_date'], true);
        } else {
            return 0; // Should raise exception
        }
    }

    protected function _getChampionAgeString()
    {
        // if (!$this->is_alive
        //    && isset($this->birth_date)
        //    && isset($this->_fields['death_date'])
        //    && isset($this->_fields['death_primary_cause'])
        //    && (!isset($this->_fields['death_secondary_cause']) || (isset($this->_fields['death_primary_cause']) && $this->death_secondary_cause_id != 1))
        // ) {
            //return $agedate->diffInDays($this->_fields['birth_date'], true);
            // timeAgoInWords? diffForHumans?
            $birthdate = $this->birth_date;
            $deathdate = $this->death_date;
            /* call to timeAgoInWords in the "wrong" date order to avoid "ago" to be added to the string */
            /* could be improved with option "relativeString" to skip number of weeks and convert them to days */
            return $ageInWords =  $deathdate->timeAgoInWords(['from' => $birthdate, 'accuracy' => ['year' => 'day']]);
        //} else {
        //    return 0; // Should raise exception
        //}
    }

    public function childbearingAge()
    {
        $start = $this->birth_date->modify('+ 5 months');
        $end = $this->birth_date->modify('+ 9 months');
        return $start->i18nFormat('dd/MM/yyyy') . '-' . $end->i18nFormat('dd/MM/yyyy');
    }

    protected function isBirthday()
    {
        return (
            $this->birth_date->month == FrozenTime::now()->month
            && $this->birth_date->day == FrozenTime::now()->day
        );
    }

    protected function _getNextBirthday()
    {
        $today = FrozenTime::now();
        $this_year_birthday = FrozenTime::createFromDate($today->year, $this->birth_date->month, $this->birth_date->day);
        $next_year_birthday = FrozenTime::createFromDate($today->year + 1, $this->birth_date->month, $this->birth_date->day);
        if ($this_year_birthday->isFuture()) {
            return $this_year_birthday;
        } else {
            return $next_year_birthday;
        }
    }

    // this might be improved through a cell, to add links on singularity lists
    protected function _getSingularityString()
    {
        if (empty($this->singularities)) {
            return '';
        }
        $singularities = new Collection($this->singularities);
        $str = $singularities->reduce(function ($string, $singularity) {
            return $string . $singularity->name . ', ';
        }, '');
        return trim($str, ', ');
    }

    protected function _getMainDeathCause() // same as ShortDeathCause without the trim
    {
        if(!$this->is_alive) {
            if(!isset($this->death_primary_cause)) {
                return 'Unknown'; // should raise exception
            }
            if(isset($this->death_secondary_cause)) {
                $cause = h($this->death_secondary_cause->name);
            } else {
                $cause = h($this->death_primary_cause->name);
            }
        } else {
            if ($this->age > RatsTable::MAXIMAL_AGE_MONTHS) {
                $cause = __('Unknown (presumably dead)');
            } else {
                $cause = '– ' . __('Alive') . ' –'; // ndash and fine space, please edit carefully
            }
        }
        return $cause;
    }

    protected function _getShortDeathCause()
    {
        if (!$this->is_alive) {
            if (!isset($this->death_primary_cause)) {
                return 'Unknown'; // should raise exception
            }
            if(isset($this->death_secondary_cause)) {
                $cause = h($this->death_secondary_cause->name);
            } else {
                $cause = h($this->death_primary_cause->name);
            }
            // trim cause before first comma or parenthesis for concision
            $cause = strpos($cause, "(") ? substr($cause, 0, strpos($cause, "(")) : $cause;
            if( strlen($cause) > 12 ) {
                $cause = strpos($cause, "," , 12) ? substr($cause, 0, strpos($cause, "," , 12)) . ', etc.' : $cause;
            }
        } else {
            if ($this->age > RatsTable::MAXIMAL_AGE_MONTHS) {
                $cause = '– ' . __('presumably dead') . ' –'; // ndash and fine space, please edit carefully
            } else {
                $cause = '– ' . __('alive') . ' –'; // ndash and fine space, please edit carefully
            }
        }
        return $cause;
    }

    protected function _getVariety()
    {
        $dilution = ($this->dilution_id == 1) ? '' : $this->dilution->name;
        $color = ($this->color_id == 1) ? '' : $this->color->name;
        $coat = ($this->coat_id == 1) ? '' : $this->coat->name;
        $earset = ($this->earset_id == 1) ? '' : $this->earset->name;
        // don't write marking if rat has a dilution
        $marking = ($this->marking_id == 1 || $dilution != '') ? '' : $this->marking->name;
        $variety = $dilution . ' ' . $color . ' ' . $marking . ' ' . $earset . ' ' . $coat ;
        return trim($variety);
    }

    public function buildFamilyTree($id, $depth)
    {
        $model = FactoryLocator::get('Table')->get('Rats');

        $rat = $model->get($id, [
            'contain' => ['Colors', 'Eyecolors', 'Dilutions', 'Markings', 'Earsets', 'Coats', 'Singularities', 'Ratteries',
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

        $tree = [];

        if ($depth > 0) {
            $parents = [];
            if(!empty($rat->birth_litter->dam[0])) {
                $damtree = $this->buildFamilyTree($rat->birth_litter->dam[0]->id, $depth-1);
                array_push($parents, $damtree);
            }
            if(!empty($rat->birth_litter->sire[0])) {
                $siretree = $this->buildFamilyTree($rat->birth_litter->sire[0]->id, $depth-1);
                array_push($parents, $siretree);
            }
            $tree = [
                'id' => rand() . '_' . $rat->id,
                'true_id' => $rat->id,
                'name' => $rat->usual_name,
                'sex' => $rat->sex, // we want a different color for the root of the tree
                'description' => $rat->variety,
                'death' => $rat->short_death_cause . ' (' . $rat->short_age_string . ')',
                'more_parents' => is_null($rat->litter_id) ? 0 : 1,
                '_parents' => $parents,
            ];
        } else {
            $tree = [
                'id' => rand() . '_' . $rat->id,
                'true_id' => $rat->id,
                'name' => $rat->usual_name,
                'sex' => $rat->sex,
                'description' => $rat->variety,
                'death' => $rat->short_death_cause . ' (' . $rat->short_age_string . ')',
                'more_parents' => is_null($rat->litter_id) ? 0 : 1,
                '_parents' => []
            ];
        }
        return $tree;
    }

    protected function _getParentsArray()
    {
        $parents = [];

        if(!empty($this->birth_litter->dam[0])) {
            array_push($parents,
            [
                'id' => rand() . '_' . $this->birth_litter->dam[0]->id,
                'true_id' => $this->birth_litter->dam[0]->id,
                'name' => $this->birth_litter->dam[0]->usual_name,
                'link' => Router::Url(['controller' => 'Rats', 'action' => 'view', $this->birth_litter->dam[0]->id]),
                'sex' => 'F',
                'description' => $this->birth_litter->dam[0]->variety,
                'death'=> $this->birth_litter->dam[0]->short_death_cause . ' (' . $this->birth_litter->dam[0]->short_age_string . ')',
                'more_parents' => is_null($this->birth_litter->dam[0]->litter_id) ? 0 : 1,
                '_parents' => [],
            ]);
        }

        if(!empty($this->birth_litter->sire[0])) {
            array_push($parents,
            [
                'id' => rand() . '_' . $this->birth_litter->sire[0]->id,
                'true_id' => $this->birth_litter->sire[0]->id,
                'name' => $this->birth_litter->sire[0]->usual_name,
                'link' => Router::Url(['controller' => 'Rats', 'action' => 'view', $this->birth_litter->sire[0]->id]),
                'sex' => 'M',
                'description' => $this->birth_litter->sire[0]->variety,
                'death'=> $this->birth_litter->sire[0]->short_death_cause . ' (' . $this->birth_litter->sire[0]->short_age_string . ')',
                'more_parents' => is_null($this->birth_litter->sire[0]->litter_id) ? 0 : 1,
                '_parents' => [],
            ]);
        }
        return $parents;
    }

    protected function _getChildrenArray()
    {
        $children = [];
        foreach($this->bred_litters as $litter) {
            foreach ($litter->offspring_rats as $offspring) {
                array_push($children, [
                    'id' => rand() . '_' . $offspring->id, // should be modified to be unique in the tree
                    //'id' => $offspring->id, // should be modified to be unique in the tree
                    'true_id' => $offspring->id,
                    'name' => $offspring->usual_name,
                    'link' => Router::Url(['controller' => 'Rats', 'action' => 'view', $offspring->id]),
                    'sex' => $offspring->sex,
                    'description' => $offspring->variety,
                    'death' => $offspring->short_death_cause . ' (' . $offspring->short_age_string . ')',
                    'more_children' => $offspring->has_children ? 1 : 0,
                    '_children' => [],
                ]);
            }
        }
        return $children;
    }

    protected function _getHasChildren()
    {
        if (isset($this->bred_litters)) {
            return ! empty($this->bred_litters);
        } else { // when bred litters are a deeply nested association
            $model = FactoryLocator::get('Table')->get('Rats');
            $id = $this->id;
            $children = $model->find()
                ->select(['id'])
                ->matching('BirthLitters.ParentRats', function ($query) use ($id) {
                    return $query->where(['ParentRats.id' => $id]);
                })
                ->enableHydration(false)
                ->toArray();
            return ! empty($children);
        }
    }

    public function isBornFuture()
    {
        return $this->birth_date->isFuture();
    }

    public function hasBirthPlace()
    {
        return ! is_null($this->rattery_id);
    }

    public function hasValidOrigins()
    {

        if (empty($this->rattery_id)) {
            return false;
        }

        if (! isset($this->rattery)) {
            $ratteries = \Cake\Datasource\FactoryLocator::get('Table')->get('Ratteries');
            $this->rattery = $ratteries->get($this->rattery_id);
        }

        return ($this->rattery->is_generic && (! empty($this->comments) || ! empty($this->litter_id)))
            || (! $this->rattery->is_generic && ! empty($this->litter_id));
    }

    public function hasInvalidName()
    {
        return preg_match("/^[FM][0-9]*$/i", $this->name);
    }

    /* check if rat's variety requires a picture */

    public function hasNeededPicture()
    {
        if (isset($this->death_primary_cause_id)) {
            if (! isset($this->death_primary_cause)) {
                $death_primary_causes = \Cake\Datasource\FactoryLocator::get('Table')->get('DeathPrimaryCauses');
                $this->death_primary_cause = $death_primary_causes->get($this->death_primary_cause_id);
            }

            if ($this->death_primary_cause->is_infant) {
                return true;
            }
        }

        // the missing trait will catch the error itself
        if (
            ! isset($this->coat_id)
            || ! isset($this->color_id)
            || ! isset($this->dilution_id)
            || ! isset($this->earset_id)
            || ! isset($this->eyecolor_id)
            || ! isset($this->marking_id)
        ) {
            return true;
        }

        if (! isset($this->coat)) {
            $coats = \Cake\Datasource\FactoryLocator::get('Table')->get('Coats');
            $this->coat = $coats->get($this->coat_id);
        }
        if (! isset($this->color)) {
            $colors = \Cake\Datasource\FactoryLocator::get('Table')->get('Colors');
            $this->color = $colors->get($this->color_id);
        }
        if (! isset($this->dilution)) {
            $dilutions = \Cake\Datasource\FactoryLocator::get('Table')->get('Dilutions');
            $this->dilution = $dilutions->get($this->dilution_id);
        }
        if (! isset($this->earset)) {
            $earsets = \Cake\Datasource\FactoryLocator::get('Table')->get('Earsets');
            $this->earset = $earsets->get($this->earset_id);
        }
        if (! isset($this->eyecolor)) {
            $eyecolors = \Cake\Datasource\FactoryLocator::get('Table')->get('Eyecolors');
            $this->eyecolor = $eyecolors->get($this->eyecolor_id);
        }
        if (! isset($this->marking)) {
            $markings = \Cake\Datasource\FactoryLocator::get('Table')->get('Markings');
            $this->marking = $markings->get($this->marking_id);
        }

        $coat_condition = ! ($this->coat->is_picture_mandatory && $this->picture == '');
        $color_condition = ! ($this->color->is_picture_mandatory && $this->picture == '');
        $dilution_condition = ! ($this->dilution->is_picture_mandatory && $this->picture == '');
        $earset_condition = ! ($this->earset->is_picture_mandatory && $this->picture == '');
        $eyecolor_condition = ! ($this->eyecolor->is_picture_mandatory && $this->picture == '');
        $marking_condition = ! ($this->marking->is_picture_mandatory && $this->picture == '');

        $singularity_condition = true;
        foreach ($this->singularities as $singularity) {
            if ($singularity->is_picture_mandatory && $this->picture == '') {
                $singularity_condition = false;
            }
        }

        return $coat_condition
            && $color_condition
            && $dilution_condition
            && $earset_condition
            && $eyecolor_condition
            && $marking_condition
            && $singularity_condition;
    }

    /* check if rat is young enough to be eligible to infant mortality */
    public function canDieInfant()
    {
        return ! ( !$this->is_alive && ($this->death_primary_cause->is_infant) && ($this->precise_age > RatsTable::MAXIMAL_INFANT_AGE) );
    }

    /* check if rat is old enough to die of old age */
    public function canDieOldster()
    {
        return !( !$this->is_alive && ($this->death_primary_cause->is_oldster) && ($this->age < RatsTable::MINIMAL_OLDSTER_AGE) );
    }

    /* check if rat age at death is not larger than max */
    public function isMathusalem()
    {
        return ! $this->is_alive
            && $this->death_secondary_cause_id != '1'
            && $this->age > RatsTable::MAXIMAL_AGE_MONTHS;
    }

    /* family statistics */

    public function computeDescendance($id, &$descendance)
    {
        $model = FactoryLocator::get('Table')->get('Rats');

        if (in_array($id, $descendance)) {
            return null;
        }

        $children = $model->find()
            ->select(['id'])
            ->matching('BirthLitters.ParentRats', function ($query) use ($id) {
                return $query->where(['ParentRats.id' => $id]);
            })
            ->enableHydration(false)
            ->toArray();

        if (!empty($children)) {
            foreach ($children as $child) {
                $this->computeDescendance($child['id'], $descendance);
            }
            array_push($descendance, $id);
            return $descendance;
        } else {
            array_push($descendance, $id);
            return null;
        }
    }

    public function computeAncestry($id, &$ancestry)
    {
        $model = FactoryLocator::get('Table')->get('Rats');

        if (in_array($id, $ancestry)) {
            return null;
        }

        $ancestors = $model->find()
            ->select(['id'])
            ->matching('BredLitters.OffspringRats', function ($query) use ($id) {
                return $query->where(['OffspringRats.id' => $id]);
            })
            ->enableHydration(false)
            ->toArray();

        if (! empty($ancestors)) {
            foreach ($ancestors as $ancestor) {
                $this->computeAncestry($ancestor['id'], $ancestry);
            }
            array_push($ancestry, $id);
            return $ancestry;
        } else {
            array_push($ancestry, $id);
            return null;
        }
    }

    public function wrapFamilyStatistics()
    {
        // -1 since the rat itself is put in the list for recursion initialization
        $descendance = [];
        $this->computeDescendance($this->id, $descendance);
        $stats['descendors'] = count($descendance) - 1;
        $ancestry = [];
        $this->computeAncestry($this->id, $ancestry);
        $stats['ancestors'] = count($ancestry) - 1;
        $children = 0;
        foreach ($this->bred_litters as $litter) {
            $children += $litter->pups_number;
        }
        $stats['children'] = $children;

        $stats['asc_alive'] = $this->countRats([
            'Rats.id IN' => $ancestry,
            'Rats.id !=' => $this->id,
            'Rats.id >' => '2', // to be replaced by unreliable state on unknown mother and father
            'is_alive IS' => true,
            'DATEDIFF(NOW(), birth_date) <' => RatsTable::MAXIMAL_AGE,
        ]);

        $stats['desc_alive'] = $this->countRats([
            'Rats.id IN' => $descendance,
            'Rats.id !=' => $this->id,
            'Rats.id >' => '2', // to be replaced by unreliable state on unknown mother and father
            'is_alive IS' => true,
            'DATEDIFF(NOW(), birth_date) <' => RatsTable::MAXIMAL_AGE
        ]);

        $stats['asc_lifespan'] = $this->roundLifespan(['Rats.id IN' => $ancestry, 'Rats.id !=' => $this->id]);
        $stats['asc_female_lifespan'] = $this->roundLifespan(['Rats.id IN' => $ancestry, 'Rats.id !=' => $this->id, 'sex' => 'F']);
        $stats['asc_male_lifespan'] = $this->roundLifespan(['Rats.id IN' => $ancestry, 'Rats.id !=' => $this->id, 'sex' => 'M']);

        $stats['asc_not_infant_lifespan'] = $this->roundLifespan(['Rats.id IN' => $ancestry, 'Rats.id !=' => $this->id, 'DeathPrimaryCauses.is_infant IS' => false]);
        $stats['asc_female_not_infant_lifespan'] = $this->roundLifespan(['Rats.id IN' => $ancestry, 'Rats.id !=' => $this->id, 'sex' => 'F', 'DeathPrimaryCauses.is_infant IS' => false]);
        $stats['asc_male_not_infant_lifespan'] = $this->roundLifespan(['Rats.id IN' => $ancestry, 'Rats.id !=' => $this->id, 'sex' => 'M', 'DeathPrimaryCauses.is_infant IS' => false]);

        $stats['asc_not_accident_lifespan'] = $this->roundLifespan(['Rats.id IN' => $ancestry, 'Rats.id !=' => $this->id, 'DeathPrimaryCauses.is_infant IS' => false, 'DeathPrimaryCauses.is_accident IS' => false]);
        $stats['asc_female_not_accident_lifespan'] = $this->roundLifespan(['Rats.id IN' => $ancestry, 'Rats.id !=' => $this->id, 'sex' => 'F', 'DeathPrimaryCauses.is_infant IS' => false, 'DeathPrimaryCauses.is_accident IS' => false]);
        $stats['asc_male_not_accident_lifespan'] = $this->roundLifespan(['Rats.id IN' => $ancestry, 'Rats.id !=' => $this->id, 'sex' => 'M', 'DeathPrimaryCauses.is_infant IS' => false, 'DeathPrimaryCauses.is_accident IS' => false]);

        $stats['desc_lifespan'] = $this->roundLifespan(['Rats.id IN' => $descendance, 'Rats.id !=' => $this->id]);
        $stats['desc_female_lifespan'] = $this->roundLifespan(['Rats.id IN' => $descendance, 'Rats.id !=' => $this->id,'sex' => 'F']);
        $stats['desc_male_lifespan'] = $this->roundLifespan(['Rats.id IN' => $descendance, 'Rats.id !=' => $this->id,'sex' => 'M']);

        $stats['desc_not_infant_lifespan'] = $this->roundLifespan(['Rats.id IN' => $descendance, 'Rats.id !=' => $this->id, 'DeathPrimaryCauses.is_infant IS' => false]);
        $stats['desc_female_not_infant_lifespan'] = $this->roundLifespan(['Rats.id IN' => $descendance, 'Rats.id !=' => $this->id, 'sex' => 'F', 'DeathPrimaryCauses.is_infant IS' => false]);
        $stats['desc_male_not_infant_lifespan'] = $this->roundLifespan(['Rats.id IN' => $descendance, 'Rats.id !=' => $this->id, 'sex' => 'M', 'DeathPrimaryCauses.is_infant IS' => false]);

        $stats['desc_not_accident_lifespan'] = $this->roundLifespan(['Rats.id IN' => $descendance, 'Rats.id !=' => $this->id, 'DeathPrimaryCauses.is_infant IS' => false, 'DeathPrimaryCauses.is_accident IS' => false]);
        $stats['desc_female_not_accident_lifespan'] = $this->roundLifespan(['Rats.id IN' => $descendance, 'Rats.id !=' => $this->id, 'sex' => 'F', 'DeathPrimaryCauses.is_infant IS' => false, 'DeathPrimaryCauses.is_accident IS' => false]);
        $stats['desc_male_not_accident_lifespan'] = $this->roundLifespan(['Rats.id IN' => $descendance, 'Rats.id !=' => $this->id, 'sex' => 'M', 'DeathPrimaryCauses.is_infant IS' => false, 'DeathPrimaryCauses.is_accident IS' => false]);

        return $stats;
    }
}
