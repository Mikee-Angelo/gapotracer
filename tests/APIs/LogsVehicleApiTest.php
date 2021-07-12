<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\LogsVehicle;

class LogsVehicleApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_logs_vehicle()
    {
        $logsVehicle = LogsVehicle::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/logs_vehicles', $logsVehicle
        );

        $this->assertApiResponse($logsVehicle);
    }

    /**
     * @test
     */
    public function test_read_logs_vehicle()
    {
        $logsVehicle = LogsVehicle::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/logs_vehicles/'.$logsVehicle->id
        );

        $this->assertApiResponse($logsVehicle->toArray());
    }

    /**
     * @test
     */
    public function test_update_logs_vehicle()
    {
        $logsVehicle = LogsVehicle::factory()->create();
        $editedLogsVehicle = LogsVehicle::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/logs_vehicles/'.$logsVehicle->id,
            $editedLogsVehicle
        );

        $this->assertApiResponse($editedLogsVehicle);
    }

    /**
     * @test
     */
    public function test_delete_logs_vehicle()
    {
        $logsVehicle = LogsVehicle::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/logs_vehicles/'.$logsVehicle->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/logs_vehicles/'.$logsVehicle->id
        );

        $this->response->assertStatus(404);
    }
}
