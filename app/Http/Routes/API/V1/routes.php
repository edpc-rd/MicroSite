<?php
/*
 * Dingo Api Routes
 */
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\V1\Controllers\User','middleware' => 'jwt.auth'], function($api) {
        $api->get('/users/all', 'UserController@show');
        $api->get('/users/authUser', 'UserController@getAuthenticatedUser');
    });

    $api->group(['namespace' => 'App\Api\V1\Controllers\Auth'], function($api) {
        $api->get('/auth/login', 'AuthController@authenticate');
    });

    $api->group(['namespace' => 'App\Api\V1\Controllers\Report','middleware' => 'jwt.auth'], function($api) {
        $api->post('/report/uploadFile', 'SnapshotController@uploadFile');
    });

    $api->group(['namespace' => 'App\Api\V1\Controllers\Weixin','middleware' => 'jwt.auth'], function($api) {
        $api->get('/weixin/sendMsgToTag', 'WeixinController@sendMsgToTag');
        $api->get('/weixin/sendImgToUser', 'WeixinController@sendImgToUser');
        $api->get('/weixin/getFile', 'WeixinController@getFile');
        $api->any('/weixin/sendMpNews', 'WeixinController@sendMpNews');
        $api->any('/weixin/getForeverFileList', 'WeixinController@getForeverFileList');
        $api->any('/weixin/uploadNewsImg', 'WeixinController@uploadNewsImg');
        $api->any('/weixin/getForeverFile', 'WeixinController@getForeverFile');
        $api->any('/weixin/sendNews', 'WeixinController@sendNews');
        $api->any('/weixin/uploadFile', 'WeixinController@uploadFile');
        $api->any('/weixin/uploadImage', 'WeixinController@uploadImage');
        $api->any('/weixin/sendMpNews_test', 'WeixinController@sendMpNews_test');
    });

    $api->group(['namespace' => 'App\Api\V1\Controllers\Weixin'], function($api) {
        $api->any('/weixin/getMemberInfo', 'WeixinController@getMemberInfo');
        $api->any('/weixin/serve', 'WeixinController@serve');
    });

});