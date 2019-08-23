@extends('layouts.client')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <client-info :client="{{ $client }}"></client-info>

            <charge-rates :rates="{{ $client->rates }}"></charge-rates>
        </div>
        <div class="col-md-4">
            <client-profile :data="{{ $client }}"></client-profile>
        </div>
        <div class="col-md-3">
            <contacts :client="{{ $client }}"></contacts>
        </div>
    </div>

@stop