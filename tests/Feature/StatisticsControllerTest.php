<?php

namespace Tests\Feature;

use App\Service\TrackService;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class StatisticsControllerTest extends TestCase
{
    private static $BASE_PATH = "/api/statistics";

    protected $trackService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->trackService = Mockery::mock(TrackService::class);
        app()->instance(TrackService::class, $this->trackService);
    }

    /**
     * @test
     */
    public function testReturnStatus201WhenStore()
    {
        $this->trackService->shouldReceive('track')->once();

        $response = $this->postJson(self::$BASE_PATH, [
            'link' => 'aLink',
            'link_type' => 'homepage',
            'customer_uuid' => 'aCustomerUuid'
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }
}
