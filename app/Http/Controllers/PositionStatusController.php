<?php

namespace App\Http\Controllers;

use App\Models\PositionStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class PositionStatusController extends Controller
{
    public function create()
    {
        $loggedInUser = Auth::user();
        if ($loggedInUser && in_array($loggedInUser->role_name, [1])) {

            return view('pages.option-management.position-statuses.create');
        } else {
            return redirect()->back();
        }
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

            session::flash('success-position-status', 'Position Status added successfully.');

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
        $loggedInUser = Auth::user();
        if ($loggedInUser && in_array($loggedInUser->role_name, [1])) {

            $position_status = PositionStatus::find($position_status_id);
        
            if ($position_status == null) {
                return redirect()->route('pages.option-management.index');
            }
    
            return view('pages.option-management.position-statuses.edit', compact('position_status'));
        } else {
            return redirect()->back();
        }
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

            session::flash('success-position-status', 'Position Status updated successfully.');

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
        $loggedInUser = Auth::user();
        if ($loggedInUser && in_array($loggedInUser->role_name, [1])) {

            $position_status = PositionStatus::find($position_status_id);

            if ($position_status == null) {
                return response()->json([
                    'status' => false,
                    'notFound' => true
                ]);
            }
    
            $position_status->delete();
    
            session::flash('success-position-status', 'Position Status deleted successfully.');
    
            return redirect()->route('pages.option-management.index');
        } else {
            return redirect()->back();
        }
    }
}
