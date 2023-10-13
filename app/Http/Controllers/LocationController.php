<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function index(){
        $locations = Location::all();
        return view('pages.management.locations.index', ['locations' => $locations]);
    }

    public function create(){
        return view('pages.management.locations.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|string|max:25',
            'longitude' => 'required|string|max:25'
        ]);

        Location::create($request->all());

        return redirect(route('pages.management.locations.index'))->with('success', 'New Location Added Successfully!');
    }

    public function edit(Location $location){
        return view('pages.management.locations.edit', ['location' => $location]);
    }

    public function update(Location $location, Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|string|max:25',
            'longitude' => 'required|string|max:25'
        ]);

        $location->update($request->all());

        return redirect(route('pages.management.locations.index'))->with('success', 'Location Updated Successfully!');
    }

    public function destroy(Location $location){
        $location->delete();
        return redirect(route('pages.management.locations.index'))->with('success', 'Location Deleted Successfully!');
    }
}
