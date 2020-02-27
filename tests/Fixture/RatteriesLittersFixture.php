<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RatteriesLittersFixture
 */
class RatteriesLittersFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'rattery_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'litter_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'litters_contributions_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_ratteries_has_litters_litters1' => ['type' => 'index', 'columns' => ['litter_id'], 'length' => []],
            'fk_ratteries_litters_litters_contributions1' => ['type' => 'index', 'columns' => ['litters_contributions_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['rattery_id', 'litter_id'], 'length' => []],
            'fk_ratteries_has_litters_litters1' => ['type' => 'foreign', 'columns' => ['litter_id'], 'references' => ['litters', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_ratteries_has_litters_ratteries1' => ['type' => 'foreign', 'columns' => ['rattery_id'], 'references' => ['ratteries', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_ratteries_litters_litters_contributions1' => ['type' => 'foreign', 'columns' => ['litters_contributions_id'], 'references' => ['litters_contributions', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'rattery_id' => 1,
                'litter_id' => 1,
                'litters_contributions_id' => 1,
            ],
        ];
        parent::init();
    }
}
