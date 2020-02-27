<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LittersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LittersTable Test Case
 */
class LittersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LittersTable
     */
    protected $Litters;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Litters',
        'app.Users',
        'app.States',
        'app.Conversations',
        'app.LitterSnapshots',
        'app.Rats',
        'app.Ratteries',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Litters') ? [] : ['className' => LittersTable::class];
        $this->Litters = TableRegistry::getTableLocator()->get('Litters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Litters);

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
