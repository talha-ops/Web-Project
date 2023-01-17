<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/login',function(){
    return view('login');
});

Auth::routes();
Route::get('/', 'App\Http\Controllers\UserController@landingpage');
Route::get('/campgrounds','App\Http\Controllers\UserController@Campgrounds');
Route::get('/campground/campground-detail/{id}','App\Http\Controllers\UserController@Campgrounddetail');
Route::get('/campground/createCampground', 'App\Http\Controllers\UserController@createCampground');
Route::get('/logout', 'App\Http\Controllers\UserController@logout');
Route::get('/campground/campground-detail/edit-campground/{id}', 'App\Http\Controllers\UserController@editCampground');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/campgrounds','App\Http\Controllers\UserController@storeCampground');
Route::post('/campground/campground-detail/edit/{id}','App\Http\Controllers\UserController@editCampgrounddetail');
Route::post('/campground/campground-detail/{id}/delete','App\Http\Controllers\UserController@deleteCampground');
Route::post('/campground/campground-detail/{id}','App\Http\Controllers\UserController@addComment');


