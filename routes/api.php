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

//USERS
Route::group([
  'middleware' => ['api'],
  'prefix' => 'users'

], function ($router) {

  Route::post('', 'UserController@register');
  Route::get('', 'UserController@list');
  Route::get('{user_id}', 'UserController@getById');
  Route::put('{user_id}', 'UserController@edit');
  Route::delete('{user_id}', 'UserController@remove');

});
