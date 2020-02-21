<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RatsSingularitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RatsSingularitiesTable Test Case
 */
class RatsSingularitiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RatsSingularitiesTable
     */
    protected $RatsSingularities;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.RatsSingularities',
        'app.Rats',
        'app.Singularities',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RatsSingularities') ? [] : ['className' => RatsSingularitiesTable::class];
        $this->RatsSingularities = TableRegistry::getTableLocator()->get('RatsSingularities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->RatsSingularities);

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
