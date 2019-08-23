@extends('admin.clients.partials.layout')

@section('tab')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">{{trans('admin.Nutzerkonto')}}</h4>
                </div>
                <div class="panel-body">
                    <client-account :model="{{ $client }}"></client-account>
                </div>
            </div>
        </div>
    </div>
@endsection