<?php


namespace App\Http\Controllers\Analytics;


use App\Http\Controllers\BaseController;
use App\Service\Hits\HitsByLinkService;
use App\Service\Hits\HitsByPageTypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HitController extends BaseController
{
    protected $hitsByLinkService;
    protected $hitsByPageTypeService;

    public function __construct(HitsByLinkService $hitsByLinkService, HitsByPageTypeService $hitsByPageTypeService)
    {
        $this->hitsByLinkService = $hitsByLinkService;
        $this->hitsByPageTypeService = $hitsByPageTypeService;
    }

    /**
     * @OA\Post(
     * path="/analytics/hits//by-link/{link}",
     * summary="getHitsByLinkInInterval",
     * operationId="getHitsByLinkInInterval",
     * tags={"hits"},
     * @OA\Parameter(
     *     name="link",
     *     required=true,
     *     in="path",
     *     @OA\Schema(
     *         type="string"
     *     )
     * ),
     * @OA\Parameter(
     *    name="start_date",
     *    in="query",
     *    required=true,
     *    @OA\Schema(
     *         type="date"
     *    )
     * ),
     * @OA\Parameter(
     *    name="end_date",
     *    in="query",
     *    required=true,
     *    @OA\Schema(
     *         type="date"
     *    )
     * ),
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
     */
    public function getHitsByLink($link, Request $request): JsonResponse
    {
        return response()->json(
            jsend_success(
                $this->hitsByLinkService->retrieve($request->get('start_date'), $request->get('end_date'), $link)
            )
        );
    }

    /**
     * @OA\Post(
     * path="/analytics/hits//by-type/{linkType}",
     * summary="getHitsByLinkInInterval",
     * operationId="getHitsByLinkInInterval",
     * tags={"hits"},
     * @OA\Parameter(
     *     name="linkType",
     *     required=true,
     *     in="path",
     *     @OA\Schema(
     *         type="string"
     *     )
     * ),
     * @OA\Parameter(
     *    name="start_date",
     *    in="query",
     *    required=true,
     *    @OA\Schema(
     *         type="string", format="date-time"
     *    )
     * ),
     * @OA\Parameter(
     *    name="end_date",
     *    in="query",
     *    required=true,
     *    @OA\Schema(
     *         type="string", format="date-time"
     *    )
     * ),
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
     */
    public function getHitsByPageType($pageType, Request $request): JsonResponse
    {
        return response()->json(
            jsend_success(
                $this->hitsByPageTypeService->retrieve($request->get('start_date'), $request->get('end_date'), $pageType)
            )
        );
    }
}
