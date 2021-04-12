<?php


namespace App\Service\Hits;


use App\Models\Statistics;

class HitsByLinkService implements Retrievable
{

    public function retrieve($startDate, $endDate, ...$filters)
    {
        return Statistics::whereBetween('created_at', [$startDate, $endDate])
            ->where('link', $filters[0])
            ->get();
    }
}
