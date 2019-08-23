@extends('layouts.employee')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary" style="height: 480px;">
                <div class="box-header with-border">
                    <h3 class="pull-right box-title"><a href="{{ '/e/calendar' }}">{{trans('employee.Übersicht')}}</a></h3>
                </div>
                <div class="box-body">
                    <calendar-by-week></calendar-by-week>
                </div>
            </div>

            <requested-orders></requested-orders>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>{{trans('employee.Monatliche Lohnabrechnungen')}}</h4>
                </div>
                <div class="panel-body">
                    <form class="form-inline" action="{{ url('/e/payroll') }}" method="GET" target="_blank">
                        <div class="form-group">
                            <select name="month" id="month" class="form-control input-sm" required>
                                <option value="">{{trans('employee.Monate')}}</option>
                                @foreach(config('settings.months') as $key => $month)
                                    <option value="{{ $key }}">{{ trans('employee.'.$month) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="year" id="year" class="form-control input-sm" required>
                                <option value="">{{trans('employee.Jahr')}}</option>
                                @for($i = date('Y'); $i >= 2017; $i--)
                                    <option value="{{ $i }}">{{ $i}}</option>
                                @endfor
                            </select>
                        </div>
                        <input type="submit" value="{{trans('employee.Lohnabrechnung anzeigen')}}" class="btn btn-default btn-sm">
                    </form>
                </div>
            </div>
            <div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>{{trans('employee.Der Dispo-Manager erstellt die endgültige Einsatzplanung')}}</p>
                        <hr>
                        <div class="margin-b-10">
                            <i class="fa fa-circle fa-lg margin-r-10"></i> {{trans('employee.Ihr Einsatz wurde vom Disponent weder bestätigt noch abgesagt')}}
                        </div>
                        <div class="margin-b-10">
                            <i class="fa fa-circle fa-lg text-success margin-r-10"></i> {{trans('employee.Sie sind für diesen Einsatz')}} <strong>{{trans('employee.eingeplant')}}</strong>
                        </div>
                        <div class="margin-b-10">
                            <i class="fa fa-circle fa-lg text-danger margin-r-10"></i> {{trans('employee.Sie sind für diesen Einsatz')}} <strong>{{trans('employee.nicht eingeplant')}}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
