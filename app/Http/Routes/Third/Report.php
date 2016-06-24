<?php

Route::group([
    'prefix'     => 'report',
    'namespace'  => 'Report',
], function() {
    /**
     * Report Management
     */
    Route::get('html/{fileName}', 'ReportController@viewHtmlReport')->name('third.report.html.view');

});