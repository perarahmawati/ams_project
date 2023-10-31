<?php

namespace App\Http\Controllers;

use App\Models\DataTable;
use App\Models\Item;
use App\Models\Manufacture;
use App\Models\ConfigurationStatus;
use App\Models\DataTableImage;
use App\Models\Location;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

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
        $configuration_status_names = ConfigurationStatus::all();
        $location_names = Location::all();
        return view('pages.data-tables.create', compact('item_names', 'manufacture_names', 'configuration_status_names', 'location_names'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|exists:items,id',
            'manufacture_name' => 'required|exists:manufactures,id',
            'serial_number' => 'max:50',
            'configuration_status_name' => 'required|exists:configuration_statuses,id',
            'location_name' => 'required|exists:locations,id',
            'description' => 'max:255'
        ]);

        if ($validator->passes()) {

            $data_table = new DataTable;
            $data_table->item_name = $request->item_name;
            $data_table->manufacture_name = $request->manufacture_name;
            $data_table->serial_number = $request->serial_number;
            $data_table->configuration_status_name = $request->configuration_status_name;
            $data_table->location_name = $request->location_name;
            $data_table->description = $request->description;
            $data_table->save();

            if (!empty($request->image_id)){
                $caption = $request->caption;
                foreach ($request->image_id as $key => $imageId) {

                    $tempImage = TempImage::find($imageId);
                    $extArray = explode('.',$tempImage->name);
                    $ext = last($extArray);

                    $data_tableImage = new DataTableImage;
                    $data_tableImage->name = 'NULL';
                    $data_tableImage->data_table_id = $data_table->id;
                    $data_tableImage->caption = $caption[$key];
                    $data_tableImage->save();

                    $newImageName = $data_tableImage->id.'.'.$ext;
                    $data_tableImage->name = $newImageName;
                    $data_tableImage->save();

                    // First Thumbnail
                    $sourcePath = public_path('uploads/temp/'.$tempImage->name);
                    $destPath = public_path('uploads/data_tables/small/'.$newImageName);
                    $img = Image::make($sourcePath);
                    $img->fit(350,300);
                    $img->save($destPath);

                    // Second Thumbnail
                    $sourcePath = public_path('uploads/temp/'.$tempImage->name);
                    $destPath = public_path('uploads/data_tables/large/'.$newImageName);
                    $img = Image::make($sourcePath);
                    $img->resize(1200, null, function($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->save($destPath);
                }
            }

            $request->session()->flash('success', 'Data added successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Data updated successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($data_table_id, Request $request)
    {
        $data_table = DataTable::find($data_table_id);
        if ($data_table == null) {
            return redirect()->route('pages.data-tables.index');
        }
        
        $data_tableImages = DataTableImage::where('data_table_id',$data_table->id)->get();

        $item_names = Item::all();
        $manufacture_names = Manufacture::all();
        $configuration_status_names = ConfigurationStatus::all();
        $location_names = Location::all();
        
        return view('pages.data-tables.edit', compact( 'data_table', 'data_tableImages', 'item_names', 'manufacture_names', 'configuration_status_names', 'location_names'));
    }

    public function update($data_table_id, Request $request)
    {
        $data_table = DataTable::find($data_table_id);

        if ($data_table == null) {
            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }

        $validator = Validator::make($request->all(), [
            'item_name' => 'required|exists:items,id',
            'manufacture_name' => 'required|exists:manufactures,id',
            'serial_number' => 'max:50',
            'configuration_status_name' => 'required|exists:configuration_statuses,id',
            'location_name' => 'required|exists:locations,id',
            'description' => 'max:255'
        ]);

        if ($validator->passes()) {

            $data_table->item_name = $request->item_name;
            $data_table->manufacture_name = $request->manufacture_name;
            $data_table->serial_number = $request->serial_number;
            $data_table->configuration_status_name = $request->configuration_status_name;
            $data_table->location_name = $request->location_name;
            $data_table->description = $request->description;
            $data_table->save();

            if (!empty($request->image_id)){
                $caption = $request->caption;

                foreach ($request->image_id as $key => $imageId) {
                    
                    $data_tableImage = DataTableImage::find($imageId);
                    $data_tableImage->caption = $caption[$key];
                    $data_tableImage->save();

                }
            }

            $request->session()->flash('success', 'Data updated successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Data updated successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    
    public function destroy(DataTable $data_table)
    {
        $data_table->delete();

        return redirect()->route('pages.data-tables.index')->with('success', 'Data Deleted Successfully!');
    }
}
