<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LittersContributionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LittersContributionsTable Test Case
 */
class LittersContributionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LittersContributionsTable
     */
    protected $LittersContributions;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.LittersContributions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('LittersContributions') ? [] : ['className' => LittersContributionsTable::class];
        $this->LittersContributions = TableRegistry::getTableLocator()->get('LittersContributions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->LittersContributions);

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
