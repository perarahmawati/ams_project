<?php

namespace App\Http\Controllers;

use App\Models\DataTable;
use App\Models\Item;
use App\Models\Manufacture;
use App\Models\ConfigurationStatus;
use App\Models\Location;
use App\Models\Image;
use App\Models\File;
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
        $data = $request->validate([
            'item_name' => 'required|exists:items,id',
            'manufacture_name' => 'required|exists:manufactures,id',
            'serial_number' => 'max:255',
            'configurationstatus_name' => 'required|exists:configuration_statuses,id',
            'location_name' => 'required|exists:locations,id'
        ]);

        $new_data = DataTable::create($request->all());

        if($request->has('images')){
            foreach($request->file('images') as $image){
                $imageName = $data['item_name'].'-image-'.time().rand(1,1000).'.'.$image->extension();
                $image->move(public_path('data_images'),$imageName);
                Image::create([
                    'data_table_id'=>$new_data->id,
                    'image'=>$imageName
                ]);
            }
        }

        if($request->has('files')){
            foreach($request->file('files') as $file){
                $fileName = $data['item_name'].'-file-'.time().rand(1,1000).'.'.$file->extension();
                $file->move(public_path('data_files'),$fileName);
                File::create([
                    'data_table_id'=>$new_data->id,
                    'file'=>$fileName
                ]);
            }
        }

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

    public function show(DataTable $data_table)
    {
        $dataTableObject = DataTable::find($data_table->id);
        if(!$dataTableObject) {
            abort(404);
        }
    
        $images = $dataTableObject->images;
        $files = $dataTableObject->files;
    
        $data_tables = DataTable::where('id', $data_table->id)->get();
    
        return view('pages.data-tables.show', compact('data_tables', 'dataTableObject', 'images', 'files'));
    }

    public function destroy(DataTable $data_table)
    {
        $data_table->delete();

        return redirect()->route('pages.data-tables.index')->with('success', 'Data Deleted Successfully!');
    }
}
