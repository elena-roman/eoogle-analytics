<?php


namespace App\Service\Hits;


interface Retrievable
{
    public function retrieve($startDate, $endDate, ...$filters);
}
