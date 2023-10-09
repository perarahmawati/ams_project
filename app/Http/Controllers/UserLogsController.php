<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserLogsController extends Controller
{
    public function index()
    {
        return view('pages.history-logs.user-logs.index');
    }
}
