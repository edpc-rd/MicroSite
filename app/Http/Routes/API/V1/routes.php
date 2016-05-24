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
    
});