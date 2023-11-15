<?php

namespace App\Http\Controllers;

use App\Models\PositionStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class PositionStatusController extends Controller
{
    public function index()
    {
        $position_statuses = PositionStatus::all();
        return view('pages.management.position-statuses.index', compact('position_statuses'));
    }

    public function create()
    {
        return view('pages.management.position-statuses.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->passes()) {

            $position_status = new PositionStatus;
            $position_status->name = $request->name;
            $position_status->save();

            session::flash('success', 'Position Status added successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Position Status added successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($position_status_id, Request $request)
    {
        $position_status = PositionStatus::find($position_status_id);
        
        if ($position_status == null) {
            return redirect()->route('pages.management.position-statuses.index');
        }

        return view('pages.management.position-statuses.edit', compact('position_status'));
    }

    public function update($position_status_id, Request $request)
    {
        $position_status = PositionStatus::find($position_status_id);

        if ($position_status == null) {
            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->passes()) {

            $position_status->name = $request->name;
            $position_status->save();

            session::flash('success', 'Position Status updated successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Position Status updated successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($position_status_id, Request $request)
    {
        $position_status = PositionStatus::find($position_status_id);

        if ($position_status == null) {
            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }

        $position_status->delete();

        session::flash('success', 'Position Status deleted successfully.');

        return redirect()->route('pages.management.position-statuses.index');
    }
}
