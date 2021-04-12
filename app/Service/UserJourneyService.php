<?php


namespace App\Service;


use App\Models\Statistics;

class UserJourneyService
{
    public function getUserJourney(string $userIdentifier)
    {
        return Statistics::where('customer_uuid', $userIdentifier)->orderBy('created_at');
    }

    public function getUsersJourneyByUserIdentifier($userIdentifier)
    {
        return Statistics::where('customer_uuid', $userIdentifier)->orderBy('created_at');
    }
}
