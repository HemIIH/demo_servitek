@extends('layouts.admin')

@section('content')
    <div class="nav-tabs-custom">
        @include('admin.settings.misc.partials.nav_header')
        <div class="tab-content">

            <div class="tab-pane active">
                <div class="row">

                    @include('admin.settings.misc.salaries.partials.sidebar')

                    <div class="col-md-6">
                        <div class="panel panel-default">
                            @yield('panel')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection