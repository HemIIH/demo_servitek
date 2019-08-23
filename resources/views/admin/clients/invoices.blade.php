@extends('admin.clients.partials.layout')

@section('tab')
    <client-invoice :client="{{ $client }}"></client-invoice>
@endsection