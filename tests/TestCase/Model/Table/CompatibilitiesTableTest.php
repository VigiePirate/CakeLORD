<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CompatibilitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CompatibilitiesTable Test Case
 */
class CompatibilitiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CompatibilitiesTable
     */
    protected $Compatibilities;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Compatibilities',
        'app.Operators',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Compatibilities') ? [] : ['className' => CompatibilitiesTable::class];
        $this->Compatibilities = TableRegistry::getTableLocator()->get('Compatibilities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Compatibilities);

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
