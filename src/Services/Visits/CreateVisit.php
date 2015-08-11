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
     * @param $referer
     * @return mixed
     */
    public function fire($uuid, $ip, $location, $referer)
    {
        return DB::table('analytcs_visits')->insert([
            'uuid' => $uuid,
            'location' => $location,
            'ip' => $ip,
            'referer' => $referer,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }

}