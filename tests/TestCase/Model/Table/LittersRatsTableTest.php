<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LittersRatsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LittersRatsTable Test Case
 */
class LittersRatsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LittersRatsTable
     */
    protected $LittersRats;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.LittersRats',
        'app.Litters',
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
        $config = TableRegistry::getTableLocator()->exists('LittersRats') ? [] : ['className' => LittersRatsTable::class];
        $this->LittersRats = TableRegistry::getTableLocator()->get('LittersRats', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->LittersRats);

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
