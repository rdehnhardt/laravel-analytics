<?php

namespace Baconfy\Analytics\Services;

use Carbon\Carbon;
use DB;

class Visits
{

    public function getVisits(Carbon $startDate, Carbon $endDate)
    {
        $visits = $this->getStorageVisits($startDate, $endDate);

        if (count($visits)) {
            $output[] = [$this->getLabel($startDate, $endDate), 'Visitas', 'Únicas'];

            foreach ($visits as $visit) {
                $output[] = [$visit->key, $visit->visits, $visit->uniques];
            }
        }

        return $output;
    }

    public function getStorageVisits(Carbon $startDate, Carbon $endDate)
    {
        $key = DB::raw($this->getKey($startDate, $endDate));
        $visits = DB::raw("count(id) as visits");
        $unique = DB::raw("count(distinct uuid) as uniques");

        return DB::table('analytcs_visits')
            ->select($key, $visits, $unique)
            ->where('created_at', '>=', "$startDate 00:00:00")
            ->where('created_at', '<=', "$endDate 23:59:59")
            ->groupBy('key')
            ->get();
    }

    private function getKey(Carbon $startDate, Carbon $endDate)
    {
        $DiffInDays = $startDate->diffInDays($endDate);
        $DiffInMonths = $startDate->diffInMonths($endDate);

        if ($DiffInDays <= 1) {
            return "date_format(created_at, '%H:00') as `key`";
        }

        if ($DiffInDays > 1 && $DiffInMonths < 1) {
            return "date_format(created_at, '%d') as `key`";
        }

        if ($DiffInMonths >= 1) {
            return "date_format(created_at, '%m') as `key`";
        }
    }

    private function getLabel($startDate, $endDate)
    {
        $DiffInDays = $startDate->diffInDays($endDate);
        $DiffInMonths = $startDate->diffInMonths($endDate);

        if ($DiffInDays <= 1) {
            return "Hora";
        }

        if ($DiffInDays > 1 && $DiffInMonths < 1) {
            return "Dia";
        }

        if ($DiffInMonths >= 1) {
            return "Mês";
        }
    }

}