<?php

use Carbon\Carbon;

if (!function_exists('get_visits')) {
    function get_visits($startDate, $endDate)
    {
        $Visits = app()->make(\Baconfy\Analytics\Services\Visits\GetVisitByPeriod::class);

        return $Visits->fire(Carbon::createFromFormat('Y-m-d', $startDate), Carbon::createFromFormat('Y-m-d', $endDate));
    }
}

if (!function_exists('graph_values')) {
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
