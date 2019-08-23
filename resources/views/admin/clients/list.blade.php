@extends('layouts.admin')

@section('content')
    <client-table
            source="client"
            :clients="{{ $clients }}"
            can-update="true"
            can-delete="true"
    >
    </client-table>
@endsection