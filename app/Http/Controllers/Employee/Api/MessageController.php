<?php

namespace App\Http\Controllers\Employee\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Message\MessageRequest;
use App\Mail\Request;

class MessageController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->client = auth()->user()->client;

            return $next($request);
        });
    }

    public function send(MessageRequest $request)
    {
        \Mail::send(new Request(auth()->user()));
    }
}