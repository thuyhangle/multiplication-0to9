<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::get('/', 'Controller@getBegin');
    Route::get('/exercise', 'Controller@getMulti');
    Route::get('/refresh', 'Controller@refreshMulti');
    Route::get('/score', 'Controller@getScore');
    Route::post('/exercise', 'Controller@postMulti');
});
