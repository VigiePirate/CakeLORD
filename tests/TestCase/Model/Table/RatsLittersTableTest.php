<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RatsLittersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RatsLittersTable Test Case
 */
class RatsLittersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RatsLittersTable
     */
    protected $RatsLitters;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.RatsLitters',
        'app.Rats',
        'app.Litters',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RatsLitters') ? [] : ['className' => RatsLittersTable::class];
        $this->RatsLitters = TableRegistry::getTableLocator()->get('RatsLitters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->RatsLitters);

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
