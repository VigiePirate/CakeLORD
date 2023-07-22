<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LitterMessagesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LitterMessagesTable Test Case
 */
class LitterMessagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LitterMessagesTable
     */
    protected $LitterMessages;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.LitterMessages',
        'app.Litters',
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
        $config = $this->getTableLocator()->exists('LitterMessages') ? [] : ['className' => LitterMessagesTable::class];
        $this->LitterMessages = $this->getTableLocator()->get('LitterMessages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->LitterMessages);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LitterMessagesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LitterMessagesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
