<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BackofficeRatEntriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BackofficeRatEntriesTable Test Case
 */
class BackofficeRatEntriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BackofficeRatEntriesTable
     */
    protected $BackofficeRatEntries;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.BackofficeRatEntries',
        'app.Rats',
        'app.DeathCausesPrimary',
        'app.DeathCausesSecondary',
        'app.Ratteries',
        'app.Users',
        'app.Colors',
        'app.Earsets',
        'app.Eyecolors',
        'app.Dilutions',
        'app.Coats',
        'app.Markings',
        'app.BackofficeRatMessages',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('BackofficeRatEntries') ? [] : ['className' => BackofficeRatEntriesTable::class];
        $this->BackofficeRatEntries = TableRegistry::getTableLocator()->get('BackofficeRatEntries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->BackofficeRatEntries);

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
