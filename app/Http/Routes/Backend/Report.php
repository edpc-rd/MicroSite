<?php

Route::group([
    'prefix'     => 'report',
    'namespace'  => 'Report',
    'middleware' => 'access.routeNeedsPermission:view-report-management',
], function() {
    /**
     * Report Management
     */
    Route::resource('groups', 'ReportGroupController', ['except' => ['show']]);
    Route::resource('parameters', 'ReportParameterController', ['except' => ['show']]);
    Route::resource('subscriptions', 'SubscriptionController', ['except' => ['show']]);
    Route::resource('reports', 'ReportController', ['except' => ['show']]);

    /**
     * Specific Order
     */
    Route::group(['prefix' => 'report/{report_id}', 'where' => ['report_id' => '[0-9]+']], function() {

        Route::get('mark/{status}', 'ReportController@mark')->name('admin.report.report.mark')->
        where(['status' => '[0,1]']);
        Route::get('view', 'ReportController@view')->name('admin.report.report.view');

    });

    Route::group(['prefix' => 'reports'], function(){
        Route::any('filterStatus/{status}', 'ReportController@filterStatus')
            ->name('admin.report.reports.filterStatus')->where(['status' => '[0,1]']);



    });
    Route::group(['prefix' => 'groups'], function() {
        Route::post('update-sort', 'ReportGroupController@updateSort')->name('admin.report.groups.update-sort');
    });

    Route::get('html/{fileName}', 'ReportController@viewHtmlReport')->name('admin.report.html.view');

});