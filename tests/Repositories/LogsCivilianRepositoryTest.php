<?php namespace Tests\Repositories;

use App\Models\LogsCivilian;
use App\Repositories\LogsCivilianRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class LogsCivilianRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var LogsCivilianRepository
     */
    protected $logsCivilianRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->logsCivilianRepo = \App::make(LogsCivilianRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_logs_civilian()
    {
        $logsCivilian = LogsCivilian::factory()->make()->toArray();

        $createdLogsCivilian = $this->logsCivilianRepo->create($logsCivilian);

        $createdLogsCivilian = $createdLogsCivilian->toArray();
        $this->assertArrayHasKey('id', $createdLogsCivilian);
        $this->assertNotNull($createdLogsCivilian['id'], 'Created LogsCivilian must have id specified');
        $this->assertNotNull(LogsCivilian::find($createdLogsCivilian['id']), 'LogsCivilian with given id must be in DB');
        $this->assertModelData($logsCivilian, $createdLogsCivilian);
    }

    /**
     * @test read
     */
    public function test_read_logs_civilian()
    {
        $logsCivilian = LogsCivilian::factory()->create();

        $dbLogsCivilian = $this->logsCivilianRepo->find($logsCivilian->id);

        $dbLogsCivilian = $dbLogsCivilian->toArray();
        $this->assertModelData($logsCivilian->toArray(), $dbLogsCivilian);
    }

    /**
     * @test update
     */
    public function test_update_logs_civilian()
    {
        $logsCivilian = LogsCivilian::factory()->create();
        $fakeLogsCivilian = LogsCivilian::factory()->make()->toArray();

        $updatedLogsCivilian = $this->logsCivilianRepo->update($fakeLogsCivilian, $logsCivilian->id);

        $this->assertModelData($fakeLogsCivilian, $updatedLogsCivilian->toArray());
        $dbLogsCivilian = $this->logsCivilianRepo->find($logsCivilian->id);
        $this->assertModelData($fakeLogsCivilian, $dbLogsCivilian->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_logs_civilian()
    {
        $logsCivilian = LogsCivilian::factory()->create();

        $resp = $this->logsCivilianRepo->delete($logsCivilian->id);

        $this->assertTrue($resp);
        $this->assertNull(LogsCivilian::find($logsCivilian->id), 'LogsCivilian should not exist in DB');
    }
}
