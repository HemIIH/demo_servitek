@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>{{trans('admin.Bewegungsdaten für Lohnabrechnung')}}</h4>
                </div>

                <div class="panel-body">
                    <div class="col-md-12">
                        <form class="form-inline" action="{{ url('admin/employee/payroll') }}" method="GET" target="_blank">
                            <div class="form-group">
                                <select class="form-control input-sm" name="month">
                                    <option value="">{{trans('admin.Monat')}}</option>
                                    @foreach(Date::monthNames() as $key => $month)
                                        <option value="{{ $key }}">{{ trans('admin.'.$month['full']) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control input-sm" class="form-control" name="year">
                                    <option value="">{{trans('admin.Jahr')}}</option>
                                    @foreach(range(2017, date('Y')) as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="submit" value="{{trans('admin.Lohnabrechnung anzeigen')}}" class="btn btn-default btn-sm">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection