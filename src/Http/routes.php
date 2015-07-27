<?php

Route::group(['prefix' => 'analytics'], function () {
    Route::get('visit', ['as' => 'visits', 'uses' => '\Baconfy\Analytics\Http\Controllers\AnalyticsController@visit']);
    Route::get('visits/{start}/{end}', ['as' => 'visits', 'uses' => '\Baconfy\Analytics\Http\Controllers\AnalyticsController@visitsByPeriod']);
});
