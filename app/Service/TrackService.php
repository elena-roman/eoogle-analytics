<?php


namespace App\Service;


use App\Http\Requests\StoreStatisticsRequest;

class TrackService
{
    public function track(StoreStatisticsRequest $request) {
        $statistics  = (new StatisticsBuilder())->link($request->getLink())
            ->linkType($request->getLinkType())
            ->customerUuid($request->getCustomerUuid())
            ->build();
        $statistics->save();
    }
}
