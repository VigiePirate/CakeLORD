<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CoatsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CoatsTable Test Case
 */
class CoatsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CoatsTable
     */
    protected $Coats;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Coats',
        'app.BackofficeRatEntries',
        'app.Rats',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Coats') ? [] : ['className' => CoatsTable::class];
        $this->Coats = TableRegistry::getTableLocator()->get('Coats', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Coats);

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
