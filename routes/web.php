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
Route::get('/', 'HomeController@index');
Route::delete('/', 'HomeController@index');
Route::resource('home', 'HomeController');

// getMarker
Route::get('/getmarker', 'HomeController@getMarker');

//getmarker untuk menu polyline
Route::get('/polylinegetmarker', 'HomeController@getMarker');

//getGedung
Route::get('/getgedung', 'HomeController@getGedung');

//getRuangan
Route::get('/getruangan', 'RuanganController@getRuangan');

// polyline
Route::resource('polyline', 'PolylineController');

// ruangan
Route::resource('ruangan', 'RuanganController');

//displayPolyline
Route::post('/polyline/displayPolyline', 'PolylineController@displayPolyline');

//jadwal
Route::resource('jadwal', 'JadwalController');

//floyd-warshall
Route::resource('floyd-warshall', 'FloydWarshallController');

Route::post('floyd-warshall/calculate', 'FloydWarshallController@calculate');

Route::post('floyd-warshall/hasil', 'FloydWarshallController@hasil');

//mahasiswa
Route::resource('mahasiswa', 'MahasiswaController');
