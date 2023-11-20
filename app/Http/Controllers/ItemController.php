<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('pages.management.items.create');
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
        $item = Item::find($item_id);
        
        if ($item == null) {
            return redirect()->route('pages.management.index');
        }

        return view('pages.management.items.edit', compact('item'));
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
        $item = Item::find($item_id);

        if ($item == null) {
            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }

        $item->delete();

        session::flash('success-item', 'Item deleted successfully.');

        return redirect()->route('pages.management.index');
    }
}
