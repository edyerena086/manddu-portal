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

/**
 * ------------------------------------------------------------------------
 * Candidate Routes
 * ------------------------------------------------------------------------
 * 
 */
Route::get('candidate', 'Front\Candidate\AccountController@index');
//Candidate Account Routes
Route::post('candidate', 'Front\Candidate\AccountController@login');
Route::get('candidate/account/create', 'Front\Candidate\AccountController@create');
Route::post('candidate/account/store', 'Front\Candidate\AccountController@store');
