<?php

Route::group([
    'prefix'     => 'wxconfig',
    'namespace'  => 'Wxconfig',
    'middleware' => 'access.routeNeedsPermission:view-wxconfig-management',
], function() {
    /**
     * Wxconfig Management
     */
    Route::resource('wxconfigs', 'WxconfigController', ['except' => ['show']]);

    /**
     * Specific Order
     */
    Route::group(['prefix' => 'wxconfig/{id}', 'where' => ['id' => '[0-9]+']], function() {
        Route::get('view', 'WxconfigController@view')->name('admin.wxconfig.wxconfig.view');
    });


});