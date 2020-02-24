<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RatterySnapshotsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RatterySnapshotsTable Test Case
 */
class RatterySnapshotsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RatterySnapshotsTable
     */
    protected $RatterySnapshots;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.RatterySnapshots',
        'app.Ratteries',
        'app.States',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RatterySnapshots') ? [] : ['className' => RatterySnapshotsTable::class];
        $this->RatterySnapshots = TableRegistry::getTableLocator()->get('RatterySnapshots', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->RatterySnapshots);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
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
