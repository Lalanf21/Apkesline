<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'DashboardController@index')->name('dashboard');

// Routes dokter
Route::get('/dokter/list', 'DokterController@list_dokter')->name('list-dokter');
Route::resource('dokter', 'DokterController');

// Routes pasien
Route::get('/pasien/list', 'PasienController@list_pasien')->name('list-pasien');
Route::resource('pasien', 'PasienController');

// Routes users
Route::get('/users/list', 'UsersController@list_users')->name('list-users');
Route::resource('users', 'UsersController');