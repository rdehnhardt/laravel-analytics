<?php

if (!function_exists('get_visits')) {
    function get_visits($startDate, $endDate)
    {
        $Visits = app()->make(\Baconfy\Analytics\Services\Visits::class);

        return $Visits->getVisits(Carbon::createFromFormat('Y-m-d', $startDate), Carbon::createFromFormat('Y-m-d', $endDate));
    }
}