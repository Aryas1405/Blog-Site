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

Route::get('test',function(){
    return view('test');

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'admins'])->group(function ()
{
Route::get('/blogs/recycle', 'BlogController@recycle')->name('blogs.recycle');


Route::resource('categories', 'CategoryController');
Route::resource('blogs', 'BlogController');
Route::resource('tags', 'TagController');
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');
Route::resource('users', 'UserController');

Route::put('/blogs/{blog}/show/comment/store', 'CommentController@store')->name('comments.store');
Route::delete('blogs/{blog}/deleteOnlyImage', 'BlogController@deleteOnlyImage')->name('blogs.deleteOnlyImage');


});

Route::prefix('users')->name('users.')->middleware(['auth', 'users'])->group(function ()
{

Route::get('categories', 'CategoryController@userindex')->name('categories.index');
Route::get('categories.create', 'CategoryController@usercreate')->name('categories.create');


});