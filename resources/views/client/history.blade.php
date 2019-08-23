@extends('layouts.client')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>{{trans('admin.Kundenhistorie')}}</h4>
                </div>
                <div class="panel-body">
                    <client-history :items="{{ $client->orders()->with('timetrackings')->get() }}"></client-history>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>{{trans('admin.Monatsübersicht')}}</h4>
                </div>
                <div class="panel-body">
                    @if (count($timetrackings_by_date))
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{trans('admin.Monat')}}</th>
                                <th>{{trans('admin.Zeiterfasst')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($timetrackings_by_date as $timetracking)
                                <tr>
                                    <td>{{ Date::monthName($timetracking->month) . ' ' . $timetracking->year }}</td>
                                    <td>{{ Time::output($timetracking->total_min) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>{{trans('admin.Keine_zeiterfassten_Aufträg')}}</p>
                    @endif
                </div>
            </div>

            @if (count($timetrackings_by_employee))
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>{{trans('admin.Eingesetzte Mitarbeiter')}}</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{trans('admin.Mitarbeiter')}}</th>
                                <th>{{trans('admin.Zeiterfasst')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($timetrackings_by_employee as $timetracking)
                                <tr>
                                    <td>{{ $timetracking->employee->last_name . ', ' . $timetracking->employee->first_name }}</td>
                                    <td>{{ Time::output($timetracking->total_min) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop