<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BadgesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShiftsController;
use App\Http\Controllers\TasksController;


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

Route::get('/install', function () {
    return view('install');
});

Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {
    Route::group(['middleware' => ['auth', 'verified']], function () {
        // Tasks routes
        Route::get('/tasks/', [TasksController::class, 'index'])
                    ->name('tasks');
        // Shifts
        Route::get('/shifts/', [ShiftsController::class, 'index'])
                    ->name('shifts');

        // Tasks routes
        Route::get('/badges/', [BadgesController::class, 'index'])
                    ->name('badges');
    });
});
