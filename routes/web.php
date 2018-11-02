<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/pop', 'HomeController@index2');
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');
//Route::post('/postajax','AjaxController@post'); //devuelve por aca postajax es llamado desde el javascript ajax
Route::post('/LineString','AjaxController@postLine');
Route::post('/Point','AjaxController@postPoint');
Route::post('/InfoPoint','AjaxController@postInfoPoint');
Route::post('/Edit','AjaxController@postEdit');
Route::post('/Delete','AjaxController@postDelete');
Route::post('/misDatos','AjaxController@postMyData');
Route::post('/Buscar','AjaxController@postSearch');

Route::get('logeo/{proveedor}', 'Auth\SocialController@irAlProveedor')->name('social.provider');
Route::get('autenticacion/{provider}/callback', 'Auth\SocialController@tomarCallback')->name('social.callback');
//Route::post('/perfil/foto', 'ProfileController@updatePhoto');
Route::post('/perfil/foto', 'AjaxController@updatePhoto');