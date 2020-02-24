<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ConversationsFixture
 */
class ConversationsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'rattery_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'litter_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'rat_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'is_active' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_conversations_ratteries1' => ['type' => 'index', 'columns' => ['rattery_id'], 'length' => []],
            'fk_conversations_litters1' => ['type' => 'index', 'columns' => ['litter_id'], 'length' => []],
            'fk_conversations_rats1' => ['type' => 'index', 'columns' => ['rat_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_conversations_litters1' => ['type' => 'foreign', 'columns' => ['litter_id'], 'references' => ['litters', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_conversations_rats1' => ['type' => 'foreign', 'columns' => ['rat_id'], 'references' => ['rats', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_conversations_ratteries1' => ['type' => 'foreign', 'columns' => ['rattery_id'], 'references' => ['ratteries', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'rattery_id' => 1,
                'litter_id' => 1,
                'rat_id' => 1,
                'created' => '2020-02-24 17:46:25',
                'modified' => '2020-02-24 17:46:25',
                'is_active' => 1,
            ],
        ];
        parent::init();
    }
}
