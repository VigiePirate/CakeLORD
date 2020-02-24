<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DilutionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DilutionsTable Test Case
 */
class DilutionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DilutionsTable
     */
    protected $Dilutions;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Dilutions',
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
        $config = TableRegistry::getTableLocator()->exists('Dilutions') ? [] : ['className' => DilutionsTable::class];
        $this->Dilutions = TableRegistry::getTableLocator()->get('Dilutions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Dilutions);

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
