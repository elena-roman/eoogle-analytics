<?php


namespace App\Http\Controllers\Analytics;


use App\Http\Controllers\BaseController;
use App\Service\UserJourneyService;
use Illuminate\Http\JsonResponse;

class UserJourneyController extends BaseController
{
    protected $userJourneyService;

    public function __construct(UserJourneyService $userJourneyService)
    {
        $this->userJourneyService = $userJourneyService;
    }

    /**
     * @OA\Get(
     * path="/api/analytics/user-journey/{customer_uuid}",
     * summary="getUserJourney",
     * operationId="getUserJourney",
     * tags={"user-journey"},
     * @OA\Parameter(
     *     name="customer_uuid",
     *     required=true,
     *     in="path",
     *     @OA\Schema(
     *         type="string", format="uuid"
     *     )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Statistics")
     * )
     * )
     */
    public function getUserJourney($userIdentifier): JsonResponse
    {
        return response()->json(
            jsend_success($this->userJourneyService->getUserJourney($userIdentifier))
        );
    }

    /**
     * @OA\Get(
     * path="/api/analytics/user-journey/{customer_uuid}/similar",
     * summary="getUsersJourneyByUserIdentifier",
     * operationId="getUsersJourneyByUserIdentifier",
     * tags={"user-journey"},
     * @OA\Parameter(
     *     name="customer_uuid",
     *     required=true,
     *     in="path",
     *     @OA\Schema(
     *         type="string", format="uuid"
     *     )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Successful operation",
     * )
     * )
     */
    public function getUsersByUserJourney($userIdentifier): JsonResponse
    {
        return response()->json(
            $this->userJourneyService->getUsersByUserJourney($userIdentifier)
        );
    }
}
