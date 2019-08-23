@extends('admin.clients.partials.layout')

@section('tab')
    <div class="row">
        <div class="col-md-9">
            <client-calendar :client="{{ $client }}"></client-calendar>
        </div>
        <div class="col-md-3">
            <notes :model="{{ $client }}" type="client" can-delete="{{ true }}"></notes>
        </div>
    </div>
@endsection