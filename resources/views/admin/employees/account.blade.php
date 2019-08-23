@extends('admin.employees.partials.layout')

@section('tab_content')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">{{trans('admin.Nutzerkonto')}}</h4>
                </div>
                <div class="panel-body">
                    <employee-account :model="{{ $employee }}"></employee-account>
                </div>
            </div>
        </div>
    </div>
@endsection