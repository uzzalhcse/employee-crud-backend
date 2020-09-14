<?php

use Illuminate\Support\Facades\Artisan;
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
Route::get('/reset-app', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('migrate:fresh --seed');
    return [
        'config'=>'cleared',
        'cache'=>'cleared',
        'migrate:fresh'=>'completed with seeder'
    ];
});
