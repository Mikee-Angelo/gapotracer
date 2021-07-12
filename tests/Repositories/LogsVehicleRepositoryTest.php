<?php namespace Tests\Repositories;

use App\Models\LogsVehicle;
use App\Repositories\LogsVehicleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class LogsVehicleRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var LogsVehicleRepository
     */
    protected $logsVehicleRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->logsVehicleRepo = \App::make(LogsVehicleRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_logs_vehicle()
    {
        $logsVehicle = LogsVehicle::factory()->make()->toArray();

        $createdLogsVehicle = $this->logsVehicleRepo->create($logsVehicle);

        $createdLogsVehicle = $createdLogsVehicle->toArray();
        $this->assertArrayHasKey('id', $createdLogsVehicle);
        $this->assertNotNull($createdLogsVehicle['id'], 'Created LogsVehicle must have id specified');
        $this->assertNotNull(LogsVehicle::find($createdLogsVehicle['id']), 'LogsVehicle with given id must be in DB');
        $this->assertModelData($logsVehicle, $createdLogsVehicle);
    }

    /**
     * @test read
     */
    public function test_read_logs_vehicle()
    {
        $logsVehicle = LogsVehicle::factory()->create();

        $dbLogsVehicle = $this->logsVehicleRepo->find($logsVehicle->id);

        $dbLogsVehicle = $dbLogsVehicle->toArray();
        $this->assertModelData($logsVehicle->toArray(), $dbLogsVehicle);
    }

    /**
     * @test update
     */
    public function test_update_logs_vehicle()
    {
        $logsVehicle = LogsVehicle::factory()->create();
        $fakeLogsVehicle = LogsVehicle::factory()->make()->toArray();

        $updatedLogsVehicle = $this->logsVehicleRepo->update($fakeLogsVehicle, $logsVehicle->id);

        $this->assertModelData($fakeLogsVehicle, $updatedLogsVehicle->toArray());
        $dbLogsVehicle = $this->logsVehicleRepo->find($logsVehicle->id);
        $this->assertModelData($fakeLogsVehicle, $dbLogsVehicle->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_logs_vehicle()
    {
        $logsVehicle = LogsVehicle::factory()->create();

        $resp = $this->logsVehicleRepo->delete($logsVehicle->id);

        $this->assertTrue($resp);
        $this->assertNull(LogsVehicle::find($logsVehicle->id), 'LogsVehicle should not exist in DB');
    }
}
