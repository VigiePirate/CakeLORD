<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LittersFixture
 */
class LittersFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'mating_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'birth_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'pups_number' => ['type' => 'tinyinteger', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'pups_number_stillborn' => ['type' => 'tinyinteger', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'comments' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'mother_rat_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'father_rat_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'breeder_user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'fk_lord_portee_lord_rats1' => ['type' => 'index', 'columns' => ['mother_rat_id'], 'length' => []],
            'fk_lord_portee_lord_rats2' => ['type' => 'index', 'columns' => ['father_rat_id'], 'length' => []],
            'fk_lord_portee_lord_utilisateurs1' => ['type' => 'index', 'columns' => ['breeder_user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_lord_portee_lord_rats1' => ['type' => 'foreign', 'columns' => ['mother_rat_id'], 'references' => ['rats', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_lord_portee_lord_rats2' => ['type' => 'foreign', 'columns' => ['father_rat_id'], 'references' => ['rats', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_lord_portee_lord_utilisateurs1' => ['type' => 'foreign', 'columns' => ['breeder_user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'mating_date' => '2020-02-22',
                'birth_date' => '2020-02-22',
                'pups_number' => 1,
                'pups_number_stillborn' => 1,
                'comments' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'mother_rat_id' => 1,
                'father_rat_id' => 1,
                'breeder_user_id' => 1,
                'created' => '2020-02-22 11:39:55',
                'modified' => '2020-02-22 11:39:55',
            ],
        ];
        parent::init();
    }
}
