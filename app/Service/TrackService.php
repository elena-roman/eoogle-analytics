<?php


namespace App\Service;


class TrackService
{
    public function track($request) {
        $statistics  = (new StatisticsBuilder())->customerUuid('x')->link('a')->linkType('x')->build();
        $statistics->save();
    }
}
