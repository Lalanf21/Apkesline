<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'DashboardController@index')->name('dashboard');

// Routes dokter
Route::get('/dokter/list', 'DokterController@list_dokter')->name('list-dokter');
Route::resource('dokter', 'DokterController');