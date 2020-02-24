<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RatsFixture
 */
class RatsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 70, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'pup_name' => ['type' => 'string', 'length' => 70, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'sex' => ['type' => 'char', 'length' => 1, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'pedigree_identifier' => ['type' => 'string', 'length' => 10, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'birth_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'death_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'death_primary_cause_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'death_secondary_cause_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'death_euthanized' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'death_diagnosed' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'death_necropsied' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'picture' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'picture_thumbnail' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'comments' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'is_alive' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'mother_rattery_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'father_rattery_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'mother_rat_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'father_rat_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'litter_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'owner_user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'color_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'earset_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'eyecolor_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'dilution_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'coat_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'marking_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'creator_user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => '1981-08-01 00:00:00', 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => '1981-08-01 00:00:00', 'comment' => ''],
        'state_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'rattery_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FK_mother_rattery' => ['type' => 'index', 'columns' => ['mother_rattery_id'], 'length' => []],
            'FK_father_rat' => ['type' => 'index', 'columns' => ['father_rat_id'], 'length' => []],
            'FK_mother_rat' => ['type' => 'index', 'columns' => ['mother_rat_id'], 'length' => []],
            'Fk_owner' => ['type' => 'index', 'columns' => ['owner_user_id'], 'length' => []],
            'FK_color' => ['type' => 'index', 'columns' => ['color_id'], 'length' => []],
            'FK_earset' => ['type' => 'index', 'columns' => ['earset_id'], 'length' => []],
            'FK_eyecolor' => ['type' => 'index', 'columns' => ['eyecolor_id'], 'length' => []],
            'fk_dilution' => ['type' => 'index', 'columns' => ['dilution_id'], 'length' => []],
            'fk_coat' => ['type' => 'index', 'columns' => ['coat_id'], 'length' => []],
            'fk_marking' => ['type' => 'index', 'columns' => ['marking_id'], 'length' => []],
            'FK_death_primary_cause' => ['type' => 'index', 'columns' => ['death_primary_cause_id'], 'length' => []],
            'FK_creator' => ['type' => 'index', 'columns' => ['creator_user_id'], 'length' => []],
            'fk_father_rattery' => ['type' => 'index', 'columns' => ['father_rattery_id'], 'length' => []],
            'fk_death_secondary_cause' => ['type' => 'index', 'columns' => ['death_secondary_cause_id'], 'length' => []],
            'fk_litter' => ['type' => 'index', 'columns' => ['litter_id'], 'length' => []],
            'fk_state' => ['type' => 'index', 'columns' => ['state_id'], 'length' => []],
            'fk_rats_ratteries1' => ['type' => 'index', 'columns' => ['rattery_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'id_UNIQUE' => ['type' => 'unique', 'columns' => ['id'], 'length' => []],
            'Pedigree_identifier_UNIQUE' => ['type' => 'unique', 'columns' => ['pedigree_identifier'], 'length' => []],
            'FK_color' => ['type' => 'foreign', 'columns' => ['color_id'], 'references' => ['colors', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_creator' => ['type' => 'foreign', 'columns' => ['creator_user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_death_primary_cause' => ['type' => 'foreign', 'columns' => ['death_primary_cause_id'], 'references' => ['death_primary_causes', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_earset' => ['type' => 'foreign', 'columns' => ['earset_id'], 'references' => ['earsets', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_eyecolor' => ['type' => 'foreign', 'columns' => ['eyecolor_id'], 'references' => ['eyecolors', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_father_rat' => ['type' => 'foreign', 'columns' => ['father_rat_id'], 'references' => ['rats', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_mother_rat' => ['type' => 'foreign', 'columns' => ['mother_rat_id'], 'references' => ['rats', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_mother_rattery' => ['type' => 'foreign', 'columns' => ['mother_rattery_id'], 'references' => ['ratteries', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'Fk_owner' => ['type' => 'foreign', 'columns' => ['owner_user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_coat' => ['type' => 'foreign', 'columns' => ['coat_id'], 'references' => ['coats', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_death_secondary_cause' => ['type' => 'foreign', 'columns' => ['death_secondary_cause_id'], 'references' => ['death_secondary_causes', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_dilution' => ['type' => 'foreign', 'columns' => ['dilution_id'], 'references' => ['dilutions', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_father_rattery' => ['type' => 'foreign', 'columns' => ['father_rattery_id'], 'references' => ['ratteries', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_litter' => ['type' => 'foreign', 'columns' => ['litter_id'], 'references' => ['litters', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_marking' => ['type' => 'foreign', 'columns' => ['marking_id'], 'references' => ['markings', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_rats_ratteries1' => ['type' => 'foreign', 'columns' => ['rattery_id'], 'references' => ['ratteries', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_state' => ['type' => 'foreign', 'columns' => ['state_id'], 'references' => ['states', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'pup_name' => 'Lorem ipsum dolor sit amet',
                'sex' => '',
                'pedigree_identifier' => 'Lorem ip',
                'birth_date' => '2020-02-24',
                'death_date' => '2020-02-24',
                'death_primary_cause_id' => 1,
                'death_secondary_cause_id' => 1,
                'death_euthanized' => 1,
                'death_diagnosed' => 1,
                'death_necropsied' => 1,
                'picture' => 'Lorem ipsum dolor sit amet',
                'picture_thumbnail' => 'Lorem ipsum dolor sit amet',
                'comments' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'is_alive' => 1,
                'mother_rattery_id' => 1,
                'father_rattery_id' => 1,
                'mother_rat_id' => 1,
                'father_rat_id' => 1,
                'litter_id' => 1,
                'owner_user_id' => 1,
                'color_id' => 1,
                'earset_id' => 1,
                'eyecolor_id' => 1,
                'dilution_id' => 1,
                'coat_id' => 1,
                'marking_id' => 1,
                'creator_user_id' => 1,
                'created' => '2020-02-24 20:26:19',
                'modified' => '2020-02-24 20:26:19',
                'state_id' => 1,
                'rattery_id' => 1,
            ],
        ];
        parent::init();
    }
}
