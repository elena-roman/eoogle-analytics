<?php


namespace App\Service\Hits;


use App\Models\Statistics;

class HitsByPageTypeService implements Retrievable
{

    public function retrieve($startDate, $endDate, ...$filters)
    {
        return Statistics::whereBetween('created_at', [$startDate, $endDate])
            ->where('link_type', $filters[0])
            ->get();
    }
}
