@extends('layouts.employee')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <employee-info :employee="{{ $employee }}"></employee-info>
        </div>
        <div class="col-md-7">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li {{ set_active('e/profile*') }}>
                        <a href="{{ url('/e/profile') }}">Stammdaten</a>
                    </li>
                    <li {{ set_active('e/documents*') }}>
                        <a href="{{ url('/e/documents') }}">Personalakte</a>
                    </li>
                </ul>
                <div class="tab-content">

                    <employee-profile :model="{{ $employee }}"></employee-profile>

                </div>
            </div>
        </div>
    </div>
@stop