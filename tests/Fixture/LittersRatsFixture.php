<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LittersRatsFixture
 */
class LittersRatsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'litters_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'rats_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_litters_rats_rats1' => ['type' => 'index', 'columns' => ['rats_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['litters_id', 'rats_id'], 'length' => []],
            'fk_litters_rats_litters1' => ['type' => 'foreign', 'columns' => ['litters_id'], 'references' => ['litters', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_litters_rats_rats1' => ['type' => 'foreign', 'columns' => ['rats_id'], 'references' => ['rats', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'litters_id' => 1,
                'rats_id' => 1,
            ],
        ];
        parent::init();
    }
}
