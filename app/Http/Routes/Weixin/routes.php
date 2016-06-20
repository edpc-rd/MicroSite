<?php
/*
 * WeiXin Routes
 */


Route::any('/', 'WeixinController@serve');
Route::any('/sendMsg', 'WeixinController@sendMsg');
Route::any('/uploadMedia', 'WeixinController@uploadMedia');
Route::any('/sendImg', 'WeixinController@sendImg');
Route::any('/getFile', 'WeixinController@getFile');
Route::any('/uploadForeverMedia', 'WeixinController@uploadForeverMedia');
Route::any('/getForeverFile', 'WeixinController@getForeverFile');
Route::any('/getForeverFileList', 'WeixinController@getForeverFileList');
Route::any('/sendNews', 'WeixinController@sendNews');
Route::any('/sendMpNews', 'WeixinController@sendMpNews');

Route::any('/uploadNewsImg', 'WeixinController@uploadNewsImg');

Route::any('/getUserInfo', 'WeixinController@getUserInfo');
Route::any('/getLoginPage', 'WeixinController@getLoginPage');
Route::any('/getLoginInfo', 'WeixinController@getLoginInfo');

