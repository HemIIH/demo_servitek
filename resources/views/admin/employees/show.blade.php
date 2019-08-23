@extends('admin.employees.partials.layout')

@section('tab_content')
    <div class="row">
        <div class="col-md-9">
            <employee-calendar :employee="{{ $employee }}"></employee-calendar>
        </div>
        <div class="col-md-3">
            <notes :model="{{ $employee }}" type="employee" can-delete="{{ true }}"></notes>
        </div>
    </div>
@endsection