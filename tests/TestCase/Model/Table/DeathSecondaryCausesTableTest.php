<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DeathSecondaryCausesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DeathSecondaryCausesTable Test Case
 */
class DeathSecondaryCausesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DeathSecondaryCausesTable
     */
    protected $DeathSecondaryCauses;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DeathSecondaryCauses',
        'app.DeathPrimaryCauses',
        'app.Rats',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('DeathSecondaryCauses') ? [] : ['className' => DeathSecondaryCausesTable::class];
        $this->DeathSecondaryCauses = TableRegistry::getTableLocator()->get('DeathSecondaryCauses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DeathSecondaryCauses);

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
