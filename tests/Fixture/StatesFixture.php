<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StatesFixture
 */
class StatesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'color' => ['type' => 'char', 'length' => 6, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'Codage hexadécimal de la composition RVB (par exemple f8d345)', 'precision' => null],
        'symbol' => ['type' => 'char', 'length' => 1, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'css_property' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'is_default' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'needs_user_action' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'needs_staff_action' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'is_reliable' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'is_visible' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        'is_searchable' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        'is_frozen' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'next_ok_state_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'next_ko_state_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'next_frozen_state_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'next_thawed_state_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_states_states1_idx' => ['type' => 'index', 'columns' => ['next_ok_state_id'], 'length' => []],
            'fk_states_states2_idx' => ['type' => 'index', 'columns' => ['next_ko_state_id'], 'length' => []],
            'fk_states_states3_idx' => ['type' => 'index', 'columns' => ['next_frozen_state_id'], 'length' => []],
            'fk_states_states4_idx' => ['type' => 'index', 'columns' => ['next_thawed_state_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'name_UNIQUE' => ['type' => 'unique', 'columns' => ['name'], 'length' => []],
            'fk_states_states1' => ['type' => 'foreign', 'columns' => ['next_ok_state_id'], 'references' => ['states', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_states_states2' => ['type' => 'foreign', 'columns' => ['next_ko_state_id'], 'references' => ['states', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_states_states3' => ['type' => 'foreign', 'columns' => ['next_frozen_state_id'], 'references' => ['states', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_states_states4' => ['type' => 'foreign', 'columns' => ['next_thawed_state_id'], 'references' => ['states', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'name' => 'Lorem ipsum dolor sit amet',
                'color' => '',
                'symbol' => '',
                'css_property' => 'Lorem ipsum dolor sit amet',
                'is_default' => 1,
                'needs_user_action' => 1,
                'needs_staff_action' => 1,
                'is_reliable' => 1,
                'is_visible' => 1,
                'is_searchable' => 1,
                'is_frozen' => 1,
                'next_ok_state_id' => 1,
                'next_ko_state_id' => 1,
                'next_frozen_state_id' => 1,
                'next_thawed_state_id' => 1,
            ],
        ];
        parent::init();
    }
}
