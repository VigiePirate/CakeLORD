<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DeathPrimaryCausesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DeathPrimaryCausesTable Test Case
 */
class DeathPrimaryCausesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DeathPrimaryCausesTable
     */
    protected $DeathPrimaryCauses;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DeathPrimaryCauses',
        'app.DeathSecondaryCauses',
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
        $config = TableRegistry::getTableLocator()->exists('DeathPrimaryCauses') ? [] : ['className' => DeathPrimaryCausesTable::class];
        $this->DeathPrimaryCauses = TableRegistry::getTableLocator()->get('DeathPrimaryCauses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DeathPrimaryCauses);

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
