<?php

namespace App\Http\Controllers;

use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class TempImageController extends Controller
{
    public function store(Request $request){
        if(!empty($request->image)) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();

            $tempImage = new TempImage();
            $tempImage->name = 'NULL';
            $tempImage->save();

            $imageName = $tempImage->id.'.'.$ext;

            $tempImage->name = $imageName;
            $tempImage->save();

            $image->move(public_path('uploads/temp/'),$imageName);

            // Create Thumnail
            $sourcePath = public_path('uploads/temp/'.$imageName);
            $destPath = public_path('uploads/temp/thumb/'.$imageName);
            $img = Image::make($sourcePath);
            $img->fit(350,300);
            $img->save($destPath);

            return response()->json([
                'status' => true,
                'image_id' => $tempImage->id,
                'name' => $imageName,
                'imagePath' => asset('uploads/temp/thumb/'.$imageName)
            ]);
        }
    }

    public function destroy($image_id, Request $request){
        $image = TempImage::find($image_id);

        if (empty($image)) {
            $request->session()->flash('error','Image not found.');
            return response()->json([
                'status' => false
            ]);
        }

        File::delete(public_path('uploads/temp/'.$image->name));
        File::delete(public_path('uploads/temp/thumb/'.$image->name));

        $image->delete();

        $request->session()->flash('success','Image deleted successfully.');

        return response()->json([
            'status' => true
        ]);
    }
}
