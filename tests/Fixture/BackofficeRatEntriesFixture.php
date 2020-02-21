<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BackofficeRatEntriesFixture
 */
class BackofficeRatEntriesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'status' => ['type' => 'tinyinteger', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'rat_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'rat_name_owner' => ['type' => 'string', 'length' => 70, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'rat_name_pup' => ['type' => 'string', 'length' => 70, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'rat_sex' => ['type' => 'char', 'length' => 1, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'rat_pedigree_identifier' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'rat_date_birth' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'rat_date_death' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'death_cause_primary_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'death_cause_secondary_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'rat_death_euthanized' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'rat_death_diagnosed' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'rat_death_necropsied' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'rat_picture' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'rat_picture_thumbnail' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'rat_comments' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'rat_validated' => ['type' => 'tinyinteger', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'rattery_mother_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'rattery_father_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'rat_mother_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'rat_father_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_owner_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'color_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'earset_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'eyecolor_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'dilution_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'coat_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'marking_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'singularity_id_list' => ['type' => 'string', 'length' => 15, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'user_creator_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'rat_date_create' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'rat_date_last_update' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'FK_origine0' => ['type' => 'index', 'columns' => ['rattery_mother_id'], 'length' => []],
            'FK_pere0' => ['type' => 'index', 'columns' => ['rat_father_id'], 'length' => []],
            'FK_mere0' => ['type' => 'index', 'columns' => ['rat_mother_id'], 'length' => []],
            'Fk_proprietaire0' => ['type' => 'index', 'columns' => ['user_owner_id'], 'length' => []],
            'FK_couleur0' => ['type' => 'index', 'columns' => ['color_id'], 'length' => []],
            'FK_oreilles0' => ['type' => 'index', 'columns' => ['earset_id'], 'length' => []],
            'FK_yeux0' => ['type' => 'index', 'columns' => ['eyecolor_id'], 'length' => []],
            'fk_dilutions0' => ['type' => 'index', 'columns' => ['dilution_id'], 'length' => []],
            'fk_poils0' => ['type' => 'index', 'columns' => ['coat_id'], 'length' => []],
            'fk_marquage0' => ['type' => 'index', 'columns' => ['marking_id'], 'length' => []],
            'FK_deces0' => ['type' => 'index', 'columns' => ['death_cause_primary_id'], 'length' => []],
            'FK_enregistreur0' => ['type' => 'index', 'columns' => ['user_creator_id'], 'length' => []],
            'fk_origine_raterie_20' => ['type' => 'index', 'columns' => ['rattery_father_id'], 'length' => []],
            'fk_deces_secondaire0' => ['type' => 'index', 'columns' => ['death_cause_secondary_id'], 'length' => []],
            'fk_lord_backoffice_rat_entries_lord_rats1' => ['type' => 'index', 'columns' => ['rat_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'rat_id_UNIQUE' => ['type' => 'unique', 'columns' => ['id'], 'length' => []],
            'FK_couleur0' => ['type' => 'foreign', 'columns' => ['color_id'], 'references' => ['colors', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_deces0' => ['type' => 'foreign', 'columns' => ['death_cause_primary_id'], 'references' => ['death_causes_primary', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_enregistreur0' => ['type' => 'foreign', 'columns' => ['user_creator_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_mere0' => ['type' => 'foreign', 'columns' => ['rat_mother_id'], 'references' => ['backoffice_rat_entries', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_oreilles0' => ['type' => 'foreign', 'columns' => ['earset_id'], 'references' => ['earsets', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_origine0' => ['type' => 'foreign', 'columns' => ['rattery_mother_id'], 'references' => ['ratteries', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_pere0' => ['type' => 'foreign', 'columns' => ['rat_father_id'], 'references' => ['backoffice_rat_entries', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_yeux0' => ['type' => 'foreign', 'columns' => ['eyecolor_id'], 'references' => ['eyecolors', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'Fk_proprietaire0' => ['type' => 'foreign', 'columns' => ['user_owner_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_deces_secondaire0' => ['type' => 'foreign', 'columns' => ['death_cause_secondary_id'], 'references' => ['death_causes_secondary', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_dilutions0' => ['type' => 'foreign', 'columns' => ['dilution_id'], 'references' => ['dilutions', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_lord_backoffice_rat_entries_lord_rats1' => ['type' => 'foreign', 'columns' => ['rat_id'], 'references' => ['rats', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_marquage0' => ['type' => 'foreign', 'columns' => ['marking_id'], 'references' => ['markings', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_origine_raterie_20' => ['type' => 'foreign', 'columns' => ['rattery_father_id'], 'references' => ['ratteries', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_poils0' => ['type' => 'foreign', 'columns' => ['coat_id'], 'references' => ['coats', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'status' => 1,
                'rat_id' => 1,
                'rat_name_owner' => 'Lorem ipsum dolor sit amet',
                'rat_name_pup' => 'Lorem ipsum dolor sit amet',
                'rat_sex' => '',
                'rat_pedigree_identifier' => 'Lorem ip',
                'rat_date_birth' => '2020-02-21',
                'rat_date_death' => '2020-02-21',
                'death_cause_primary_id' => 1,
                'death_cause_secondary_id' => 1,
                'rat_death_euthanized' => 1,
                'rat_death_diagnosed' => 1,
                'rat_death_necropsied' => 1,
                'rat_picture' => 'Lorem ipsum dolor sit amet',
                'rat_picture_thumbnail' => 'Lorem ipsum dolor sit amet',
                'rat_comments' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'rat_validated' => 1,
                'rattery_mother_id' => 1,
                'rattery_father_id' => 1,
                'rat_mother_id' => 1,
                'rat_father_id' => 1,
                'user_owner_id' => 1,
                'color_id' => 1,
                'earset_id' => 1,
                'eyecolor_id' => 1,
                'dilution_id' => 1,
                'coat_id' => 1,
                'marking_id' => 1,
                'singularity_id_list' => 'Lorem ipsum d',
                'user_creator_id' => 1,
                'rat_date_create' => '2020-02-21',
                'rat_date_last_update' => '2020-02-21',
            ],
        ];
        parent::init();
    }
}
