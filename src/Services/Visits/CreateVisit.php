<?php

namespace Baconfy\Analytics\Services\Visits;

use Baconfy\Analytics\Models\Visit;

class CreateVisit
{

    /**
     * @param string $uuid
     * @param string $ip
     * @param string $location
     * @param string $referrer
     * @param array  $extra
     *
     * @return mixed
     */
    public function fire($uuid, $ip, $location, $referrer, array $extra = [])
    {
        $visit = $this->factoryVisit($uuid, $ip, $location, $referrer, $extra);

        $visit->save();
    }

    /**
     * @param string $uuid
     * @param string $ip
     * @param string $location
     * @param string $referrer
     * @param array  $extra
     *
     * @return Visit
     */
    protected function factoryVisit($uuid, $ip, $location, $referrer, array $extra = [])
    {
        $data = array_merge([
            'uuid'     => $uuid,
            'location' => $location,
            'ip'       => $ip,
            'referrer' => $referrer,
        ], $extra);

        $visit = app()->make(config('analytics.model', Visit::class));

        $visit->fill($data);

        return $visit;
    }
}