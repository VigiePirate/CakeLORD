<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OperatorsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OperatorsTable Test Case
 */
class OperatorsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OperatorsTable
     */
    protected $Operators;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Operators',
        'app.Compatibilities',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Operators') ? [] : ['className' => OperatorsTable::class];
        $this->Operators = TableRegistry::getTableLocator()->get('Operators', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Operators);

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
}
