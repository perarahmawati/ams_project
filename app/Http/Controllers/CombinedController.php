<?php

namespace App\Http\Controllers;

use App\Models\ConfigurationStatus;
use App\Models\Item;
use App\Models\Location;
use App\Models\Manufacturer;
use App\Models\PositionStatus;
use Illuminate\Support\Facades\Auth;

class CombinedController extends Controller
{
    public function index()
    {
        $loggedInUser = Auth::user();
        if ($loggedInUser && in_array($loggedInUser->role_name, [1])) {
            
            $configuration_statuses = ConfigurationStatus::all();
            $items = Item::all();
            $locations = Location::all();
            $manufacturers = Manufacturer::all();
            $position_statuses = PositionStatus::all();
    
            return view('pages.option-management.index', compact('configuration_statuses', 'items', 'locations', 'manufacturers', 'position_statuses'));
        } else {
            return redirect()->back();
        }
    }
}
