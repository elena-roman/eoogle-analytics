<?php


namespace App\Service;


use App\Models\Statistics;

class StatisticsBuilder implements Builder
{
    private $statistics;

    /**
     * StatisticsBuilder constructor.
     */
    public function __construct()
    {
        $this->statistics = new Statistics();
    }


    public function link($link): StatisticsBuilder
    {
        $this->statistics->link = $link;
        return $this;
    }

    public function linkType($link_type): StatisticsBuilder
    {
        $this->statistics->link_type = $link_type;
        return $this;
    }

    public function customerUuid($customer_uuid): StatisticsBuilder
    {
        $this->statistics->customer_uuid = $customer_uuid;
        return $this;
    }

    public function build(): Statistics
    {
       return $this->statistics;
    }
}
