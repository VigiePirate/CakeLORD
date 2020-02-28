<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RatteriesLittersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RatteriesLittersTable Test Case
 */
class RatteriesLittersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RatteriesLittersTable
     */
    protected $RatteriesLitters;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.RatteriesLitters',
        'app.Ratteries',
        'app.Litters',
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
        $config = TableRegistry::getTableLocator()->exists('RatteriesLitters') ? [] : ['className' => RatteriesLittersTable::class];
        $this->RatteriesLitters = TableRegistry::getTableLocator()->get('RatteriesLitters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->RatteriesLitters);

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
