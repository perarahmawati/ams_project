<?php

namespace App\Http\Controllers;

use App\Models\DataTable;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * INDEX
     */

    public function index()
    {
        $users = User::latest()->paginate(10);
       
        return view('user-management.index', compact('users'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('user-management.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'email' =>'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        User::create($request->all());

        return redirect()->route('user-management.index')
                         ->with('Success', 'User Added Successfully');
    }

    public function edit(User $user)
    {
        return view('user-management.edit', compact('item'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=> 'required',
            'email' =>'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $user->update($request->all());

        return redirect()->route('user-management.index')
                         ->with('Success', 'User Edited Successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('item-names.index')
                        ->with('Success', 'Item Deleted Successfully');
    }

}
