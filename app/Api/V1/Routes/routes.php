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

    $api->group(['namespace' => 'App\Api\V1\Controllers\Weixin', 'middleware' => 'jwt.auth'], function ($api) {
        $api->post('/weixin/sendMsgToTag', 'WeixinController@sendMsgToTag');
        $api->post('/weixin/sendMsgToUser', 'WeixinController@sendMsgToUser');
        $api->post('/weixin/sendImgToUser', 'WeixinController@sendImgToUser');
        $api->post('/weixin/getFile', 'WeixinController@getFile');
        $api->post('/weixin/sendMpNews', 'WeixinController@sendMpNews');
        $api->post('/weixin/getForeverFileList', 'WeixinController@getForeverFileList');
        $api->post('/weixin/uploadNewsImg', 'WeixinController@uploadNewsImg');
        $api->post('/weixin/getForeverFile', 'WeixinController@getForeverFile');
        $api->post('/weixin/sendNews', 'WeixinController@sendNews');
        $api->post('/weixin/uploadFile', 'WeixinController@uploadFile');
        $api->post('/weixin/uploadImage', 'WeixinController@uploadImage');
        $api->post('/weixin/sendReportById', 'WeixinController@sendReportById');
        $api->post('/weixin/SendReportAgain', 'WeixinController@SendReportAgain');

    });

    $api->group(['namespace' => 'App\Api\V1\Controllers\Weixin'], function ($api) {
        $api->any('/weixin/getMemberInfo', 'WeixinController@getMemberInfo');
        $api->any('/weixin/serve', 'WeixinController@serve');
    });

});