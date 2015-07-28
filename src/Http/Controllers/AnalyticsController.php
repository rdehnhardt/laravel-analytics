<?php

namespace Baconfy\Analytics\Http\Controllers;

use Baconfy\Analytics\Services\GetParams;
use Baconfy\Analytics\Services\Visits\CreateVisit;
use Baconfy\Analytics\Services\Visits\GetVisitByPeriod;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;
use Request;
use DB;

class AnalyticsController extends BaseController
{

    /**
     * @param CreateVisit $createVisit
     * @param GetParams $getParams
     */
    public function visit(CreateVisit $createVisit, GetParams $getParams)
    {
        $params = $getParams->build(Request::get('q'));

        $createVisit->fire($params['uuid'], $_SERVER['REMOTE_ADDR'], $params['location']);
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param GetVisitByPeriod $getVisitByPeriod
     * @return mixed
     */
    public function visitsByPeriod($startDate, $endDate, GetVisitByPeriod $getVisitByPeriod)
    {
        return $getVisitByPeriod->fire(Carbon::createFromFormat('Y-m-d', $startDate), Carbon::createFromFormat('Y-m-d', $endDate));
    }

}
