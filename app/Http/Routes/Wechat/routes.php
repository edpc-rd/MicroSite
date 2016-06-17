<?php
/*
 * WeChat Routes
 */


Route::any('/', 'WechatController@serve');
Route::any('/sendMsg', 'WechatController@sendMsg');
Route::any('/uploadMedia', 'WechatController@uploadMedia');
Route::any('/sendImg', 'WechatController@sendImg');
Route::any('/getFile', 'WechatController@getFile');
Route::any('/uploadForeverMedia', 'WechatController@uploadForeverMedia');
Route::any('/getForeverFile', 'WechatController@getForeverFile');
Route::any('/getForeverFileList', 'WechatController@getForeverFileList');
Route::any('/sendNews', 'WechatController@sendNews');
Route::any('/sendMpNews', 'WechatController@sendMpNews');

Route::any('/uploadNewsImg', 'WechatController@uploadNewsImg');

Route::any('/getUserInfo', 'WechatController@getUserInfo');
Route::any('/getLoginPage', 'WechatController@getLoginPage');
Route::any('/getLoginInfo', 'WechatController@getLoginInfo');

