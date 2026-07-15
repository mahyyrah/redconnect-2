<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BloodTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BloodTypesTable Test Case
 */
class BloodTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BloodTypesTable
     */
    protected $BloodTypes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.BloodTypes',
        'app.Donors',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('BloodTypes') ? [] : ['className' => BloodTypesTable::class];
        $this->BloodTypes = $this->getTableLocator()->get('BloodTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->BloodTypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\BloodTypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\BloodTypesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
