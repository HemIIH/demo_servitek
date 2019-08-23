@extends('layouts.admin')

@section('content')
    <calendar-overview
            :clients="{{ $clients }}"
            :locations="{{ $locations }}"
    >
    </calendar-overview>
@endsection
