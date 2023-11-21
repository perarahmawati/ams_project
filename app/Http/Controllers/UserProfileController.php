<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    /**
     * INDEX
     */

     public function index()
     {
         $users = DB::select('select * from users');
       
         return view('user_profile.edit',['users'=>$users]);
     }

    /**
     * EDIT
     * 
     * Show the update profile page.
     *
     * @param  Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function edit(Request $request, User $user)
    {
        $users = DB::select('select * from users');

        return view('user_profile.edit', [
            'users' => $users,
            'user' => $request->user()
        ]);
    }

    /**
    * UPDATE
    * 
    * Update user's profile
    *
    * @param  Request $request
    * @return \Illuminate\Contracts\Support\Renderable
    */

    public function update(Request $request, User $user)
    {
        $request->user()->update(
            $request->all()
        );

        return redirect()->route('profiles.edit')
                        ->with('success', 'Profile updated successfully');
    }

    public function upload(Request $request, User $user)
    {
        if ($request->hasFile('image')) {
            $fileName = strtolower($request->file('image')->getClientOriginalName());
              $this->deleteOldImage();
            $request->image->storeAs('public/images', $fileName);
            Auth()->user()->update(['image'=>$fileName]);

        }
        return redirect()->back()
                        ->with('success', 'Image updated successfully');
    }

    protected function deleteOldImage()
    {
        if (Storage::exists('public/images/' . auth()->user()->image)) {
              Storage::delete('public/images/' . auth()->user()->image);
            }
        else {
            $fileName =  Auth()->user()->image;
        }

        return redirect()->route('profiles.edit');
    }
}
