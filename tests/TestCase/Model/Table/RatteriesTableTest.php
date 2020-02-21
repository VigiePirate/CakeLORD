<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RatteriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RatteriesTable Test Case
 */
class RatteriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RatteriesTable
     */
    protected $Ratteries;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Ratteries',
        'app.Users',
        'app.BackofficeRatteryMessages',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Ratteries') ? [] : ['className' => RatteriesTable::class];
        $this->Ratteries = TableRegistry::getTableLocator()->get('Ratteries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Ratteries);

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
