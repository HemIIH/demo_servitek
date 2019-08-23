@extends('admin.employees.partials.layout')

@section('tab_content')
    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">{{trans('admin.Monatliche Lohnabrechnungen')}}</div>
                </div>
                <div class="panel-body">
                    <form class="form-inline" action="{{ url('admin/employee/' . $employee->id . '/payroll/pdf') }}" method="GET" target="_blank">
                        <div class="form-group">
                            <select name="month" id="month" class="form-control input-sm" required>
                                <option value="">{{trans('admin.Monat')}}</option>
                                @foreach(config('settings.months') as $key => $month)
                                    <option value="{{ $key }}">{{ trans('admin.'.$month) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="year" id="year" class="form-control input-sm" required>
                                <option value="">{{trans('admin.Jahr')}}</option>
                                @for($i = 2017; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}">{{ $i}}</option>
                                @endfor
                            </select>
                        </div>
                        <input type="submit" value="{{trans('admin.Lohnabrechnung anzeigen')}}" class="btn btn-default btn-sm">
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <extra-business :model="{{ $employee }}" can-delete="{{ true }}"></extra-business>
                </div>
                <div class="col-md-12">
                    <payroll-modification :model="{{ $employee }}" can-delete="{{ true }}"></payroll-modification>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <wages :model="{{ $employee }}" can-delete="{{ true }}"></wages>

            <working-hours :model="{{ $employee }}" can-delete="{{ true }}"></working-hours>
        </div>
    </div>
@endsection