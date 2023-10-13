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
        $data = $request->validate([
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $newLocation = Location::create($data);

        return redirect(route('pages.management.locations.index'));
    }

    public function edit(Location $location){
        return view('pages.management.locations.edit', ['location' => $location]);
    }

    public function update(Location $location, Request $request){
        $data = $request->validate([
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $location->update($data);

        return redirect(route('pages.management.locations.index'))->with('success', 'Location Updated Successfully');
    }

    public function destroy(Location $location){
        $location->delete();
        return redirect(route('pages.management.locations.index'))->with('success', 'Location Deleted Successfully');
    }
}
