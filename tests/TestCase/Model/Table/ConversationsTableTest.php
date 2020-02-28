<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConversationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConversationsTable Test Case
 */
class ConversationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ConversationsTable
     */
    protected $Conversations;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Conversations',
        'app.Rats',
        'app.Ratteries',
        'app.Litters',
        'app.Messages',
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
        $config = TableRegistry::getTableLocator()->exists('Conversations') ? [] : ['className' => ConversationsTable::class];
        $this->Conversations = TableRegistry::getTableLocator()->get('Conversations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Conversations);

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
