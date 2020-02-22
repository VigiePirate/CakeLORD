<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BackofficeRatEntriesSingularitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BackofficeRatEntriesSingularitiesTable Test Case
 */
class BackofficeRatEntriesSingularitiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BackofficeRatEntriesSingularitiesTable
     */
    protected $BackofficeRatEntriesSingularities;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.BackofficeRatEntriesSingularities',
        'app.BackofficeRatEntries',
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
        $config = TableRegistry::getTableLocator()->exists('BackofficeRatEntriesSingularities') ? [] : ['className' => BackofficeRatEntriesSingularitiesTable::class];
        $this->BackofficeRatEntriesSingularities = TableRegistry::getTableLocator()->get('BackofficeRatEntriesSingularities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->BackofficeRatEntriesSingularities);

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
