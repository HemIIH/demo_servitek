@extends('layouts.admin')

@section('content')
    <employee-table
            source="employee"
            can-create="{{ Auth::user()->can('create', \App\Models\Employee\Employee::class) }}"
            can-update="{{ Auth::user()->can('update', \App\Models\Employee\Employee::class) }}"
            can-delete="{{ Auth::user()->can('delete', \App\Models\Employee\Employee::class) }}"
    >
    </employee-table>
@endsection