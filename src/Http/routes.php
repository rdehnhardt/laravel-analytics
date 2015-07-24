<?php

Route::group(['prefix' => 'analytics'], function () {
    Route::get('visits', ['as' => 'visits', 'uses' => '\Baconfy\Analytics\Http\Controllers\AnalyticsController@visits']);
});
