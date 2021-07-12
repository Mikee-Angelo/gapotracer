<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\LogsCivilian;

class LogsCivilianApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_logs_civilian()
    {
        $logsCivilian = LogsCivilian::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/logs_civilians', $logsCivilian
        );

        $this->assertApiResponse($logsCivilian);
    }

    /**
     * @test
     */
    public function test_read_logs_civilian()
    {
        $logsCivilian = LogsCivilian::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/logs_civilians/'.$logsCivilian->id
        );

        $this->assertApiResponse($logsCivilian->toArray());
    }

    /**
     * @test
     */
    public function test_update_logs_civilian()
    {
        $logsCivilian = LogsCivilian::factory()->create();
        $editedLogsCivilian = LogsCivilian::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/logs_civilians/'.$logsCivilian->id,
            $editedLogsCivilian
        );

        $this->assertApiResponse($editedLogsCivilian);
    }

    /**
     * @test
     */
    public function test_delete_logs_civilian()
    {
        $logsCivilian = LogsCivilian::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/logs_civilians/'.$logsCivilian->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/logs_civilians/'.$logsCivilian->id
        );

        $this->response->assertStatus(404);
    }
}
