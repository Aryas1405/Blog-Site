<?php

use Illuminate\Http\Request;

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
Route::get('categories_api/index','api\CategoryController@index');
Route::delete('categories_api/delete/{category}','api\CategoryController@destroy');
// Route::post('categories_api/store','api\CategoryController@mystore');
Route::post('categories_api/store','api\CategoryController@storeupdate');

Route::get('blogs_api/index','api\BlogController@index');
Route::delete('blogs_api/delete/{id}','api\BlogController@destroy');
Route::post('blogs_api/store','api\BlogController@storeupdate');
