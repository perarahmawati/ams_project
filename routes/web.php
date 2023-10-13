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
use App\Http\Controllers\UserManageController;
use App\Http\Controllers\ActivityLogsController;
use App\Http\Controllers\ConfigurationStatusController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ManufactureController;
use App\Http\Controllers\UserLogsController;
use App\Http\Controllers\MessageController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('pages.dashboard.index');
Route::get('/data-tables', [DataTablesController::class, 'index'])->name('pages.data-tables.index');
Route::get('/user-manage', [UserManageController::class, 'index'])->name('pages.user-manage.index');
Route::get('/activity-logs', [ActivityLogsController::class, 'index'])->name('pages.history-logs.activity-logs.index');
Route::get('/user-logs', [UserLogsController::class, 'index'])->name('pages.history-logs.user-logs.index');
Route::get('/message', [MessageController::class, 'index'])->name('pages.message.index');

// Configuration Status
Route::get('/configuration-status', [ConfigurationStatusController::class, 'index'])->name('pages.management.configuration-statuses.index');
Route::get('/configuration-tatus/create', [ConfigurationStatusController::class, 'create'])->name('pages.management.configuration-statuses.create');
Route::post('/configuration-status', [ConfigurationStatusController::class, 'store'])->name('pages.management.configuration-statuses.store');
Route::get('/configuration-status/{configuration_status}/edit', [ConfigurationStatusController::class, 'edit'])->name('pages.management.configuration-statuses.edit');
Route::put('/configuration-status/{configuration_status}/update', [ConfigurationStatusController::class, 'update'])->name('pages.management.configuration-statuses.update');
Route::delete('/configuration-status/{configuration_status}/destroy', [ConfigurationStatusController::class, 'destroy'])->name('pages.management.configuration-statuses.destroy');

// Item
Route::get('/item', [ItemController::class, 'index'])->name('pages.management.items.index');
Route::get('/item/create', [ItemController::class, 'create'])->name('pages.management.items.create');
Route::post('/item', [ItemController::class, 'store'])->name('pages.management.items.store');
Route::get('/item/{item}/edit', [ItemController::class, 'edit'])->name('pages.management.items.edit');
Route::put('/item/{item}/update', [ItemController::class, 'update'])->name('pages.management.items.update');
Route::delete('/item/{item}/destroy', [ItemController::class, 'destroy'])->name('pages.management.items.destroy');

// Location
Route::get('/location', [LocationController::class, 'index'])->name('pages.management.locations.index');
Route::get('/location/create', [LocationController::class, 'create'])->name('pages.management.locations.create');
Route::post('/location', [LocationController::class, 'store'])->name('pages.management.locations.store');
Route::get('/location/{location}/edit', [LocationController::class, 'edit'])->name('pages.management.locations.edit');
Route::put('/location/{location}/update', [LocationController::class, 'update'])->name('pages.management.locations.update');
Route::delete('/location/{location}/destroy', [LocationController::class, 'destroy'])->name('pages.management.locations.destroy');

// Manufacture
Route::get('/manufacture', [ManufactureController::class, 'index'])->name('pages.management.manufactures.index');
Route::get('/manufacture/create', [ManufactureController::class, 'create'])->name('pages.management.manufactures.create');
Route::post('/manufacture', [ManufactureController::class, 'store'])->name('pages.management.manufactures.store');
Route::get('/manufacture/{manufacture}/edit', [ManufactureController::class, 'edit'])->name('pages.management.manufactures.edit');
Route::put('/manufacture/{manufacture}/update', [ManufactureController::class, 'update'])->name('pages.management.manufactures.update');
Route::delete('/manufacture/{manufacture}/destroy', [ManufactureController::class, 'destroy'])->name('pages.management.manufactures.destroy');