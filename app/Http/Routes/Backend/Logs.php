<?php

Route::group([
    'prefix'     => 'logs',
    'namespace'  => 'Logs',
    'middleware' => 'access.routeNeedsPermission:view-report-management',
], function() {
    Route::resource('report-send-logs', 'ReportSendLogsController', ['except' => ['show']]);

    Route::group(['prefix' => 'logs/{id}', 'where' => ['id' => '[0-9]+']], function() {
        Route::get('mark/{status}', 'ReportSendLogsController@mark')->name('admin.logs.logs.mark')->
        where(['status' => '[0,1]']);
    });

    Route::resource('report-read-logs', 'ReportReadLogsController', ['except' => ['show']]);
});