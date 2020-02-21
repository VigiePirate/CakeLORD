<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BackofficeRatteryMessagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BackofficeRatteryMessagesTable Test Case
 */
class BackofficeRatteryMessagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BackofficeRatteryMessagesTable
     */
    protected $BackofficeRatteryMessages;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.BackofficeRatteryMessages',
        'app.Ratteries',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('BackofficeRatteryMessages') ? [] : ['className' => BackofficeRatteryMessagesTable::class];
        $this->BackofficeRatteryMessages = TableRegistry::getTableLocator()->get('BackofficeRatteryMessages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->BackofficeRatteryMessages);

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
