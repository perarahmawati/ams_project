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

// Dashboard - Filter Result
Route::get('/asset-management/filter-results/item/{item}', [DashboardController::class, 'getItem'])->name('pages.data-tables.filter-results.item');
Route::get('/asset-management/filter-results/manufacturer/{manufacturer}', [DashboardController::class, 'getManufacturer'])->name('pages.data-tables.filter-results.manufacturer');
Route::get('/asset-management/filter-results/configuration-status/{configuration_status}', [DashboardController::class, 'getConfigurationStatus'])->name('pages.data-tables.filter-results.configuration-status');
Route::get('/asset-management/filter-results/location/{location}', [DashboardController::class, 'getLocation'])->name('pages.data-tables.filter-results.location');
Route::get('/asset-management/filter-results/position-status/{position_status}', [DashboardController::class, 'getPositionStatus'])->name('pages.data-tables.filter-results.position-status');

// Asset Management
Route::get('/asset-management', [DataTableController::class, 'index'])->name('pages.data-tables.index');
Route::get('/asset-management/add-new-asset', [DataTableController::class, 'create'])->name('pages.data-tables.create');
Route::post('/asset-management', [DataTableController::class, 'store'])->name('pages.data-tables.store');
Route::get('/asset-management/{data_table}/show', [DataTableController::class, 'show'])->name('pages.data-tables.show');
Route::get('/asset-management/{data_table}/edit', [DataTableController::class, 'edit'])->name('pages.data-tables.edit');
Route::post('/asset-management/{data_table}/update', [DataTableController::class, 'update'])->name('pages.data-tables.update');
Route::get('/asset-management/{data_table}/delete', [DataTableController::class, 'softDelete'])->name('pages.data-tables.soft-delete');
Route::get('/asset-management/recycle-bin', [DataTableController::class, 'recycleBin'])->name('pages.data-tables.recycle-bin');
Route::get('/asset-management/recycle-bin/{data_table}/restore', [DataTableController::class, 'restore'])->name('pages.data-tables.restore');
Route::get('/asset-management/recycle-bin/{data_table}/delete-permanently', [DataTableController::class, 'forceDelete'])->name('pages.data-tables.force-delete');

// Asset Management - Temp Images
Route::post('temp-images', [TempImageController::class, 'store'])->name('pages.data-tables.temp-images.store');
Route::delete('temp-images/{image}', [TempImageController::class, 'destroy'])->name('pages.data-tables.temp-images.destroy');

// Asset Management - Images
Route::post('asset-management-images', [DataTableImageController::class, 'store'])->name('pages.data-tables.data-table-images.store');
Route::delete('asset-management-images/{image}', [DataTableImageController::class, 'destroy'])->name('pages.data-tables.data-table-images.destroy');

// Asset Management - Import Excel
Route::post('import-excel',[DataTableController::class, 'importexcel'])->name('import-excel');

// Option Management
Route::get('/asset-management/option-management', [CombinedController::class, 'index'])->name('pages.management.index');

// Item
Route::get('/asset-management/option-management/item/add-new-item', [ItemController::class, 'create'])->name('pages.management.items.create');
Route::post('/asset-management/option-management/item', [ItemController::class, 'store'])->name('pages.management.items.store');
Route::get('/asset-management/option-management/item/{item}/edit', [ItemController::class, 'edit'])->name('pages.management.items.edit');
Route::post('/asset-management/option-management/item/{item}/update', [ItemController::class, 'update'])->name('pages.management.items.update');
Route::get('/asset-management/option-management/item/{item}/delete', [ItemController::class, 'destroy'])->name('pages.management.items.destroy');

// Manufacturer
Route::get('/asset-management/option-management/manufacturer/add-new-manufacturer', [ManufacturerController::class, 'create'])->name('pages.management.manufacturers.create');
Route::post('/asset-management/option-management/manufacturer', [ManufacturerController::class, 'store'])->name('pages.management.manufacturers.store');
Route::get('/asset-management/option-management/manufacturer/{manufacturer}/edit', [ManufacturerController::class, 'edit'])->name('pages.management.manufacturers.edit');
Route::post('/asset-management/option-management/manufacturer/{manufacturer}/update', [ManufacturerController::class, 'update'])->name('pages.management.manufacturers.update');
Route::get('/asset-management/option-management/manufacturer/{manufacturer}/delete', [ManufacturerController::class, 'destroy'])->name('pages.management.manufacturers.destroy');

// Configuration Status
Route::get('/asset-management/option-management/configuration-status/add-new-configuration-status', [ConfigurationStatusController::class, 'create'])->name('pages.management.configuration-statuses.create');
Route::post('/asset-management/option-management/configuration-status', [ConfigurationStatusController::class, 'store'])->name('pages.management.configuration-statuses.store');
Route::get('/asset-management/option-management/configuration-status/{configuration_status}/edit', [ConfigurationStatusController::class, 'edit'])->name('pages.management.configuration-statuses.edit');
Route::post('/asset-management/option-management/configuration-status/{configuration_status}/update', [ConfigurationStatusController::class, 'update'])->name('pages.management.configuration-statuses.update');
Route::get('/asset-management/option-management/configuration-status/{configuration_status}/delete', [ConfigurationStatusController::class, 'destroy'])->name('pages.management.configuration-statuses.destroy');

// Location
Route::get('/asset-management/option-management/location/marker', [LocationController::class, 'marker']);
Route::get('/asset-management/option-management/location/add-new-location', [LocationController::class, 'create'])->name('pages.management.locations.create');
Route::post('/asset-management/option-management/location', [LocationController::class, 'store'])->name('pages.management.locations.store');
Route::get('/asset-management/option-management/location/{location}/edit', [LocationController::class, 'edit'])->name('pages.management.locations.edit');
Route::post('/asset-management/option-management/location/{location}/update', [LocationController::class, 'update'])->name('pages.management.locations.update');
Route::get('/asset-management/option-management/location/{location}/delete', [LocationController::class, 'destroy'])->name('pages.management.locations.destroy');

// Position Status
Route::get('/asset-management/option-management/position-status/add-new-position-status', [PositionStatusController::class, 'create'])->name('pages.management.position-statuses.create');
Route::post('/asset-management/option-management/position-status', [PositionStatusController::class, 'store'])->name('pages.management.position-statuses.store');
Route::get('/asset-management/option-management/position-status/{position_status}/edit', [PositionStatusController::class, 'edit'])->name('pages.management.position-statuses.edit');
Route::post('/asset-management/option-management/position-status/{position_status}/update', [PositionStatusController::class, 'update'])->name('pages.management.position-statuses.update');
Route::get('/asset-management/option-management/position-status/{position_status}/delete', [PositionStatusController::class, 'destroy'])->name('pages.management.position-statuses.destroy');

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
