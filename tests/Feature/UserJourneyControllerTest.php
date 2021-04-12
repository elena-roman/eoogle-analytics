<?php

namespace Tests\Feature;

use App\Models\Statistics;
use App\Service\StatisticsBuilder;
use App\Service\UserJourneyService;
use Mockery;
use Tests\TestCase;

class UserJourneyControllerTest extends TestCase
{
    private static $BASE_PATH = "/api/analytics/user-journey/";

    protected $userJourneyService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userJourneyService = Mockery::mock(UserJourneyService::class);
        app()->instance(UserJourneyService::class, $this->userJourneyService);
    }

    /**
     * @test
     */
    public function testReturnStatus200WhenGetUserJourney()
    {
        $statistics = $this->buildStatistics();
        $this->userJourneyService->shouldReceive("getUserJourney")
            ->once()
            ->andReturn([$statistics]);

        $response = $this->get(self::$BASE_PATH . "aCustomerUuid");

        $response->assertStatus(200);
        $response->assertJsonFragment(["customer_uuid" => $statistics->customer_uuid]);
        $response->assertJsonFragment(["link" => $statistics->link]);
        $response->assertJsonFragment(["link_type" => $statistics->link_type]);
    }

    /**
     * @test
     */
    public function testReturnStatus200WhenGetUsersByUserJourney()
    {
        $expectedUserUuid = 'expectedUserUuid';
        $this->userJourneyService->shouldReceive('getUsersByUserJourney')
            ->once()
            ->andReturn([$expectedUserUuid]);

        $response = $this->get(self::$BASE_PATH . "aCustomerUuid/similar");

        $response->assertStatus(200);
        $response->assertJsonFragment([$expectedUserUuid]);
    }

    private function buildStatistics(): Statistics {
        return (new StatisticsBuilder())->link("aLink.com")
            ->linkType("homepage")
            ->customerUuid("aCustomerUuid")
            ->build();
    }
}
