<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ManufacturerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('pages.management.manufacturers.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->passes()) {

            $manufacturer = new Manufacturer;
            $manufacturer->name = $request->name;
            $manufacturer->save();

            session::flash('success-manufacturer', 'Manufacturer added successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Manufacturer added successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($manufacturer_id, Request $request)
    {
        $manufacturer = Manufacturer::find($manufacturer_id);
        
        if ($manufacturer == null) {
            return redirect()->route('pages.management.index');
        }

        return view('pages.management.manufacturers.edit', compact('manufacturer'));
    }

    public function update($manufacturer_id, Request $request)
    {
        $manufacturer = Manufacturer::find($manufacturer_id);

        if ($manufacturer == null) {
            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->passes()) {

            $manufacturer->name = $request->name;
            $manufacturer->save();

            session::flash('success-manufacturer', 'Manufacturer updated successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Manufacturer updated successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($manufacturer_id, Request $request)
    {
        $manufacturer = Manufacturer::find($manufacturer_id);

        if ($manufacturer == null) {
            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }

        $manufacturer->delete();

        session::flash('success-manufacturer', 'Manufacturer deleted successfully.');

        return redirect()->route('pages.management.index');
    }
}
