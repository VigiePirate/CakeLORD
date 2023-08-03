<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RatteryMessagesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RatteryMessagesTable Test Case
 */
class RatteryMessagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RatteryMessagesTable
     */
    protected $RatteryMessages;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.RatteryMessages',
        'app.Ratteries',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('RatteryMessages') ? [] : ['className' => RatteryMessagesTable::class];
        $this->RatteryMessages = $this->getTableLocator()->get('RatteryMessages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->RatteryMessages);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\RatteryMessagesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\RatteryMessagesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
