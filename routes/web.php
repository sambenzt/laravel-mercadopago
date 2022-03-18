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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/logs', 'NotificationController@logs');
Route::get('/logs/delete/{id}', 'NotificationController@delete');

Route::get('/logs/webhook', 'WebhookController@logs');
Route::get('/logs/webhook/{id}', 'WebhookController@delete');
Route::get('/logs/webhook/all', 'WebhookController@delete');


Route::get('/migrations', 'NotificationController@runMigrations');
