<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ContributionsFixture
 */
class ContributionsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'rattery_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'litter_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'contribution_type_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_ratteries_litters_litters1_idx' => ['type' => 'index', 'columns' => ['litter_id'], 'length' => []],
            'fk_ratteries_litters_ratteries1_idx' => ['type' => 'index', 'columns' => ['rattery_id'], 'length' => []],
            'fk_contributions_contribution_types1_idx' => ['type' => 'index', 'columns' => ['contribution_type_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_contributions_has_contribution_types1' => ['type' => 'foreign', 'columns' => ['contribution_type_id'], 'references' => ['contribution_types', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_ratteries_has_litters_litters1' => ['type' => 'foreign', 'columns' => ['litter_id'], 'references' => ['litters', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_ratteries_has_litters_ratteries1' => ['type' => 'foreign', 'columns' => ['rattery_id'], 'references' => ['ratteries', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // phpcs:enable
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
                'rattery_id' => 1,
                'litter_id' => 1,
                'contribution_type_id' => 1,
            ],
        ];
        parent::init();
    }
}
