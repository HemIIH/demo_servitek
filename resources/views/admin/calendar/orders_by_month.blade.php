@extends('layouts.admin')

@section('content')
    <orders-by-month
            :employees="{{ $employees }}"
            :clients="{{ $clients }}"
            :locations="{{ $locations }}"
            start-date="{{ $start }}"
    >
    </orders-by-month>
@endsection
