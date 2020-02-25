<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IncompatibilitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IncompatibilitiesTable Test Case
 */
class IncompatibilitiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\IncompatibilitiesTable
     */
    protected $Incompatibilities;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Incompatibilities',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Incompatibilities') ? [] : ['className' => IncompatibilitiesTable::class];
        $this->Incompatibilities = TableRegistry::getTableLocator()->get('Incompatibilities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Incompatibilities);

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
