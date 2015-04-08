<?php
/**
 * @author: Antoine07
 *
 * @description: example
 */

use Illuminate\Support\Facades\App;

/* ------------------------------------------------- *\
    pattern csrf
\* ------------------------------------------------- */


Route::pattern('id', '[1-9][0-9]*');

/* ------------------------------------------------- *\
    routes front
\* ------------------------------------------------- */

Route::get('/', 'FrontController@index');
Route::get('single/{id}', 'FrontController@showSingle');
Route::get('category/{id}', 'FrontController@showCategory');
Route::get('tag/{id}', 'FrontController@showTag');

/* ------------------------------------------------- *\
    routes back
\* ------------------------------------------------- */

Route::controller('dashboard', 'DashboardController');
Route::resource('student', 'StudentController');

/* ------------------------------------------------- *\
    authentification
\* ------------------------------------------------- */

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
