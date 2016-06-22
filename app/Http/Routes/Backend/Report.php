<?php

Route::group([
    'prefix'     => 'report',
    'namespace'  => 'Report',
    'middleware' => 'access.routeNeedsPermission:view-report-management',
], function() {
    /**
     * Report Management
     */
    Route::group(['prefix' => 'group/{group_id}'], function() {

    });

    Route::get('html/{fileName}', 'ReportController@viewHtmlReport')->name('admin.report.html.view');

});