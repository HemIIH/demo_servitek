@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <client-overview :client="{{ $client }}"></client-overview>
        </div>

        <div class="col-md-9">
            <div class="nav-tabs-custom">
                @include('admin.clients.partials.nav_header')
                <div class="tab-content">

                    @yield('tab')

                </div>
            </div>
        </div>
    </div>
@endsection