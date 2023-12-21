<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConfigurationStatus;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ConfigurationStatusController extends Controller
{
    public function create()
    {
        $loggedInUser = Auth::user();
        if ($loggedInUser && in_array($loggedInUser->role_name, [1])) {

            return view('pages.option-management.configuration-statuses.create');
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

            $configuration_status = new ConfigurationStatus;
            $configuration_status->name = $request->name;
            $configuration_status->save();

            session::flash('success-configuration-status', 'Configuration Status added successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Configuration Status added successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($configuration_status_id, Request $request)
    {
        $loggedInUser = Auth::user();
        if ($loggedInUser && in_array($loggedInUser->role_name, [1])) {

            $configuration_status = ConfigurationStatus::find($configuration_status_id);

            if ($configuration_status == null) {
                return redirect()->route('pages.option-management.index');
            }
    
            return view('pages.option-management.configuration-statuses.edit', compact('configuration_status'));
        } else {
            return redirect()->back();
        } 
    }

    public function update($configuration_status_id, Request $request)
    {
        $configuration_status = ConfigurationStatus::find($configuration_status_id);

        if ($configuration_status == null) {
            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->passes()) {

            $configuration_status->name = $request->name;
            $configuration_status->save();

            session::flash('success-configuration-status', 'Configuration Status updated successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Configuration Status updated successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($configuration_status_id, Request $request)
    {
        $loggedInUser = Auth::user();
        if ($loggedInUser && in_array($loggedInUser->role_name, [1])) {

            $configuration_status = ConfigurationStatus::find($configuration_status_id);

            if ($configuration_status == null) {
                return response()->json([
                    'status' => false,
                    'notFound' => true
                ]);
            }
    
            $configuration_status->delete();
    
            session::flash('success-configuration-status', 'Configuration Status deleted successfully.');
    
            return redirect()->route('pages.option-management.index');
        } else {
            return redirect()->back();
        } 
    }
}
