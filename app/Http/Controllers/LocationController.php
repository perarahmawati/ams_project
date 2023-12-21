<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function marker()
    {
        $locations = Location::all();
    
        $locationsData = [];
        foreach ($locations as $location) {
            $totalAssets = number_format($location->dataTable->count(), 0, '.', '.');
            
            $locationsData[] = [
                'id' => $location->id,
                'name' => $location->name,
                'address' => $location->address,
                'latitude' => $location->latitude,
                'longitude' => $location->longitude,
                'totalAssets' => $totalAssets,
            ];
        }
    
        return response()->json($locationsData);
    }

    public function create()
    {
        $loggedInUser = Auth::user();
        if ($loggedInUser && in_array($loggedInUser->role_name, [1])) {

            return view('pages.option-management.locations.create');
        } else {
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => 'required|string|max:25',
            'longitude' => 'required|string|max:25'
        ]);

        if ($validator->passes()) {

            $location = new Location();
            $location->name = $request->name;
            $location->address = $request->address;
            $location->latitude = $request->latitude;
            $location->longitude = $request->longitude;
            $location->save();

            session::flash('success-location', 'Location added successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Location added successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($location_id, Request $request)
    {
        $loggedInUser = Auth::user();
        if ($loggedInUser && in_array($loggedInUser->role_name, [1])) {

            $location = Location::find($location_id);
        
            if ($location == null) {
                return redirect()->route('pages.option-management.index');
            }
    
            return view('pages.option-management.locations.edit',compact('location'));
        } else {
            return redirect()->back();
        }
    }

    public function update($location_id, Request $request)
    {
        $location = Location::find($location_id);

        if ($location == null) {
            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => 'required|string|max:25',
            'longitude' => 'required|string|max:25'
        ]);

        if ($validator->passes()) {

            $location->name = $request->name;
            $location->address = $request->address;
            $location->latitude = $request->latitude;
            $location->longitude = $request->longitude;
            $location->save();

            session::flash('success-location', 'Location updated successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Location updated successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($location_id, Request $request)
    {
        $loggedInUser = Auth::user();
        if ($loggedInUser && in_array($loggedInUser->role_name, [1])) {

            $location = Location::find($location_id);

            if ($location == null) {
                return response()->json([
                    'status' => false,
                    'notFound' => true
                ]);
            }
    
            $location->delete();
    
            session::flash('success-location', 'Location deleted successfully.');
    
            return redirect()->route('pages.option-management.index');
        } else {
            return redirect()->back();
        }
    }
}
