<?php

use Carbon\Carbon;

if (!function_exists('get_visits')) {
    /**
     * @param $startDate
     * @param $endDate
     * @return mixed
     */
    function get_visits($startDate, $endDate)
    {
        $Visits = app()->make(\Baconfy\Analytics\Services\Visits\GetVisitByPeriod::class);

        return $Visits->fire(Carbon::createFromFormat('Y-m-d', $startDate), Carbon::createFromFormat('Y-m-d', $endDate));
    }
}

if (!function_exists('graph_values')) {
    /**
     * @param $records
     * @param $key
     * @param bool|false $withComma
     * @return bool|string
     */
    function graph_values($records, $key, $withComma = false)
    {
        $tmp = [];

        if (count($records)) {
            foreach ($records as $record) {
                if ($withComma) {
                    $tmp[] = "'" . $record->{$key} . "'";
                } else {
                    $tmp[] = $record->{$key};
                }

            }

            return implode(',', $tmp);
        }

        return false;
    }
}
