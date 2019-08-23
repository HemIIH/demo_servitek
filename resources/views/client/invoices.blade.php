@extends('layouts.client')

@section('content')
    <client-invoice
            :client="{{ $client }}"
            :invoices="{{ $invoices }}"
    >
    </client-invoice>
@stop