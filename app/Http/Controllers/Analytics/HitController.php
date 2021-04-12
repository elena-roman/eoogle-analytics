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
     * @OA\Get(
     * path="/api/analytics/hits/by-link/{link}",
     * summary="getHitsByLink",
     * operationId="getHitsByLink",
     * tags={"hits", "analytics"},
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
     *         type="string", format="date"
     *    )
     * ),
     * @OA\Parameter(
     *    name="end_date",
     *    in="query",
     *    required=true,
     *    @OA\Schema(
     *         type="string", format="date"
     *    )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Statistics")
     * )
     * )
     * @param $link
     * @param Request $request
     * @return JsonResponse
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
     * @OA\Get(
     * path="/api/analytics/hits//by-type/{linkType}",
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
     *         type="string", format="date"
     *    )
     * ),
     * @OA\Parameter(
     *    name="end_date",
     *    in="query",
     *    required=true,
     *    @OA\Schema(
     *         type="string", format="date"
     *    )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Statistics")
     * )
     * )
     */
    public function getHitsByLinkType($linkType, Request $request): JsonResponse
    {
        return response()->json(
            jsend_success(
                $this->hitsByPageTypeService->retrieve($request->get('start_date'), $request->get('end_date'), $linkType)
            )
        );
    }
}
