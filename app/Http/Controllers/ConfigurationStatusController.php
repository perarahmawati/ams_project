<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConfigurationStatus;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ConfigurationStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('pages.option-management.configuration-statuses.create');
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
        $configuration_status = ConfigurationStatus::find($configuration_status_id);

        if ($configuration_status == null) {
            return redirect()->route('pages.option-management.index');
        }

        return view('pages.option-management.configuration-statuses.edit', compact('configuration_status'));
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
    }
}
