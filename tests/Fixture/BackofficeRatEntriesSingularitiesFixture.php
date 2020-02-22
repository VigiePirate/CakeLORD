<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BackofficeRatEntriesSingularitiesFixture
 */
class BackofficeRatEntriesSingularitiesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'backoffice_rat_entries_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'singularities_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_backoffice_rat_entries_has_singularities_singularities1' => ['type' => 'index', 'columns' => ['singularities_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['backoffice_rat_entries_id', 'singularities_id'], 'length' => []],
            'fk_backoffice_rat_entries_has_singularities_backoffice_rat_en1' => ['type' => 'foreign', 'columns' => ['backoffice_rat_entries_id'], 'references' => ['backoffice_rat_entries', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_backoffice_rat_entries_has_singularities_singularities1' => ['type' => 'foreign', 'columns' => ['singularities_id'], 'references' => ['singularities', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'backoffice_rat_entries_id' => 1,
                'singularities_id' => 1,
            ],
        ];
        parent::init();
    }
}
