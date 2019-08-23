<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCredentialsRequest;
use App\Models\Order\Repos\TimetrackingRepository;

class ClientController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->client = auth()->user()->client;

            return $next($request);
        });
    }

    /**
     * Show client dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $data['client']   = $this->client;
        $data['invoices'] = $this->client->invoices()->latest('invoice_date')->get();

        return view('client.dashboard', $data);
    }

    /**
     * Show calendar for client.
     *
     * @return \Illuminate\View\View
     */
    public function calendar()
    {
        $data['client'] = $this->client;

        return view('client.calendar', $data);
    }

    /**
     * Show profile for client.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        $data['client'] = $this->client;

        return view('client.profile', $data);
    }

    /**
     * Show history for client.
     *
     * @param TimetrackingRepository $timetracking
     *
     * @return \Illuminate\View\View
     */
    public function history(TimetrackingRepository $timetracking)
    {
        $data['client'] = $this->client;

        $data['timetrackings_by_employee'] = $timetracking->groupedByEmployee($this->client);
        $data['timetrackings_by_date']     = $timetracking->groupedByDate('client', $this->client);

        return view('client.history', $data);
    }

    /**
     * Show invoices.
     *
     * @return \Illuminate\View\View
     */
    public function invoices()
    {
        $data['client']   = $this->client->load(['invoiceData', 'invoices', 'contacts']);
        $data['invoices'] = $this->client->invoices()->where('sent', true)->get();

        return view('client.invoices', $data);
    }

    /**
     * Show client settings.
     *
     * @return \Illuminate\View\View
     */
    public function settings()
    {
        $data['client'] = $this->client;
        $data['user']   = $this->client->user;

        return view('client.settings', $data);
    }

    /**
     * Show client's settings.
     *
     * @param UserCredentialsRequest $request
     * @return \Illuminate\View\View
     */
    public function updateSettings(UserCredentialsRequest $request)
    {
        if ($request->ajax()) return;

        if(! $request->persist()) {
            error('wrong_password');
        } else {
            success('credentials_updated');
        }

        return redirect()->back();
    }
}