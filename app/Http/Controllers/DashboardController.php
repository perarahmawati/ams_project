<?php

namespace App\Http\Controllers;

use App\Models\DataTable;
use App\Models\Item;
use App\Models\Manufacturer;
use App\Models\ConfigurationStatus;
use App\Models\Location;
use App\Models\PositionStatus;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        $all_assets = number_format(DataTable::count(), 0, '.', '.');
        $items = Item::with('dataTable')->get();
        $manufacturers = Manufacturer::with('dataTable')->get();
        $configuration_statuses = ConfigurationStatus::with('dataTable')->get();
        $locations = Location::with('dataTable')->get();
        $position_statuses = PositionStatus::with('dataTable')->get();

        return view('pages.dashboard', compact('all_assets', 'items', 'manufacturers', 'configuration_statuses', 'locations', 'position_statuses'));
    }
    
    public function getItem($item_id)
    {
        $item_tables = DataTable::where('item_name', $item_id)->get();
        return view('pages.data-tables.filter-results.item', compact('item_tables'));
    }

    public function getManufacturer($manufacturer_id)
    {
        $manufacturer_tables = DataTable::where('manufacturer_name', $manufacturer_id)->get();
        return view('pages.data-tables.filter-results.manufacturer', compact('manufacturer_tables'));
    }

    public function getConfigurationStatus($configuration_status_id)
    {
        $configuration_tables = DataTable::where('configuration_status_name', $configuration_status_id)->get();
        return view('pages.data-tables.filter-results.configuration-status', compact('configuration_tables'));
    }

    public function getLocation($location_id)
    {
        $location_tables = DataTable::where('location_name', $location_id)->get();
        return view('pages.data-tables.filter-results.location', compact('location_tables'));
    }

    public function getPositionStatus($position_status_id)
    {
        $position_status_tables = DataTable::where('position_status_name', $position_status_id)->get();
        return view('pages.data-tables.filter-results.position-status', compact('position_status_tables'));
    }
}
