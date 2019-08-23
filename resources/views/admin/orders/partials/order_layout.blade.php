@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('admin.orders.partials.nav_header')
                <div class="tab-content">

                    @yield('tab')

                </div>
            </div>
        </div>
    </div>
@endsection