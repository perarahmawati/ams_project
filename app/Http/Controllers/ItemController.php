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
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Item::create($request->all());

        return redirect(route('pages.management.items.index'))->with('success', 'New Item Added Successfully!');
    }

    public function edit(Item $item){
        return view('pages.management.items.edit', ['item' => $item]);
    }

    public function update(Item $item, Request $request){
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $item->update($request->all());

        return redirect(route('pages.management.items.index'))->with('success', 'Item Updated Successfully!');
    }

    public function destroy(Item $item){
        $item->delete();
        return redirect(route('pages.management.items.index'))->with('success', 'Item Deleted Successfully!');
    }
}
