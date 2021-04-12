<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatisticsRequest;
use App\Service\TrackService;
use Illuminate\Http\Request;
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
     *      path="/statistics",
     *      operationId="store",
     *      tags={"Statistics"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreStatisticsRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      )
     * )
     */
    public function store(StoreStatisticsRequest $request): Response
    {
        if ($request->validated()) {
            $this->trackService->track($request);
            return response()->setStatusCode(Response::HTTP_CREATED);
        }
    }
}
