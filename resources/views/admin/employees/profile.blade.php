@extends('admin.employees.partials.layout')

@section('tab_content')
    <employee-profile
            :model="{{ $employee }}"
            :countries="{{ $countries }}"
            can-update="{{ auth()->user()->can('update', \App\Models\Employee\Employee::class) }}"
    >
    </employee-profile>
@endsection