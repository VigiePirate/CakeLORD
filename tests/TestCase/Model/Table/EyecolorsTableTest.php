<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EyecolorsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EyecolorsTable Test Case
 */
class EyecolorsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EyecolorsTable
     */
    protected $Eyecolors;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Eyecolors',
        'app.Colors',
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
        $config = TableRegistry::getTableLocator()->exists('Eyecolors') ? [] : ['className' => EyecolorsTable::class];
        $this->Eyecolors = TableRegistry::getTableLocator()->get('Eyecolors', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Eyecolors);

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
