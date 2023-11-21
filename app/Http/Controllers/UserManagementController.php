<?php

namespace App\Http\Controllers;

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
}
