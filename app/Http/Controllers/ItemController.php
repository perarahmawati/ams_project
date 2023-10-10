<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index(){
        $items = Item::all();
        return view('pages.management.items.index', ['items' => $items]);
    }

    public function create(){
        return view('pages.management.items.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required'
        ]);

        $newItem = Item::create($data);

        return redirect(route('pages.management.items.index'));
    }

    public function edit(Item $item){
        return view('pages.management.items.edit', ['item' => $item]);
    }

    public function update(Item $item, Request $request){
        $data = $request->validate([
            'name' => 'required'
        ]);

        $item->update($data);

        return redirect(route('pages.management.items.index'))->with('success', 'Item Updated Successfully');
    }

    public function destroy(Item $item){
        $item->delete();
        return redirect(route('pages.management.items.index'))->with('success', 'Item Deleted Successfully');
    }
}
