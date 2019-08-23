<?php

namespace App\Http\Controllers\Admin\Client;

use App\Services\Helper\HasAccount;
use App\Models\Client\Client;
use App\Models\Order\Repos\TimetrackingRepository;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    use HasAccount;

    protected $userType = 'client';

    /**
     * Show all clients.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['clients'] = Client::orderBy('name')->get();

        return view('admin.clients.list', $data);
    }

    /**
     * Show overview for single client.
     *
     * @param Client $client
     * @return \Illuminate\View\View
     */
    public function show(Client $client)
    {
        return view('admin.clients.show')
            ->with('client', $client->load('contacts'));
    }

    /**
     * Show single client's profile.
     *
     * @param Client $client
     * @return \Illuminate\View\View
     */
    public function profile(Client $client)
    {
        return view('admin.clients.profile')
            ->with('client', $client->load('contacts'));
    }

    /**
     * Show order history for a client.
     *
     * @param Client $client
     * @param TimetrackingRepository $timetracking
     * @return \Illuminate\View\View
     */
    public function history(Client $client, TimetrackingRepository $timetracking)
    {
        $data['timetrackings_by_employee'] = $timetracking->groupedByEmployee($client);
        $data['timetrackings_by_date']     = $timetracking->groupedByDate('client', $client);

        return view('admin.clients.history', $data)
            ->with('client', $client->load('contacts'));
    }

    /**
     * Show invoices for a client.
     *
     * @param Client $client
     * @return \Illuminate\View\View
     */
    public function invoice(Client $client)
    {
        return view('admin.clients.invoices')
            ->with('client', $client->load(['invoiceData', 'invoices', 'contacts']));
    }

    /**
     * Show account.
     *
     * @param Client $client
     * @return \Illuminate\View\View
     */
    public function account(Client $client)
    {
        return view('admin.clients.account')
            ->with('client', $client->load('contacts'));
    }

    /**
     * Create/show documents for a client.
     *
     * @param Client $client
     * @return \Illuminate\View\View
     */
    public function documents(Client $client)
    {
        return view('admin.clients.documents')
            ->with('client', $client->load('contacts'));
    }
}
