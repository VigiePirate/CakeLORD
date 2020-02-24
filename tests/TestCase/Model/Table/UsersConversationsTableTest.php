<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersConversationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersConversationsTable Test Case
 */
class UsersConversationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersConversationsTable
     */
    protected $UsersConversations;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.UsersConversations',
        'app.Users',
        'app.Conversations',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UsersConversations') ? [] : ['className' => UsersConversationsTable::class];
        $this->UsersConversations = TableRegistry::getTableLocator()->get('UsersConversations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->UsersConversations);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
