<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RatSnapshotsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RatSnapshotsTable Test Case
 */
class RatSnapshotsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RatSnapshotsTable
     */
    protected $RatSnapshots;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.RatSnapshots',
        'app.Rats',
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
        $config = TableRegistry::getTableLocator()->exists('RatSnapshots') ? [] : ['className' => RatSnapshotsTable::class];
        $this->RatSnapshots = TableRegistry::getTableLocator()->get('RatSnapshots', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->RatSnapshots);

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
