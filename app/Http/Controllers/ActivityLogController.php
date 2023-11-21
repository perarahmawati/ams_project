<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DataTable;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $users = User::latest()->get();
        $datatable = DataTable::onlyTrashed()->paginate(10);
        // $logactivities = LogActivity::oldest()->simplePaginate(5);
        $logactivities = ActivityLog::with('users')->orderBy('id', 'DESC')->simplePaginate(5);

            return view('activity-log.index',compact('logactivities', 'users', 'datatable'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * CREATE
     */
    public function create()
    {
        return view('pages.data-tables.create');
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'configuration_status_name' => 'required',
        ]);
      
        ActivityLog::create($request->all());
       
        return redirect()->route('pages.data-tables.index')
                        ->with('success','Item add successfully.');
    }

    /**
     * SHOW
     */
    public function show(ActivityLog $item)
    {
        return view('pages.data-tables.show',compact('item'));
    }

    /**
     * EDIT
     */
    public function edit(ActivityLog $item)
    {
        return view('pages.data-tables.edit',compact('item'));
    }

    /**
     * UPDATE
     */
    public function update(Request $request, ActivityLog $item)
    {
        $request->validate([
            'item_name' => 'required',
            'configuration_status_name' => 'required',
        ]);
      
        $item->update($request->all());
      
        return redirect()->route('pages.data-tables.index')
                        ->with('success','Item updated successfully');
    }

    /**
     * DESTROY
     */
    public function destroy(ActivityLog $item)
    {
        $item->delete();
       
        return redirect()->route('pages.data-tables.index')
                        ->with('success','Item deleted successfully');

    }

    public function log(ActivityLog $logactivity) {
        return view('activity-log.index', [
            'logs' => Activity::where('subject_type', ActivityLog::class)->where('subject_id', $logactivity->id)->latest()->get()
        ]); 
    }
}
