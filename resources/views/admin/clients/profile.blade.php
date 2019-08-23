@extends('admin.clients.partials.layout')

@section('tab')
    <div class="row">
        <div class="col-md-7">
            <client-profile :data="{{ $client }}"></client-profile>
        </div>

        <div class="col-md-5">
            <charge-rates :model="{{ $client }}" can-delete="{{ true }}"></charge-rates>

            <client-contacts :client="{{ $client }}"></client-contacts>
        </div>
    </div>
@endsection