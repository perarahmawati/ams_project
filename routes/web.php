<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataTablesController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ActivityLogsController;
use App\Http\Controllers\UserLogsController;
use App\Http\Controllers\MessageController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('pages.dashboard.index');
Route::get('/data-tables', [DataTablesController::class, 'index'])->name('pages.data-tables.index');
Route::get('/user-management', [UserManagementController::class, 'index'])->name('pages.user-management.index');
Route::get('/activity-logs', [ActivityLogsController::class, 'index'])->name('pages.history-logs.activity-logs.index');
Route::get('/user-logs', [UserLogsController::class, 'index'])->name('pages.history-logs.user-logs.index');
Route::get('/message', [MessageController::class, 'index'])->name('pages.message.index');