<?php

Route::group(['prefix' => 'analytics', 'namespace' => 'Baconfy\Analytics\Http\Controllers'], function () {
    Route::get('.js', ['as' => 'analytcs', 'uses' => 'AnalyticsController@getFile']);
    Route::get('visit', ['as' => 'visits.store', 'uses' => 'AnalyticsController@visit']);
    Route::get('visits/{start}/{end}', ['as' => 'visits', 'uses' => 'AnalyticsController@visitsByPeriod']);
});
