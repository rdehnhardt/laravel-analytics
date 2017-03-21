<?php

return [
    'visits_table'          => 'analytics_visits',
    'model'                 => \Rdehnhardt\Analytics\Models\Visit::class,
    'default_routes'        => true,
    'controller_middleware' => [
        #'auth' => ['only' => ['visitsByPeriod']],
    ],
];