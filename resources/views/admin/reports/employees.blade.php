@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary" style="height: 400px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><a href="{{ url('admin/reports/employees') }}">{{trans('admin.Mitarbeiterpool')}}</a></h3>
                </div>
                <div class="box-body no-padding">
                    <div class="row">
                        <div class="col-md-5">
                            <pie-chart
                                    title="{{trans('admin.Mitarbeiter nach Geschlecht')}}"
                                    url="/api/report/chart/employee-pool/gender"
                                    width="300" height="300"
                            >
                            </pie-chart>
                        </div>
                        <div class="col-md-5 col-md-offset-1">
                            <pie-chart
                                    title="{{trans('admin.Mitarbeiter nach Beschäftigungsart')}}"
                                    url="/api/report/chart/employee-pool/occupation"
                                    width="300" height="300"
                            >
                            </pie-chart>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary" style="height: 400px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><a href="{{ url('admin/reports/employees') }}">{{trans('admin.Mitarbeiterpool')}}</a></h3>
                </div>
                <div class="box-body no-padding">
                    <div class="row">
                        <div class="col-md-5">
                            <pie-chart
                                    title="{{trans('admin.Mitarbeiter nach Standort')}}"
                                    url="/api/report/chart/employees-by-location"
                                    width="300" height="300"
                            >
                            </pie-chart>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection