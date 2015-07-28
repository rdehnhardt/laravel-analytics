<?php

namespace Baconfy\Analytics\Http\Controllers;

use Baconfy\Analytics\Services\Visits;
use Carbon\Carbon;
use DB;
use Illuminate\Routing\Controller as BaseController;
use Request;

class AnalyticsController extends BaseController
{

    /**
     * @var Visits
     */
    private $visits;

    /**
     * @param Visits $visits
     */
    public function __construct(Visits $visits)
    {
        $this->visits = $visits;
    }

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
        return $this->visits->getVisits(Carbon::createFromFormat('Y-m-d', $startDate), Carbon::createFromFormat('Y-m-d', $endDate));
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

}
