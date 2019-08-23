<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UpdateUserCredentialsRequest;
use App\Http\Requests\User\UserCredentialsRequest;
use App\Models\Document;
use App\Models\Order\Repos\TimetrackingRepository;

class EmployeeController extends Controller
{
    protected $employee;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->employee = auth()->user()->employee;

            return $next($request);
        });
    }

    public function dashboard()
    {
        $data['employee'] = $this->employee;

        return view('employee.dashboard', $data);
    }

    /**
     * Show calendar for employee.
     *
     * @return \Illuminate\View\View
     */
    public function calendar()
    {
        $data['employee'] = $this->employee;

        return view('employee.calendar', $data);
    }

    /**
     * Show profile for employee.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        $data['employee'] = $this->employee->load('wages');

        return view('employee.profile', $data);
    }

    /**
     * Show documents for employee.
     *
     * @return \Illuminate\View\View
     */
    public function documents()
    {
        $data['employee'] = $this->employee->load('documents');

        return view('employee.documents', $data);
    }

    public function baseData()
    {
        return \PDF::setPaper('A4')
            ->loadView('pdf.documents.base_data', ['employee' => $this->employee])
            ->stream('Stammdaten.pdf');
    }

    /**
     * Show document/file.
     *
     * @param Document $document
     * @return \Illuminate\Http\Response
     */
    public function document(Document $document)
    {
        $file = \Storage::get($document->path);

        return response($file, 200)->header('Content-Type', \Storage::mimeType($document->path));
    }

    /**
     * Show history for employee.
     *
     * @param TimetrackingRepository $timetracking
     *
     * @return \Illuminate\View\View
     */
    public function history(TimetrackingRepository $timetracking)
    {
        $data['employee'] = $this->employee;

        $data['timetrackings_by_client'] = $timetracking->groupedByClient($this->employee);
        $data['timetrackings_by_date']   = $timetracking->groupedByDate('employee', $this->employee);
        $data['orders']                  = $this->employee->orders()
                                                ->approved()
                                                ->with('client')
                                                ->with(['timetrackings' => function($query) {
                                                    $query->where('employee_id', $this->employee->id);
                                                }])->get();

        return view('employee.history', $data);
    }

    /**
     * Show employee settings.
     *
     * @return \Illuminate\View\View
     */
    public function settings()
    {
        $data['employee'] = $this->employee;
        $data['user']   = $this->employee->user;

        return view('employee.settings', $data);
    }

    /**
     * Show employee's settings.
     *
     * @param UserCredentialsRequest $request
     * @return \Illuminate\View\View
     */
    public function updateSettings(UserCredentialsRequest $request)
    {
        if(! $request->save()) {
            error('wrong_password');
        } else {
            success('credentials_updated');
        }

        return redirect()->back();
    }
}