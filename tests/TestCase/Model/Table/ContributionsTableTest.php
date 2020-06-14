<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContributionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContributionsTable Test Case
 */
class ContributionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ContributionsTable
     */
    protected $Contributions;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Contributions',
        'app.Ratteries',
        'app.Litters',
        'app.ContributionTypes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Contributions') ? [] : ['className' => ContributionsTable::class];
        $this->Contributions = TableRegistry::getTableLocator()->get('Contributions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Contributions);

        parent::tearDown();
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
