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
        Route::get('mark/{status}', 'WxconfigController@mark')->name('admin.wxconfig.wxconfig.mark')->
        where(['status' => '[0,1]']);
        Route::get('check', 'WxconfigController@check')->name('admin.wxconfig.wxconfig.check');
        Route::post('check', 'WxconfigController@check')->name('admin.wxconfig.wxconfig.check');
        Route::get('view', 'WxconfigController@view')->name('admin.wxconfig.wxconfig.view');
    });


});
