@extends('layouts.admin')

@section('content')
    <div class="nav-tabs-custom">
        @include('admin.settings.account.partials.nav_header')
        <div class="tab-content">
            <div class="tab-pane active">

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>{{ $title }}</h3>
                            </div>
                            <div class="panel-body">
                                @yield('panel')
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection