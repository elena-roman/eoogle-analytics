<?php

namespace Tests\Feature;

use App\Models\Statistics;
use App\Service\Hits\HitsByLinkService;
use App\Service\Hits\HitsByPageTypeService;
use App\Service\StatisticsBuilder;
use Mockery;
use Tests\TestCase;

class HitControllerTest extends TestCase
{
    private static $BASE_PATH = "/api/analytics/hits/";

    protected $hitsByLinkService;
    protected $hitsByPageTypeService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->hitsByLinkService = Mockery::mock(HitsByLinkService::class);
        app()->instance(HitsByLinkService::class, $this->hitsByLinkService);

        $this->hitsByPageTypeService = Mockery::mock(HitsByPageTypeService::class);
        app()->instance(HitsByPageTypeService::class, $this->hitsByPageTypeService);
    }

    /**
     * @test
     */
    public function testReturnStatus200WhenGetHitsByLink()
    {
        $statistics = $this->buildStatistics();
        $this->hitsByLinkService->shouldReceive('retrieve')
            ->once()
            ->andReturn([$statistics]);

        $response = $this->get(self::$BASE_PATH . "by-link/aLink");

        $response->assertStatus(200);
        $response->assertJsonFragment(["customer_uuid" => $statistics->customer_uuid]);
        $response->assertJsonFragment(["link" => $statistics->link]);
        $response->assertJsonFragment(["link_type" => $statistics->link_type]);
    }

    /**
     * @test
     */
    public function testReturnStatus200WhenGetHitsByLinkType()
    {
        $statistics = $this->buildStatistics();
        $this->hitsByPageTypeService->shouldReceive('retrieve')
            ->once()
            ->andReturn([$statistics]);

        $response = $this->get(self::$BASE_PATH . "by-type/homepage");

        $response->assertStatus(200);
        $response->assertJsonFragment(["customer_uuid" => $statistics->customer_uuid]);
        $response->assertJsonFragment(["link" => $statistics->link]);
        $response->assertJsonFragment(["link_type" => $statistics->link_type]);
    }

    private function buildStatistics(): Statistics {
        return (new StatisticsBuilder())->link("aLink.com")
            ->linkType("homepage")
            ->customerUuid("auuid")
            ->build();
    }
}
