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
Route::get('/business_search_report', 'HomeController@business_search_report')->name('business_search_report');
Route::post('/business_result_report', 'HomeController@business_result_report')->name('business_result_report');
Route::get('/business_result_report_building', 'HomeController@business_result_report_building')->name('business_result_report_building');
Route::get('/business_result_report_staff', 'HomeController@business_result_report_staff')->name('business_result_report_staff');
Route::get('/business_search_map', 'HomeController@business_search_map')->name('business_search_map');
Route::post('/business_result_map', 'HomeController@business_result_map')->name('business_result_map');

