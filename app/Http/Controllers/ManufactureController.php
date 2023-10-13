<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufacture;

class ManufactureController extends Controller
{
    public function index(){
        $manufactures = Manufacture::all();
        return view('pages.management.manufactures.index', ['manufactures' => $manufactures]);
    }

    public function create(){
        return view('pages.management.manufactures.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Manufacture::create($request->all());

        return redirect(route('pages.management.manufactures.index'))->with('success', 'New Manufacturer Added Successfully!');
    }

    public function edit(Manufacture $manufacture){
        return view('pages.management.manufactures.edit', ['manufacture' => $manufacture]);
    }

    public function update(Manufacture $manufacture, Request $request){
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $manufacture->update($request->all());

        return redirect(route('pages.management.manufactures.index'))->with('success', 'Manufacture Updated Successfully!');
    }

    public function destroy(Manufacture $manufacture){
        $manufacture->delete();
        return redirect(route('pages.management.manufactures.index'))->with('success', 'Manufacture Deleted Successfully!');
    }
}
