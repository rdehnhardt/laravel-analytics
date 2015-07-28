<?php

namespace Baconfy\Analytics\Services\Visits;

use Baconfy\Analytics\Services\GetByHours;
use Baconfy\Analytics\Services\GetKeyByHours;
use DB;

class GetVisitByPeriod
{
    /**
     * @var DB
     */
    private $db;

    /**
     * @param DB $db
     */
    public function __construct(DB $db)
    {
        $this->db = $db;
    }


    /**
     * @param Cardon $startDate
     * @param Cardon $endDate
     * @return mixed
     */
    public function fire(Cardon $startDate, Cardon $endDate)
    {
        $visits = $this->getData($startDate, $endDate);
        $output[] = [GetByHours::title($startDate, $endDate), trans('analytics.visits'), trans('analytics.unique')];

        if (count($visits)) {
            foreach ($visits as $visit) {
                $output[] = [$visit['key'], $visit['visits'], $visit['uniques']];
            }
        }

        return $output;
    }

    /**
     * @param Cardon $startDate
     * @param Cardon $endDate
     * @return mixed
     */
    private function getData(Cardon $startDate, Cardon $endDate)
    {
        $key = GetKeyByHours::key($startDate, $endDate);

        $Select = $this->db->table('analytcs_visits')->select(
            DB::raw("date_format(created_at, '$key') as `key`"),
            DB::raw("count(uuid) as visits"),
            DB::raw("count(distinct uuid) as uniques")
        );

        $Select->where('created_at', '>=', "$startDate 00:00:00");
        $Select->where('created_at', '<=', "$endDate 23:59:59");
        $Select->groupBy('key');

        return $Select->get();
    }

}