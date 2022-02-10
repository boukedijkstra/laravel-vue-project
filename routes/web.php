<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/home', 'PageController@boats')->name('home');
    Route::get('/boten', 'PageController@boats')->name('boten');
    Route::get('/jobs', 'PageController@jobs')->name('jobs');
    Route::get('/periodics', 'PageController@periodics')->name('periodics');

    Route::get('api/boats', 'BoatController@index');
    Route::get('api/boats/{boat}/jobs', 'BoatController@jobs')->name('boats.jobs');

    Route::get('api/jobs', 'JobController@index');
    Route::get('api/jobs/{job}', 'JobController@show');
    Route::post('api/jobs', 'JobController@store');
    Route::put('api/jobs/{job}', 'JobController@update');
    Route::put('api/jobs/complete/{job}', 'JobController@completeJob');
    Route::delete('api/jobs/{job}', 'JobController@destroy');

    Route::get('api/periodics', 'PeriodicController@index');

    Route::get('api/users', 'UserController@index');

});

