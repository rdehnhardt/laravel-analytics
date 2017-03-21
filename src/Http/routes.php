<?php

Route::group(['namespace' => 'Rdehnhardt\Analytics\Http\Controllers'], function () {
    Route::get('analytics.js', ['as' => 'analytcs', 'uses' => 'AnalyticsController@getFile']);
    Route::get('analytics/visit', ['as' => 'visits.store', 'uses' => 'AnalyticsController@visit']);
    Route::get('analytics/visits/{start}/{end}', ['as' => 'visits', 'uses' => 'AnalyticsController@visitsByPeriod']);
});
