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
     * @OA\Post(
     * path="/user-journey/{customer_uuid}",
     * summary="getUserJourney",
     * operationId="getUserJourney",
     * tags={"user-journey"},
     * @OA\Parameter(
     *     name="customer_uuid",
     *     required=true,
     *     in="path",
     *     @OA\Schema(
     *         type="uuid"
     *     )
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
    public function getUserJourney(string $userIdentifier): JsonResponse
    {
        return response()->json(
            jsend_success($this->userJourneyService->getUserJourney($userIdentifier))
        );
    }

    /**
     * @OA\Post(
     * path="/user-journey/{customer_uuid}/similar",
     * summary="getUsersJourneyByUserIdentifier",
     * operationId="getUsersJourneyByUserIdentifier",
     * tags={"user-journey"},
     * @OA\Parameter(
     *     name="customer_uuid",
     *     required=true,
     *     in="path",
     *     @OA\Schema(
     *         type="uuid"
     *     )
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
    public function getUsersJourneyByUserIdentifier($userIdentifier): JsonResponse
    {
        return response()->json(
            $this->userJourneyService->getUsersJourneyByUserIdentifier($userIdentifier)
        );
    }
}
