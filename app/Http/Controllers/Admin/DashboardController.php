<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Note;

class DashboardController extends Controller
{

    /**
     * Show dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['notes'] = Note::with('loggable', 'user')
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(40)
            ->get()
            ->groupBy('loggable_type');

        return view('admin.dashboard.index', $data);
    }

}
