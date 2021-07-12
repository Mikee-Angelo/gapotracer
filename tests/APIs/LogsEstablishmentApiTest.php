<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\LogsEstablishment;

class LogsEstablishmentApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_logs_establishment()
    {
        $logsEstablishment = LogsEstablishment::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/logs_establishments', $logsEstablishment
        );

        $this->assertApiResponse($logsEstablishment);
    }

    /**
     * @test
     */
    public function test_read_logs_establishment()
    {
        $logsEstablishment = LogsEstablishment::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/logs_establishments/'.$logsEstablishment->id
        );

        $this->assertApiResponse($logsEstablishment->toArray());
    }

    /**
     * @test
     */
    public function test_update_logs_establishment()
    {
        $logsEstablishment = LogsEstablishment::factory()->create();
        $editedLogsEstablishment = LogsEstablishment::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/logs_establishments/'.$logsEstablishment->id,
            $editedLogsEstablishment
        );

        $this->assertApiResponse($editedLogsEstablishment);
    }

    /**
     * @test
     */
    public function test_delete_logs_establishment()
    {
        $logsEstablishment = LogsEstablishment::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/logs_establishments/'.$logsEstablishment->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/logs_establishments/'.$logsEstablishment->id
        );

        $this->response->assertStatus(404);
    }
}
