<?php

namespace Baconfy\Analytics\Services\Visits;

use Carbon\Carbon;
use DB;

class CreateVisit
{

    /**
     * @param $uuid
     * @param $ip
     * @param $location
     * @param $referrer
     *
     * @return mixed
     */
    public function fire($uuid, $ip, $location, $referrer)
    {
        return DB::table($this->getTable())->insert([
            'uuid'       => $uuid,
            'location'   => $location,
            'ip'         => $ip,
            'referrer'   => $referrer,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return config('analytics.visits_table', 'analytics_visits');
    }

}