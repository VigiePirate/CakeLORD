<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContributionTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContributionTypesTable Test Case
 */
class ContributionTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ContributionTypesTable
     */
    protected $ContributionTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ContributionTypes',
        'app.Contributions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ContributionTypes') ? [] : ['className' => ContributionTypesTable::class];
        $this->ContributionTypes = TableRegistry::getTableLocator()->get('ContributionTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ContributionTypes);

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
