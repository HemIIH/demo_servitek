<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;

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
}