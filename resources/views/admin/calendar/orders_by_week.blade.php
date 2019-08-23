@extends('layouts.admin')

@section('content')
    <orders-by-week
            :employees="{{ $employees }}"
            :clients="{{ $clients }}"
            :locations="{{ $locations }}"
            start-date="{{ $start }}"
    >
    </orders-by-week>
@endsection
