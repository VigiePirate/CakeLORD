<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\RatsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\RatsController Test Case
 *
 * @uses \App\Controller\RatsController
 */
class RatsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Rats',
        'app.DeathPrimaryCauses',
        'app.DeathSecondaryCauses',
        'app.MotherRatteries',
        'app.FatherRatteries',
        'app.Litters',
        'app.OwnerUsers',
        'app.Colors',
        'app.Earsets',
        'app.Eyecolors',
        'app.Dilutions',
        'app.Coats',
        'app.Markings',
        'app.Users',
        'app.States',
        'app.Ratteries',
        'app.Conversations',
        'app.RatSnapshots',
        'app.Singularities',
        'app.RatsSingularities',
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
