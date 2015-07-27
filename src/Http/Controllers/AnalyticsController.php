<?php

namespace Baconfy\Analytics\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;
use Request;
use DB;

class AnalyticsController extends BaseController
{

    public function visit()
    {
        $params = $this->getParams(Request::get('q'));

        DB::table('analytcs_visits')->insert([
            'uuid' => $params['uuid'],
            'location' => $params['location'],
            'ip' => $_SERVER['REMOTE_ADDR'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function visitsByPeriod($startDate, $endDate)
    {
        $key = DB::raw($this->getKey($startDate, $endDate));
        $visits = DB::raw("count(id) as visits");
        $unique = DB::raw("count(distinct uuid) as uniques");

        $visits = DB::table('analytcs_visits')
            ->select($key, $visits, $unique)
            ->where('created_at', '>=', "$startDate 00:00:00")
            ->where('created_at', '<=', "$endDate 23:59:59")
            ->groupBy('key')
            ->get();

        if (count($visits)) {
            $output = fopen("php://output", 'w') or die("Can't open php://output");
            fputcsv($output, array($this->getLabel($startDate, $endDate), 'Visitas', 'Únicas'));

            foreach ($visits as $visit) {
                fputcsv($output, [$visit->key, $visit->visits, $visit->uniques]);
            }
        }
    }

    private function getParams($q)
    {
        $q = json_decode($q);
        $params = array();

        if (is_array($q)) {
            foreach ($q as $var) {
                if (array_key_exists(0, $var) && array_key_exists(1, $var)) {
                    $params[$var[0]] = $var[1];
                }
            }
        }

        return $params;
    }

    private function getKey($startDate, $endDate)
    {
        $Start = Carbon::createFromFormat('Y-m-d', $startDate);
        $End = Carbon::createFromFormat('Y-m-d', $endDate);

        $DiffInDays = $Start->diffInDays($End);
        $DiffInMonths = $Start->diffInMonths($End);

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
        $Start = Carbon::createFromFormat('Y-m-d', $startDate);
        $End = Carbon::createFromFormat('Y-m-d', $endDate);

        $DiffInDays = $Start->diffInDays($End);
        $DiffInMonths = $Start->diffInMonths($End);

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
