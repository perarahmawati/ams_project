<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UserProfileController;
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

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConfigurationStatusController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\DataTableImageController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\PositionStatusController;
use App\Http\Controllers\TempImageController;
use App\Http\Controllers\CombinedController;
use App\Http\Controllers\UserLogController;
use App\Http\Controllers\UserManagementController;

Auth::routes();

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('pages.dashboard');

// Asset Management
Route::get('/asset-management', [DataTableController::class, 'index'])->name('pages.data-tables.index');
Route::get('/asset-management/create', [DataTableController::class, 'create'])->name('pages.data-tables.create');
Route::post('/asset-management', [DataTableController::class, 'store'])->name('pages.data-tables.store');
Route::get('/asset-management/{data_table}/show', [DataTableController::class, 'show'])->name('pages.data-tables.show');
Route::get('/asset-management/{data_table}/edit', [DataTableController::class, 'edit'])->name('pages.data-tables.edit');
Route::post('/asset-management/{data_table}/update', [DataTableController::class, 'update'])->name('pages.data-tables.update');
Route::get('/asset-management/soft-delete/{data_table}', [DataTableController::class, 'softDelete'])->name('pages.data-tables.soft-delete');
Route::get('/asset-management/recycle-bin', [DataTableController::class, 'trashed'])->name('pages.data-tables.recycle-bin');
Route::get('/asset-management/restore/{data_table}', [DataTableController::class, 'restore'])->name('pages.data-tables.restore');
Route::get('/asset-management/force-delete/{data_table}', [DataTableController::class, 'forceDelete'])->name('pages.data-tables.force-delete');

// Asset Management Temp Images
Route::post('/asset-management/temp-images', [TempImageController::class, 'store'])->name('pages.data-tables.temp-images.store');

// Asset Management Images
Route::post('/asset-management/asset-management-images', [DataTableImageController::class, 'store'])->name('pages.data-tables.data-table-images.store');
Route::delete('/asset-management/asset-management-images/{image}', [DataTableImageController::class, 'destroy'])->name('pages.data-tables.data-table-images.destroy');

// Asset Management Import Excel
Route::post('/asset-management/import-excel',[DataTableController::class, 'importexcel'])->name('import-excel');

// Options Management
Route::get('/asset-management/option-management', [CombinedController::class, 'index'])->name('pages.management.index');

// Configuration Statuses
Route::get('/asset-management/option-management/configuration-statuses/create', [ConfigurationStatusController::class, 'create'])->name('pages.management.configuration-statuses.create');
Route::post('/asset-management/option-management/configuration-statuses', [ConfigurationStatusController::class, 'store'])->name('pages.management.configuration-statuses.store');
Route::get('/asset-management/option-management/configuration-statuses/{configuration_status}/edit', [ConfigurationStatusController::class, 'edit'])->name('pages.management.configuration-statuses.edit');
Route::post('/asset-management/option-management/configuration-statuses/{configuration_status}/update', [ConfigurationStatusController::class, 'update'])->name('pages.management.configuration-statuses.update');
Route::delete('/asset-management/option-management/configuration-statuses/{configuration_status}/destroy', [ConfigurationStatusController::class, 'destroy'])->name('pages.management.configuration-statuses.destroy');

// Items
Route::get('/asset-management/option-management/items/create', [ItemController::class, 'create'])->name('pages.management.items.create');
Route::post('/asset-management/option-management/items', [ItemController::class, 'store'])->name('pages.management.items.store');
Route::get('/asset-management/option-management/items/{item}/edit', [ItemController::class, 'edit'])->name('pages.management.items.edit');
Route::post('/asset-management/option-management/items/{item}/update', [ItemController::class, 'update'])->name('pages.management.items.update');
Route::delete('/asset-management/option-management/items/{item}/destroy', [ItemController::class, 'destroy'])->name('pages.management.items.destroy');

// Locations
Route::get('/asset-management/option-management/locations/marker', [LocationController::class, 'marker']);
Route::get('/asset-management/option-management/locations/create', [LocationController::class, 'create'])->name('pages.management.locations.create');
Route::post('/asset-management/option-management/locations', [LocationController::class, 'store'])->name('pages.management.locations.store');
Route::get('/asset-management/option-management/locations/{location}/edit', [LocationController::class, 'edit'])->name('pages.management.locations.edit');
Route::post('/asset-management/option-management/locations/{location}/update', [LocationController::class, 'update'])->name('pages.management.locations.update');
Route::delete('/asset-management/option-management/locations/{location}/destroy', [LocationController::class, 'destroy'])->name('pages.management.locations.destroy');

// Manufacturers
Route::get('/asset-management/option-management/manufacturers/create', [ManufacturerController::class, 'create'])->name('pages.management.manufacturers.create');
Route::post('/asset-management/option-management/manufacturers', [ManufacturerController::class, 'store'])->name('pages.management.manufacturers.store');
Route::get('/asset-management/option-management/manufacturers/{manufacturer}/edit', [ManufacturerController::class, 'edit'])->name('pages.management.manufacturers.edit');
Route::post('/asset-management/option-management/manufacturers/{manufacturer}/update', [ManufacturerController::class, 'update'])->name('pages.management.manufacturers.update');
Route::delete('/asset-management/option-management/manufacturers/{manufacturer}/destroy', [ManufacturerController::class, 'destroy'])->name('pages.management.manufacturers.destroy');

// Position Statuses
Route::get('/asset-management/option-management/position-statuses/create', [PositionStatusController::class, 'create'])->name('pages.management.position-statuses.create');
Route::post('/asset-management/option-management/position-statuses', [PositionStatusController::class, 'store'])->name('pages.management.position-statuses.store');
Route::get('/asset-management/option-management/position-statuses/{position_status}/edit', [PositionStatusController::class, 'edit'])->name('pages.management.position-statuses.edit');
Route::post('/asset-management/option-management/position-statuses/{position_status}/update', [PositionStatusController::class, 'update'])->name('pages.management.position-statuses.update');
Route::delete('/asset-management/option-management/position-statuses/{position_status}/destroy', [PositionStatusController::class, 'destroy'])->name('pages.management.position-statuses.destroy');

// User Profile
Route::get('profiles', [UserProfileController::class, 'index'])->name('profiles')->middleware('auth');
Route::get('profiles', [UserProfileController::class, 'edit'])->name('profiles.edit')->middleware('auth');
Route::patch('profiles', [UserProfileController::class, 'update'])->name('profiles.update')->middleware('auth');
Route::post('profiles', [UserProfileController::class, 'upload'])->name('profiles.upload')->middleware('auth');

// User Logs
Route::get('users-log', [UserLogController::class, 'index'])->name('users-log');

// Activity Log
Route::resource('activity-log', ActivityLogController::class);
Route::get('/asset-management/log', [DataTableController::class, 'log'])->name('pages.data-tables.log');

// User Management
Route::get('/user-management', [UserManagementController::class, 'index'])->name('user-management.index');
Route::get('/user-management/create', [UserManagementController::class, 'create'])->name('user-management.create');
Route::post('/user-management', [UserManagementController::class, 'store'])->name('user-management.store');
Route::get('/user-management/edit', [UserManagementController::class, 'edit'])->name('user-management.edit');
Route::post('/user-management/update', [UserManagementController::class, 'update'])->name('user-management.update');
Route::delete('/user-management/destroy', [UserManagementController::class, 'destroy'])->name('user-management.destroy');
