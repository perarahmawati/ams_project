<?php

namespace App\Http\Controllers;

use App\Models\DataTable;
use App\Models\Item;
use App\Models\Manufacture;
use App\Models\ConfigurationStatus;
use App\Models\Location;
use Illuminate\Http\Request;

class DataTableController extends Controller
{
    public function index()
    {
        $data_tables = DataTable::all();
      
        return view('pages.data-tables.index',compact('data_tables'));
    }

    public function create()
    {
        $item_names = Item::all();
        $manufacture_names = Manufacture::all();
        $configurationstatus_names = ConfigurationStatus::all();
        $location_names = Location::all();
        return view('pages.data-tables.create', compact('item_names', 'manufacture_names', 'configurationstatus_names', 'location_names'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|exists:items,id',
            'manufacture_name' => 'required|exists:manufactures,id',
            'serial_number' => 'max:255',
            'configurationstatus_name' => 'required|exists:configuration_statuses,id',
            'location_name' => 'required|exists:locations,id'
        ]);

        DataTable::create($request->all());
       
        return redirect()->route('pages.data-tables.index')->with('success', 'New Data Added Successfully!');
    }

    public function edit(DataTable $data_table)
    {
        $item_names = Item::all();
        $manufacture_names = Manufacture::all();
        $configurationstatus_names = ConfigurationStatus::all();
        $location_names = Location::all();
        return view('pages.data-tables.edit', compact('data_table', 'item_names', 'manufacture_names', 'configurationstatus_names', 'location_names'));
    }

    public function update(Request $request, DataTable $data_table)
    {
        $request->validate([
            'item_name' => 'required|exists:items,id',
            'manufacture_name' => 'required|exists:manufactures,id',
            'serial_number' => 'max:255',
            'configurationstatus_name' => 'required|exists:configuration_statuses,id',
            'location_name' => 'required|exists:locations,id'
        ]);

        $data_table->update($request->all());

        return redirect()->route('pages.data-tables.index')->with('success', 'Data Updated Successfully!');
    }

    public function destroy(DataTable $data_table)
    {
        $data_table->delete();

        return redirect()->route('pages.data-tables.index')->with('success', 'Data Deleted Successfully!');
    }
}
