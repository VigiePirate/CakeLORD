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
        'name_owner' => ['type' => 'string', 'length' => 70, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'name_pup' => ['type' => 'string', 'length' => 70, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'sex' => ['type' => 'char', 'length' => 1, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'pedigree_identifier' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'date_birth' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'date_death' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'death_cause_primary_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'death_cause_secondary_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'death_euthanized' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'death_diagnosed' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'death_necropsied' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'picture' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'picture_thumbnail' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'comments' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'validated' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'rattery_mother_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'rattery_father_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'mother_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'father_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'litter_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'owner_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'color_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'earset_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'eyecolor_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'dilution_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'coat_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'marking_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_creator_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'FK_origine' => ['type' => 'index', 'columns' => ['rattery_mother_id'], 'length' => []],
            'FK_pere' => ['type' => 'index', 'columns' => ['father_id'], 'length' => []],
            'FK_mere' => ['type' => 'index', 'columns' => ['mother_id'], 'length' => []],
            'Fk_proprietaire' => ['type' => 'index', 'columns' => ['owner_id'], 'length' => []],
            'FK_couleur' => ['type' => 'index', 'columns' => ['color_id'], 'length' => []],
            'FK_oreilles' => ['type' => 'index', 'columns' => ['earset_id'], 'length' => []],
            'FK_yeux' => ['type' => 'index', 'columns' => ['eyecolor_id'], 'length' => []],
            'fk_dilutions' => ['type' => 'index', 'columns' => ['dilution_id'], 'length' => []],
            'fk_poils' => ['type' => 'index', 'columns' => ['coat_id'], 'length' => []],
            'fk_marquage' => ['type' => 'index', 'columns' => ['marking_id'], 'length' => []],
            'FK_deces' => ['type' => 'index', 'columns' => ['death_cause_primary_id'], 'length' => []],
            'FK_enregistreur' => ['type' => 'index', 'columns' => ['user_creator_id'], 'length' => []],
            'fk_origine_raterie_2' => ['type' => 'index', 'columns' => ['rattery_father_id'], 'length' => []],
            'fk_deces_secondaire' => ['type' => 'index', 'columns' => ['death_cause_secondary_id'], 'length' => []],
            'fk_lord_rats_lord_litters1' => ['type' => 'index', 'columns' => ['litter_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'rat_id_UNIQUE' => ['type' => 'unique', 'columns' => ['id'], 'length' => []],
            'rat_numero_UNIQUE' => ['type' => 'unique', 'columns' => ['pedigree_identifier'], 'length' => []],
            'FK_couleur' => ['type' => 'foreign', 'columns' => ['color_id'], 'references' => ['colors', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_deces' => ['type' => 'foreign', 'columns' => ['death_cause_primary_id'], 'references' => ['death_causes_primary', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_enregistreur' => ['type' => 'foreign', 'columns' => ['user_creator_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_mere' => ['type' => 'foreign', 'columns' => ['mother_id'], 'references' => ['rats', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_oreilles' => ['type' => 'foreign', 'columns' => ['earset_id'], 'references' => ['earsets', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_origine' => ['type' => 'foreign', 'columns' => ['rattery_mother_id'], 'references' => ['ratteries', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_pere' => ['type' => 'foreign', 'columns' => ['father_id'], 'references' => ['rats', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_yeux' => ['type' => 'foreign', 'columns' => ['eyecolor_id'], 'references' => ['eyecolors', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'Fk_proprietaire' => ['type' => 'foreign', 'columns' => ['owner_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_deces_secondaire' => ['type' => 'foreign', 'columns' => ['death_cause_secondary_id'], 'references' => ['death_causes_secondary', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_dilutions' => ['type' => 'foreign', 'columns' => ['dilution_id'], 'references' => ['dilutions', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_lord_rats_lord_litters1' => ['type' => 'foreign', 'columns' => ['litter_id'], 'references' => ['litters', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_marquage' => ['type' => 'foreign', 'columns' => ['marking_id'], 'references' => ['markings', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_origine_raterie_2' => ['type' => 'foreign', 'columns' => ['rattery_father_id'], 'references' => ['ratteries', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_poils' => ['type' => 'foreign', 'columns' => ['coat_id'], 'references' => ['coats', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'name_owner' => 'Lorem ipsum dolor sit amet',
                'name_pup' => 'Lorem ipsum dolor sit amet',
                'sex' => '',
                'pedigree_identifier' => 'Lorem ip',
                'date_birth' => '2020-02-21',
                'date_death' => '2020-02-21',
                'death_cause_primary_id' => 1,
                'death_cause_secondary_id' => 1,
                'death_euthanized' => 1,
                'death_diagnosed' => 1,
                'death_necropsied' => 1,
                'picture' => 'Lorem ipsum dolor sit amet',
                'picture_thumbnail' => 'Lorem ipsum dolor sit amet',
                'comments' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'validated' => 1,
                'rattery_mother_id' => 1,
                'rattery_father_id' => 1,
                'mother_id' => 1,
                'father_id' => 1,
                'litter_id' => 1,
                'owner_id' => 1,
                'color_id' => 1,
                'earset_id' => 1,
                'eyecolor_id' => 1,
                'dilution_id' => 1,
                'coat_id' => 1,
                'marking_id' => 1,
                'user_creator_id' => 1,
                'created' => '2020-02-21 15:10:28',
                'modified' => '2020-02-21 15:10:28',
            ],
        ];
        parent::init();
    }
}
