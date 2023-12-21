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

Route::redirect('/', '/login');

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
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\UserProfileController;

Auth::routes();

Route::group(['middleware' => ['auth']], function() {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('pages.dashboard');

    // Dashboard - Filter Result
    Route::get('/asset-management/filter-results/item/{item}', [DashboardController::class, 'getItem'])->name('pages.data-tables.filter-results.item');
    Route::get('/asset-management/filter-results/item/{item}/show', [DataTableController::class, 'show'])->name('pages.data-tables.filter-results.item.show');
    Route::get('/asset-management/filter-results/manufacturer/{manufacturer}', [DashboardController::class, 'getManufacturer'])->name('pages.data-tables.filter-results.manufacturer');
    Route::get('/asset-management/filter-results/manufacturer/{manufacturer}/show', [DataTableController::class, 'show'])->name('pages.data-tables.filter-results.manufacturer.show');
    Route::get('/asset-management/filter-results/configuration-status/{configuration_status}', [DashboardController::class, 'getConfigurationStatus'])->name('pages.data-tables.filter-results.configuration-status');
    Route::get('/asset-management/filter-results/configuration-status/{configuration_status}/show', [DataTableController::class, 'show'])->name('pages.data-tables.filter-results.configuration-status.show');
    Route::get('/asset-management/filter-results/location/{location}', [DashboardController::class, 'getLocation'])->name('pages.data-tables.filter-results.location');
    Route::get('/asset-management/filter-results/location/{location}/show', [DataTableController::class, 'show'])->name('pages.data-tables.filter-results.location.show');
    Route::get('/asset-management/filter-results/position-status/{position_status}', [DashboardController::class, 'getPositionStatus'])->name('pages.data-tables.filter-results.position-status');
    Route::get('/asset-management/filter-results/position-status/{position_status}/show', [DataTableController::class, 'show'])->name('pages.data-tables.filter-results.position-status.show');

    // Asset Management
    Route::get('/asset-management', [DataTableController::class, 'index'])->name('pages.data-tables.index');
    Route::get('/asset-management/add-new-asset', [DataTableController::class, 'create'])->name('pages.data-tables.create');
    Route::post('/asset-management', [DataTableController::class, 'store'])->name('pages.data-tables.store');
    Route::get('/asset-management/{data_table}/show', [DataTableController::class, 'show'])->name('pages.data-tables.show');
    Route::get('/asset-management/{data_table}/edit', [DataTableController::class, 'edit'])->name('pages.data-tables.edit');
    Route::post('/asset-management/{data_table}', [DataTableController::class, 'update'])->name('pages.data-tables.update');
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
    Route::get('/asset-management/option-management', [CombinedController::class, 'index'])->name('pages.option-management.index');

    // Item
    Route::get('/asset-management/option-management/item/add-new-item', [ItemController::class, 'create'])->name('pages.option-management.items.create');
    Route::post('/asset-management/option-management/item', [ItemController::class, 'store'])->name('pages.option-management.items.store');
    Route::get('/asset-management/option-management/item/{item}/edit', [ItemController::class, 'edit'])->name('pages.option-management.items.edit');
    Route::post('/asset-management/option-management/item/{item}', [ItemController::class, 'update'])->name('pages.option-management.items.update');
    Route::get('/asset-management/option-management/item/{item}/delete', [ItemController::class, 'destroy'])->name('pages.option-management.items.destroy');

    // Manufacturer
    Route::get('/asset-management/option-management/manufacturer/add-new-manufacturer', [ManufacturerController::class, 'create'])->name('pages.option-management.manufacturers.create');
    Route::post('/asset-management/option-management/manufacturer', [ManufacturerController::class, 'store'])->name('pages.option-management.manufacturers.store');
    Route::get('/asset-management/option-management/manufacturer/{manufacturer}/edit', [ManufacturerController::class, 'edit'])->name('pages.option-management.manufacturers.edit');
    Route::post('/asset-management/option-management/manufacturer/{manufacturer}', [ManufacturerController::class, 'update'])->name('pages.option-management.manufacturers.update');
    Route::get('/asset-management/option-management/manufacturer/{manufacturer}/delete', [ManufacturerController::class, 'destroy'])->name('pages.option-management.manufacturers.destroy');

    // Configuration Status
    Route::get('/asset-management/option-management/configuration-status/add-new-configuration-status', [ConfigurationStatusController::class, 'create'])->name('pages.option-management.configuration-statuses.create');
    Route::post('/asset-management/option-management/configuration-status', [ConfigurationStatusController::class, 'store'])->name('pages.option-management.configuration-statuses.store');
    Route::get('/asset-management/option-management/configuration-status/{configuration_status}/edit', [ConfigurationStatusController::class, 'edit'])->name('pages.option-management.configuration-statuses.edit');
    Route::post('/asset-management/option-management/configuration-status/{configuration_status}', [ConfigurationStatusController::class, 'update'])->name('pages.option-management.configuration-statuses.update');
    Route::get('/asset-management/option-management/configuration-status/{configuration_status}/delete', [ConfigurationStatusController::class, 'destroy'])->name('pages.option-management.configuration-statuses.destroy');

    // Location
    Route::get('/asset-management/option-management/location/marker', [LocationController::class, 'marker']);
    Route::get('/asset-management/option-management/location/add-new-location', [LocationController::class, 'create'])->name('pages.option-management.locations.create');
    Route::post('/asset-management/option-management/location', [LocationController::class, 'store'])->name('pages.option-management.locations.store');
    Route::get('/asset-management/option-management/location/{location}/edit', [LocationController::class, 'edit'])->name('pages.option-management.locations.edit');
    Route::post('/asset-management/option-management/location/{location}', [LocationController::class, 'update'])->name('pages.option-management.locations.update');
    Route::get('/asset-management/option-management/location/{location}/delete', [LocationController::class, 'destroy'])->name('pages.option-management.locations.destroy');

    // Position Status
    Route::get('/asset-management/option-management/position-status/add-new-position-status', [PositionStatusController::class, 'create'])->name('pages.option-management.position-statuses.create');
    Route::post('/asset-management/option-management/position-status', [PositionStatusController::class, 'store'])->name('pages.option-management.position-statuses.store');
    Route::get('/asset-management/option-management/position-status/{position_status}/edit', [PositionStatusController::class, 'edit'])->name('pages.option-management.position-statuses.edit');
    Route::post('/asset-management/option-management/position-status/{position_status}', [PositionStatusController::class, 'update'])->name('pages.option-management.position-statuses.update');
    Route::get('/asset-management/option-management/position-status/{position_status}/delete', [PositionStatusController::class, 'destroy'])->name('pages.option-management.position-statuses.destroy');

    // User Profile
    Route::get('/user-profile', [UserProfileController::class, 'index'])->name('pages.user-profile');
    Route::post('/user-profile/update-personal-information', [UserProfileController::class, 'updatePersonalInformation'])->name('pages.user-profile.update-personal-information');
    Route::post('/user-profile/change-profile-picture', [UserProfileController::class, 'changeProfilePicture'])->name('pages.user-profile.change-profile-picture');
    Route::post('/user-profile/change-password', [UserProfileController::class, 'changePassword'])->name('pages.user-profile.change-password');

    // User Management
    Route::get('/user-management', [UserManagementController::class, 'index'])->name('pages.user-management.index');
    Route::get('/user-management/add-new-user', [UserManagementController::class, 'create'])->name('pages.user-management.create');
    Route::post('/user-management', [UserManagementController::class, 'store'])->name('pages.user-management.store');
    Route::get('/user-management/{user}/edit', [UserManagementController::class, 'edit'])->name('pages.user-management.edit');
    Route::post('/user-management/{user}', [UserManagementController::class, 'update'])->name('pages.user-management.update');
    Route::get('/user-management/{user}/delete', [UserManagementController::class, 'destroy'])->name('pages.user-management.destroy');
    
});