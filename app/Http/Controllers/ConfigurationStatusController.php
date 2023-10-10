<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConfigurationStatus;

class ConfigurationStatusController extends Controller
{
    public function index(){
        $configuration_statuses = ConfigurationStatus::all();
        return view('pages.management.configuration-statuses.index', ['configuration_statuses' => $configuration_statuses]);
    }

    public function create(){
        return view('pages.management.configuration-statuses.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required'
        ]);

        $newConfigurationStatus = ConfigurationStatus::create($data);

        return redirect(route('pages.management.configuration-statuses.index'));
    }

    public function edit(ConfigurationStatus $configuration_status){
        return view('pages.management.configuration-statuses.edit', ['configuration_status' => $configuration_status]);
    }

    public function update(ConfigurationStatus $configuration_status, Request $request){
        $data = $request->validate([
            'name' => 'required'
        ]);

        $configuration_status->update($data);

        return redirect(route('pages.management.configuration-statuses.index'))->with('success', 'Configuration Status Updated Successfully');
    }

    public function destroy(ConfigurationStatus $configuration_status){
        $configuration_status->delete();
        return redirect(route('pages.management.configuration-statuses.index'))->with('success', 'Configuration Status Deleted Successfully');
    }
}
