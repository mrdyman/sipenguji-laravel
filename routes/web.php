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

// Route::get('/', function () {
//     return view('welcome');
// });

// home
Route::get('/home/mahasiswa', 'HomeController@mahasiswa')->middleware('admin');
Route::get('/', 'HomeController@index')->middleware('admin');
Route::delete('/', 'HomeController@index');
Route::resource('home', 'HomeController')->middleware('admin');

// getMarker
Route::get('/getmarker', 'HomeController@getMarker')->middleware('admin');

//getmarker untuk menu polyline
Route::get('/polylinegetmarker', 'HomeController@getMarker')->middleware('admin');

//getGedung
Route::get('/getgedung', 'HomeController@getGedung')->middleware('admin');

//getRuangan
Route::get('/getruangan', 'RuanganController@getRuangan')->middleware('admin');

// polyline
Route::resource('polyline', 'PolylineController')->middleware('admin');

// ruangan
Route::resource('ruangan', 'RuanganController')->middleware('admin');

//displayPolyline
Route::post('/polyline/displayPolyline', 'PolylineController@displayPolyline');

//jadwal
Route::resource('jadwal', 'JadwalController')->middleware('admin');

//floyd-warshall
Route::resource('floyd-warshall', 'FloydWarshallController')->middleware('admin');

Route::post('floyd-warshall/calculate', 'FloydWarshallController@calculate');

Route::post('floyd-warshall/hasil', 'FloydWarshallController@hasil');

//mahasiswa
Route::get('mahasiswa/biodata', 'MahasiswaController@index')->middleware('mahasiswa');;

Route::get('mahasiswa/cetak', 'MahasiswaController@cetak')->middleware('mahasiswa');;

Route::post('mahasiswa/cetak', 'MahasiswaController@downloadKartu')->middleware('mahasiswa');;

Route::put('mahasiswa/bayar', 'MahasiswaController@bayar')->middleware('mahasiswa');;

Route::resource('mahasiswa', 'MahasiswaController')->middleware('mahasiswa');

//auth
Route::get('/auth/logout', 'AuthController@logout');

Route::resource('auth', 'AuthController');

Route::post('auth/login', 'AuthController@login');
