<?php

namespace Baconfy\Analytics\Services\Visits;

use Baconfy\Analytics\Services\GetByHours;
use Carbon\Carbon;
use DB;

class GetVisitByPeriod
{
    private $data;

    private $start;

    private $end;

    /**
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return mixed
     */
    public function fire(Carbon $startDate, Carbon $endDate)
    {
        $this->start = $startDate;
        $this->end = $endDate;

        return $this->getData();
    }

    public function getLabels()
    {
        $output = [];

        if ($this->data) {
            foreach ($this->data as $row) {
                $output[] = $row->key;
            }
        }

        return $output;
    }

    public function getTotal()
    {
        $output = [];

        if ($this->data) {
            foreach ($this->data as $row) {
                $output[] = $row->total;
            }
        }

        return $output;
    }

    public function getUniques()
    {
        $output = [];

        if ($this->data) {
            foreach ($this->data as $row) {
                $output[] = $row->uniques;
            }
        }

        return $output;
    }

    /**
     * @return mixed
     */
    private function getData()
    {
        $key = GetByHours::key($this->start, $this->end);

        $Select = DB::table('analytcs_visits')->select(
            DB::raw("date_format(created_at, '$key') as `key`"),
            DB::raw("count(uuid) as total"),
            DB::raw("count(distinct uuid) as uniques")
        );

        $Select->where('created_at', '>=', "{$this->start} 00:00:00");
        $Select->where('created_at', '<=', "{$this->end} 23:59:59");
        $Select->groupBy('key');

        $this->data = $Select->get();

        return $this->data;
    }

}