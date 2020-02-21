<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DeathCausesPrimaryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DeathCausesPrimaryTable Test Case
 */
class DeathCausesPrimaryTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DeathCausesPrimaryTable
     */
    protected $DeathCausesPrimary;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DeathCausesPrimary',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('DeathCausesPrimary') ? [] : ['className' => DeathCausesPrimaryTable::class];
        $this->DeathCausesPrimary = TableRegistry::getTableLocator()->get('DeathCausesPrimary', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DeathCausesPrimary);

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
