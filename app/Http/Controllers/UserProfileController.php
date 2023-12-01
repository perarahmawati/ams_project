<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.user-profile');
    }

    public function updatePersonalInformation(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=> 'required|email|unique:users,email,'.Auth::user()->id,
            'phone'=>'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $query = User::find(Auth::user()->id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
            ]);

            if(!$query){
                return response()->json(['status'=>0,'msg'=>'Something went wrong.']);
            }else{
                return response()->json(['status'=>1,'msg'=>'Your personal information has been update successfully.']);
            }
        }
    }

    public function changeProfilePicture(Request $request)
    {
        $path = 'users/pictures/';
        $file = $request->file('picture');
        $new_name = 'IMG_'.date('Ymd').uniqid().'.jpg';

        //Upload new picture
        $upload = $file->move(public_path($path), $new_name);
        
        if( !$upload ){
            return response()->json(['status'=>0,'msg'=>'Something went wrong.']);
        }else{
            //Get Old picture
            $oldPicture = User::find(Auth::user()->id)->getAttributes()['picture'];

            if( $oldPicture != '' ){
                if( File::exists(public_path($path.$oldPicture))){
                    File::delete(public_path($path.$oldPicture));
                }
            }

            //Update DB
            $update = User::find(Auth::user()->id)->update(['picture'=>$new_name]);

            if( !$upload ){
                return response()->json(['status'=>0,'msg'=>'Something went wrong.']);
            }else{
                return response()->json(['status'=>1,'msg'=>'Your profile picture has been updated successfully.']);
            }
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'old_password'=>[
                'required', function($attribute, $value, $fail){
                    if(!Hash::check($value, Auth::user()->password)){
                        return $fail(__('The current password is incorrect'));
                    }
                },
                'min:8',
                'max:30'
            ],
            'new_password'=>'required|min:8|max:30|different:old_password',
            'confirm_password'=>'required|same:new_password',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $update = User::find(Auth::user()->id)->update([
                'password'=>Hash::make($request->new_password),
            ]);

            if(!$update){
                return response()->json(['status'=>0,'msg'=>'Something went wrong.']);
            }else{
                return response()->json(['status'=>1,'msg'=>'Your password has been update successfully.']);
            }
        }
    }
}
