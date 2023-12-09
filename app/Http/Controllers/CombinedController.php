<?php

namespace App\Http\Controllers;

use App\Models\ConfigurationStatus;
use App\Models\Item;
use App\Models\Location;
use App\Models\Manufacturer;
use App\Models\PositionStatus;

class CombinedController extends Controller
{
    public function index()
    {
        $configuration_statuses = ConfigurationStatus::all();
        $items = Item::all();
        $locations = Location::all();
        $manufacturers = Manufacturer::all();
        $position_statuses = PositionStatus::all();

        return view('pages.option-management.index', compact('configuration_statuses', 'items', 'locations', 'manufacturers', 'position_statuses'));
    }
}
