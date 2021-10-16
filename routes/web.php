<?php

use Illuminate\Support\Facades\Route;


Route::get('/', '\App\Http\Controllers\Auth\LoginController@showLoginForm');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes(['reset' => false]);
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::middleware(['auth','level:1'])->group(function(){
  
    // Routes dokter
    Route::get('/dokter/list', 'DokterController@list_dokter')->name('list-dokter');
    Route::resource('dokter', 'DokterController');

    // Routes pasien
    Route::get('/pasien/list', 'PasienController@list_pasien')->name('list-pasien');
    Route::post('/pasien/topup', 'PasienController@topupSaldo')->name('topup');
    Route::resource('pasien', 'PasienController');

    
    // Routes users
    Route::get('/users/list', 'UsersController@list_users')->name('list-users');
    Route::resource('users', 'UsersController');
});

Route::middleware(['auth','level:2'])->group(function(){
    Route::get('/laporan/topup', 'LaporanController@index')->name('laporan-topup');
});





