<?php


namespace App\Service;


use App\Models\Statistics;
use Illuminate\Support\Facades\DB;

class UserJourneyService
{
    public function getUserJourney(string $userIdentifier)
    {
        return Statistics::where('customer_uuid', $userIdentifier)
            ->orderBy('created_at')
            ->get();
    }

    public function getUsersByUserJourney($userIdentifier)
    {
        $userJourney = $this->getUserJourney($userIdentifier)
            ->map(function ($stats) {
                return $stats->link;
            })
            ->join(",");

        return DB::table("statistics")
            ->select('customer_uuid')
            ->groupBy('customer_uuid')
            ->havingRaw('GROUP_CONCAT(link) = ?', [$userJourney])
            // if we want all users that have the journey + extra pages before or after
//            ->havingRaw('FIND_IN_SET("?", GROUP_CONCAT(link))', $userJourney)
            ->get();
    }
}
