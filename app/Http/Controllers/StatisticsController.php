<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatisticsRequest;
use App\Service\TrackService;
use Illuminate\Http\Response;

class StatisticsController extends BaseController
{
    protected $trackService;

    public function __construct(TrackService $trackService)
    {
        $this->trackService = $trackService;
    }

    /**
     * @OA\Post(
     *      path="/api/statistics",
     *      operationId="store",
     *      tags={"Statistics"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="link", type="string", example="https://www.google.com/"),
     *             @OA\Property(property="link_type", type="string", example="homepage"),
     *             @OA\Property(property="customer_uuid", type="string", format="uuid", example="09bfb8dc-fdc9-3bc0-a417-2eaf1f293c13"),
     *         )
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      )
     * )
     * @param StoreStatisticsRequest $request
     * @return Response
     */
    public function store(StoreStatisticsRequest $request): Response
    {
        if ($request->validated()) {
            $this->trackService->track($request);
            return response(null, Response::HTTP_CREATED);
        }
    }
}
