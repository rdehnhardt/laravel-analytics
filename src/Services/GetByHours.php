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

        if ($hours > 24 && $hours <= 744) {
            return '%d';
        }

        if ($hours > 744 && $hours <= 8766) {
            return '%m/%Y';
        }

        if ($hours > 8766) {
            return '%Y';
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

        if ($hours > 720 && $hours <= 8766) {
            return trans('analytics::messages.month');
        }

        if ($hours > 8766) {
            return trans('analytics::messages.year');
        }
    }

}