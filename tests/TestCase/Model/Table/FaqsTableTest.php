<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FaqsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FaqsTable Test Case
 */
class FaqsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FaqsTable
     */
    protected $Faqs;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Faqs',
        'app.Categories',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Faqs') ? [] : ['className' => FaqsTable::class];
        $this->Faqs = TableRegistry::getTableLocator()->get('Faqs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Faqs);

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
