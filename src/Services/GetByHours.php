<?php

namespace Baconfy\Analytics\Services;

use Carbon\Carbon;
use DB;

class GetByHours
{

    /**
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return mixed
     */
    public static function key(Carbon $startDate, Carbon $endDate)
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
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return mixed
     */
    public static function title(Carbon $startDate, Carbon $endDate)
    {
        $hours = $startDate->diffInHours($endDate);

        if ($hours <= 24) {
            return trans('analytics::messages.hour');
        }

        if ($hours > 24 && $hours <= 720) {
            return trans('analytics::messages.day');
        }

        if ($hours > 720) {
            return trans('analytics::messages.month');
        }
    }

}