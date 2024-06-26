<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RatsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RatsTable Test Case
 */
class RatsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RatsTable
     */
    protected $Rats;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Rats',
        'app.OwnerUsers',
        'app.Ratteries',
        'app.Colors',
        'app.Eyecolors',
        'app.Dilutions',
        'app.Markings',
        'app.Earsets',
        'app.Coats',
        'app.DeathPrimaryCauses',
        'app.DeathSecondaryCauses',
        'app.Users',
        'app.States',
        'app.Conversations',
        'app.RatSnapshots',
        'app.Litters',
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
        $config = TableRegistry::getTableLocator()->exists('Rats') ? [] : ['className' => RatsTable::class];
        $this->Rats = TableRegistry::getTableLocator()->get('Rats', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Rats);

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
