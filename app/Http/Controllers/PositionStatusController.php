<?php

namespace App\Http\Controllers;

use App\Models\PositionStatus;
use Illuminate\Http\Request;

class PositionStatusController extends Controller
{
    public function index(){
        $position_statuses = PositionStatus::all();
        return view('pages.management.position-statuses.index', ['position_statuses' => $position_statuses]);
    }

    public function create(){
        return view('pages.management.position-statuses.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        PositionStatus::create($request->all());

        return redirect(route('pages.management.position-statuses.index'))->with('success', 'New Position Status Added Successfully!');
    }

    public function edit(PositionStatus $position_status){
        return view('pages.management.position-statuses.edit', ['position_status' => $position_status]);
    }

    public function update(PositionStatus $position_status, Request $request){
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $position_status->update($request->all());

        return redirect(route('pages.management.position-statuses.index'))->with('success', 'Position Status Updated Successfully!');
    }

    public function destroy(PositionStatus $position_status){
        $position_status->delete();
        return redirect(route('pages.management.position-statuses.index'))->with('success', 'Position Status Deleted Successfully!');
    }
}
