<?php

use App\Http\Controllers\HistoryController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Http;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
Route::post('/history', [HistoryController::class, 'store'])->name('history.store');

Route::get('/fetch-cities', [WeatherController::class, 'fetchCities'])->name('cities.fetchCities');
Route::get('/get-weather', [WeatherController::class, 'getWeather'])->name('weather.get');
Route::post('/save-weather', [WeatherController::class, 'saveWeather'])->name('weather.save');

Route::get('/user', 'UserController@index');
