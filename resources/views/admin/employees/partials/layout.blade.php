@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <employee-overview :employee="{{ $employee->load('roles') }}"></employee-overview>
        </div>

        <div class="col-md-9">
            <div class="nav-tabs-custom">
                @include('admin.employees.partials.nav_header')
                <div class="tab-content">

                    @yield('tab_content')

                </div>
            </div>
        </div>
    </div>
@endsection