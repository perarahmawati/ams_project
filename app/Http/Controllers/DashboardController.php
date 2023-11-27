<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataTable;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all = DataTable::count();
        $unconfigured = DataTable::where('configuration_status_name', '1')->count();
        $preconfigured = DataTable::where('configuration_status_name', '2')->count();
        $configured = DataTable::where('configuration_status_name', '3')->count();
        $tested = DataTable::where('configuration_status_name', '4')->count();
        $installed = DataTable::where('configuration_status_name', '5')->count();
        $data_tables = DataTable::latest()->paginate(10);

        return view('pages.dashboard', compact('all', 'unconfigured', 'preconfigured', 'configured', 'tested', 'installed', 'data_tables'));
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
