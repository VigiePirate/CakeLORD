<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RatSnapshotsFixture
 */
class RatSnapshotsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'data' => ['type' => 'text', 'length' => 4294967295, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_bin', 'comment' => '', 'precision' => null],
        'rat_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'state_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'fk_rat_snapshots_rats1' => ['type' => 'index', 'columns' => ['rat_id'], 'length' => []],
            'fk_rat_snapshots_states1' => ['type' => 'index', 'columns' => ['state_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_rat_snapshots_rats1' => ['type' => 'foreign', 'columns' => ['rat_id'], 'references' => ['rats', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_rat_snapshots_states1' => ['type' => 'foreign', 'columns' => ['state_id'], 'references' => ['states', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'data' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'rat_id' => 1,
                'state_id' => 1,
                'created' => '2020-02-26 14:20:58',
            ],
        ];
        parent::init();
    }
}
