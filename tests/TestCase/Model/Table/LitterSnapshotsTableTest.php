<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LitterSnapshotsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LitterSnapshotsTable Test Case
 */
class LitterSnapshotsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LitterSnapshotsTable
     */
    protected $LitterSnapshots;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.LitterSnapshots',
        'app.Litters',
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
        $config = TableRegistry::getTableLocator()->exists('LitterSnapshots') ? [] : ['className' => LitterSnapshotsTable::class];
        $this->LitterSnapshots = TableRegistry::getTableLocator()->get('LitterSnapshots', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->LitterSnapshots);

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
