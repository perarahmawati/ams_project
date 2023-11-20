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
}
