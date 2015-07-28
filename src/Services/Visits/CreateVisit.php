<?php

namespace Baconfy\Analytics\Services\Visits;

use Carbon\Carbon;
use DB;

class CreateVisit
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
     * @param $uuid
     * @param $ip
     * @param $location
     * @return mixed
     */
    public function fire($uuid, $ip, $location)
    {
        return $this->db->table('analytcs_visits')->insert([
            'uuid' => $uuid,
            'location' => $location,
            'ip' => $ip,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }

}