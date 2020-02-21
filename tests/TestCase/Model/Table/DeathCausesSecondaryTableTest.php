<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DeathCausesSecondaryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DeathCausesSecondaryTable Test Case
 */
class DeathCausesSecondaryTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DeathCausesSecondaryTable
     */
    protected $DeathCausesSecondary;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DeathCausesSecondary',
        'app.DeathCausesPrimary',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('DeathCausesSecondary') ? [] : ['className' => DeathCausesSecondaryTable::class];
        $this->DeathCausesSecondary = TableRegistry::getTableLocator()->get('DeathCausesSecondary', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DeathCausesSecondary);

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
