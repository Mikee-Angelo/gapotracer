<?php namespace Tests\Repositories;

use App\Models\LogsEstablishment;
use App\Repositories\LogsEstablishmentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class LogsEstablishmentRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var LogsEstablishmentRepository
     */
    protected $logsEstablishmentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->logsEstablishmentRepo = \App::make(LogsEstablishmentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_logs_establishment()
    {
        $logsEstablishment = LogsEstablishment::factory()->make()->toArray();

        $createdLogsEstablishment = $this->logsEstablishmentRepo->create($logsEstablishment);

        $createdLogsEstablishment = $createdLogsEstablishment->toArray();
        $this->assertArrayHasKey('id', $createdLogsEstablishment);
        $this->assertNotNull($createdLogsEstablishment['id'], 'Created LogsEstablishment must have id specified');
        $this->assertNotNull(LogsEstablishment::find($createdLogsEstablishment['id']), 'LogsEstablishment with given id must be in DB');
        $this->assertModelData($logsEstablishment, $createdLogsEstablishment);
    }

    /**
     * @test read
     */
    public function test_read_logs_establishment()
    {
        $logsEstablishment = LogsEstablishment::factory()->create();

        $dbLogsEstablishment = $this->logsEstablishmentRepo->find($logsEstablishment->id);

        $dbLogsEstablishment = $dbLogsEstablishment->toArray();
        $this->assertModelData($logsEstablishment->toArray(), $dbLogsEstablishment);
    }

    /**
     * @test update
     */
    public function test_update_logs_establishment()
    {
        $logsEstablishment = LogsEstablishment::factory()->create();
        $fakeLogsEstablishment = LogsEstablishment::factory()->make()->toArray();

        $updatedLogsEstablishment = $this->logsEstablishmentRepo->update($fakeLogsEstablishment, $logsEstablishment->id);

        $this->assertModelData($fakeLogsEstablishment, $updatedLogsEstablishment->toArray());
        $dbLogsEstablishment = $this->logsEstablishmentRepo->find($logsEstablishment->id);
        $this->assertModelData($fakeLogsEstablishment, $dbLogsEstablishment->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_logs_establishment()
    {
        $logsEstablishment = LogsEstablishment::factory()->create();

        $resp = $this->logsEstablishmentRepo->delete($logsEstablishment->id);

        $this->assertTrue($resp);
        $this->assertNull(LogsEstablishment::find($logsEstablishment->id), 'LogsEstablishment should not exist in DB');
    }
}
