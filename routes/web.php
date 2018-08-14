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
Route::middleware('guest')->get('candidate', 'Front\Candidate\AccountController@index');
//Candidate Account Routes
Route::middleware('guest')->post('candidate', 'Front\Candidate\AccountController@login');
Route::middleware('guest')->get('candidate/account/create', 'Front\Candidate\AccountController@create');
Route::middleware('guest')->post('candidate/account/store', 'Front\Candidate\AccountController@store');
