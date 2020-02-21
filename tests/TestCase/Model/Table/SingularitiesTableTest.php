<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SingularitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SingularitiesTable Test Case
 */
class SingularitiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SingularitiesTable
     */
    protected $Singularities;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Singularities',
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
        $config = TableRegistry::getTableLocator()->exists('Singularities') ? [] : ['className' => SingularitiesTable::class];
        $this->Singularities = TableRegistry::getTableLocator()->get('Singularities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Singularities);

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
