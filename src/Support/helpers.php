<?php

if (!function_exists('get_visits')) {
    /**
     * Get visits by date
     *
     * @param $startDate
     * @param $endDate
     * @return mixed
     */
    function get_visits($startDate, $endDate)
    {
        $Visits = app()->make(\Baconfy\Analytics\Services\Visits::class);

        return $Visits->getVisits(Carbon::createFromFormat('Y-m-d', $startDate), Carbon::createFromFormat('Y-m-d', $endDate));
    }
}