<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/loginAPI', 'AdminController@loginAPI');
Route::get('/productAPI', 'AdminController@productAPI');
Route::post('/refreshTokenAPI', 'AdminController@refreshTokenAPI');
Route::get('list-product','APIController@listProduct');
Route::get('search/{data}','APIController@searchData');
//jwt
Route::post('login', 'APIController@login');
Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('logout', 'APIController@logout');
    Route::get('me', 'APIController@me');
    Route::post('token/refresh', 'APIController@refresh');

});
