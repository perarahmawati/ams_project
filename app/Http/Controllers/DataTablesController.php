<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataTablesController extends Controller
{
    public function index()
    {
        return view('pages.data-tables.index');
    }
}
