<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufacture;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ManufactureController extends Controller
{
    public function index()
    {
        $manufactures = Manufacture::all();
        return view('pages.management.manufactures.index', compact('manufactures'));
    }

    public function create()
    {
        return view('pages.management.manufactures.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->passes()) {

            $manufacture = new Manufacture;
            $manufacture->name = $request->name;
            $manufacture->save();

            session::flash('success', 'Manufacture added successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Manufacture added successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($manufacture_id, Request $request)
    {
        $manufacture = Manufacture::find($manufacture_id);
        
        if ($manufacture == null) {
            return redirect()->route('pages.management.manufactures.index');
        }

        return view('pages.management.manufactures.edit', compact('manufacture'));
    }

    public function update($manufacture_id, Request $request)
    {
        $manufacture = Manufacture::find($manufacture_id);

        if ($manufacture == null) {
            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->passes()) {

            $manufacture->name = $request->name;
            $manufacture->save();

            session::flash('success', 'Manufacture updated successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Manufacture updated successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($manufacture_id, Request $request)
    {
        $manufacture = Manufacture::find($manufacture_id);

        if ($manufacture == null) {
            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }

        $manufacture->delete();

        session::flash('success', 'Manufacture deleted successfully.');

        return redirect()->route('pages.management.manufactures.index');
    }
}
