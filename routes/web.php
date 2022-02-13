<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/series', 'App\Http\Controllers\SeriesController@listarSeries')->name('listar_series');

Route::get('/series/create', 'App\Http\Controllers\SeriesController@create')->name('criar_serie')->middleware('auth');
Route::post('/series/create', 'App\Http\Controllers\SeriesController@store')->middleware('auth');
Route::post('/series/{id}/editaNome','App\Http\Controllers\SeriesController@editaNome')->middleware('auth');
Route::delete('/series/remove/{id}', 'App\Http\Controllers\SeriesController@destroy')->middleware('auth');

Route::get('/series/{serieId}/temporadas', 'App\Http\Controllers\TemporadasController@index');
Route::get('/temporadas/{temporada}/episodios', 'App\Http\Controllers\EpisodiosController@index');
Route::post('/temporadas/{temporada}/episodios/assistir', 'App\Http\Controllers\EpisodiosController@assistir')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
