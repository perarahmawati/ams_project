<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function create()
    {
        $loggedInUser = Auth::user();
        if ($loggedInUser && in_array($loggedInUser->role_name, [1])) {

            return view('pages.option-management.items.create');
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

            $item = new Item;
            $item->name = $request->name;
            $item->save();

            session::flash('success-item', 'Item added successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Item added successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($item_id, Request $request)
    {
        $loggedInUser = Auth::user();
        if ($loggedInUser && in_array($loggedInUser->role_name, [1])) {

            $item = Item::find($item_id);
        
            if ($item == null) {
                return redirect()->route('pages.option-management.index');
            }
    
            return view('pages.option-management.items.edit', compact('item'));
        } else {
            return redirect()->back();
        }
    }

    public function update($item_id, Request $request)
    {
        $item = Item::find($item_id);
        
        if ($item == null) {
            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->passes()) {

            $item->name = $request->name;
            $item->save();

            session::flash('success-item', 'Item updated successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Item updated successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($item_id, Request $request)
    {
        $loggedInUser = Auth::user();
        if ($loggedInUser && in_array($loggedInUser->role_name, [1])) {

            $item = Item::find($item_id);

            if ($item == null) {
                return response()->json([
                    'status' => false,
                    'notFound' => true
                ]);
            }
    
            $item->delete();
    
            session::flash('success-item', 'Item deleted successfully.');
    
            return redirect()->route('pages.option-management.index');
        } else {
            return redirect()->back();
        }
    }
}
