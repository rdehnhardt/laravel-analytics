<?php

namespace Baconfy\Analytics\Services;

use Carbon\Carbon;
use DB;

class GetByHours
{

    /**
     * @param Cardon $startDate
     * @param Cardon $endDate
     * @return mixed
     */
    public static function key(Cardon $startDate, Cardon $endDate)
    {
        $hours = $startDate->diffInHours($endDate);

        if ($hours <= 24) {
            return '%H:00';
        }

        if ($hours > 24 && $hours <= 720) {
            return '%d';
        }

        if ($hours > 720) {
            return '%m/%Y';
        }
    }

    /**
     * @param Cardon $startDate
     * @param Cardon $endDate
     * @return mixed
     */
    public static function title(Cardon $startDate, Cardon $endDate)
    {
        $hours = $startDate->diffInHours($endDate);

        if ($hours <= 24) {
            return trans('analytics.hour');
        }

        if ($hours > 24 && $hours <= 720) {
            return trans('analytics.day');
        }

        if ($hours > 720) {
            return trans('analytics.month');
        }
    }

}