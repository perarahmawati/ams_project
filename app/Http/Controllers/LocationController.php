<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class LocationController extends Controller
{
    public function marker()
    {
        $locations = Location::all();
        return response()->json($locations);
    }

    public function index()
    {
        $locations = Location::all();
        return view('pages.management.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('pages.management.locations.create');
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

            session::flash('success', 'Location added successfully.');

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
        $location = Location::find($location_id);
        
        if ($location == null) {
            return redirect()->route('pages.management.locations.index');
        }

        return view('pages.management.locations.edit',compact('location'));
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

            session::flash('success', 'Location updated successfully.');

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
        $location = Location::find($location_id);

        if ($location == null) {
            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }

        $location->delete();

        session::flash('success', 'Location deleted successfully.');

        return redirect()->route('pages.management.locations.index');
    }
}
