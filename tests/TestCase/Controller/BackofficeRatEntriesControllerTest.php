<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\BackofficeRatEntriesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\BackofficeRatEntriesController Test Case
 *
 * @uses \App\Controller\BackofficeRatEntriesController
 */
class BackofficeRatEntriesControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
     * Test index method
     *
     * @return void
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
