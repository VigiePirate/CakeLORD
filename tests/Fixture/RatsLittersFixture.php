<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RatsLittersFixture
 */
class RatsLittersFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'rat_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'litter_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_rats_has_litters_litters1' => ['type' => 'index', 'columns' => ['litter_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['rat_id', 'litter_id'], 'length' => []],
            'fk_rats_has_litters_litters1' => ['type' => 'foreign', 'columns' => ['litter_id'], 'references' => ['litters', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_rats_has_litters_rats1' => ['type' => 'foreign', 'columns' => ['rat_id'], 'references' => ['rats', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'rat_id' => 1,
                'litter_id' => 1,
            ],
        ];
        parent::init();
    }
}
