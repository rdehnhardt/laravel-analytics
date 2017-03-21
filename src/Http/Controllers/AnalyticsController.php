<?php

namespace Rdehnhardt\Analytics\Http\Controllers;

use Rdehnhardt\Analytics\Services\GetParams;
use Rdehnhardt\Analytics\Services\Visits\CreateVisit;
use Rdehnhardt\Analytics\Services\Visits\GetVisitByPeriod;
use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;

class AnalyticsController extends BaseController
{
    public function __construct()
    {
        $middlewares = config('analytics.controller_middleware', []);

        foreach ($middlewares as $middleware => $options) {
            $this->middleware($middleware, $options);
        }
    }

    /**
     * @param CreateVisit $createVisit
     * @param GetParams $getParams
     *
     * @return void
     */
    public function visit(CreateVisit $createVisit, GetParams $getParams)
    {
        $params = $getParams->build(request('q'));

        $uuid = array_get($params, 'uuid');
        $location = array_get($params, 'location');
        $referrer = array_get($params, 'referrer');

        $createVisit->fire($uuid, $_SERVER['REMOTE_ADDR'], $location, $referrer);
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @param GetVisitByPeriod $getVisitByPeriod
     *
     * @return mixed
     */
    public function visitsByPeriod($startDate, $endDate, GetVisitByPeriod $getVisitByPeriod)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $startDate);
        $endDate = Carbon::createFromFormat('Y-m-d', $endDate);

        return $getVisitByPeriod->fire($startDate, $endDate);
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return view('analytics::file');
    }
}
