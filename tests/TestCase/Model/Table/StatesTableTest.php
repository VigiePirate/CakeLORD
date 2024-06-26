<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StatesTable Test Case
 */
class StatesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\StatesTable
     */
    protected $States;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.States',
        'app.LitterSnapshots',
        'app.Litters',
        'app.RatSnapshots',
        'app.Rats',
        'app.Ratteries',
        'app.RatterySnapshots',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('States') ? [] : ['className' => StatesTable::class];
        $this->States = TableRegistry::getTableLocator()->get('States', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->States);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
