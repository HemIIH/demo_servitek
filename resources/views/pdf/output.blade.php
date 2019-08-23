@extends('pdf.layouts.master')

@section('styles')
    <style>
        body {
            font-size: 14px;
        }

        @page {
            margin: 150px 50px 30px;
        }

        #header {
            top: -150px;
            height: 150px;
        }

        #footer {
            bottom: -30px;
            height: 30px;
        }

        ul {
            margin: 5px 0;
            padding-left: 20px;
        }

        li {
            margin-left: 2px;
        }
    </style>
@endsection

@section('header')
        <table style="margin-top: 20px;">
            <tr>
                <td>
                    <h2 style="margin: 15px 0;">{{trans('admin.Bewegungsdaten für Lohnabrechnung')}}</h2>
                    <p><strong>{{trans('admin.Zeitraum')}}:</strong> {{ Date::monthYear($date->format('d.m.Y')) }}</p>
                </td>
                <td style="text-align: right;"><img src="{{ asset('assets/img/logo_big.jpg') }}" alt="" style="height:80px; width:auto; display:block; margin-bottom: 10px"></td>
            </tr>
        </table>

        <hr>
@endsection

@section('content')

        @php
            $groups = [
                'timetracked'     => $employees->whereIn('id', $timetrackings->keys()),
                'not_timetracked' => $employees->whereNotIn('id', $timetrackings->keys())
            ]
        @endphp
        @foreach($groups as $employees)

            @continue(count($employees) == 0)

            @foreach($employees->chunk(5) as $chunck)
                <table class="table">
                    <thead>
                    <tr>
                        <th>{{trans('admin.Name')}}</th>
                        <th>{{trans('admin.Stunden')}}</th>
                        <th width="100px">{{trans('admin.Vertrag')}}</th>
                        <th>{{trans('admin.AZK')}}</th>
                        @foreach(config('settings.payroll_relevant_factors') as $key => $item)
                            <th>{{ trans('admin.'.$item['name']) }}</th>
                        @endforeach
                        <th>{{trans('admin.Fehltage')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($chunck as $employee)
                        <tr style="text-align: center;">
                            <td rowspan="3" style="border-bottom:2px solid black; {{ in_array($employee->id, $not_timetracked) ? 'color:red;' : '' }}">{{ $employee->last_name . ', ' . $employee->first_name }}</td>
                            <td>{{ isset($total[$employee->id]) ? Time::output($total[$employee->id], false) : '-' }}</td>
                            <td>{{ $employee->occupation_type == 'part_time' ? 'TZ (' . $employee->contractual_working_hours . ' Std.)' : trans('admin.Geringfügig') }}</td>
                            <td>{{ ($employee->occupation_type == 'part_time' && isset($total[$employee->id])) ? Time::output($total[$employee->id] - $employee->contractual_working_hours * 60, false) : '-'  }}</td>
                            @foreach(config('settings.payroll_relevant_factors') as $key => $item)
                                @if(isset($payroll[$employee->id]) && $payroll[$employee->id]->contains('type', $key))
                                    <td>{{ money($payroll[$employee->id]->where('type', $key)->first()->amount) }}</td>
                                @else
                                    <td> </td>
                                @endif
                            @endforeach
                            <td style="text-align: left;border-bottom:2px solid black;" rowspan="3">
                                @if(isset($time_off[$employee->id]))
                                    <ul>
                                        @foreach($time_off[$employee->id] as $entry)
                                            <li>{{ $entry->type . ': ' . $entry->days }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <ul>
                                    <li>{{trans('admin.Zeiterfasst')}}: {!! isset($timetrackings[$employee->id]) ? Time::output($timetrackings[$employee->id], false) : '-' !!}</li>

                                    @if(isset($extra_business[$employee->id]))
                                        @foreach($extra_business[$employee->id] as $entry)
                                            <li>{{ config('settings.extra_business')[$entry->type]['name'] . ': ' . Time::output($entry->total_min) }}</li>
                                        @endforeach
                                    @endif

                                </ul>
                            </td>
                            <td colspan="7">
                                @if(isset($notes[$employee->id]))
                                    @foreach($notes[$employee->id] as $note)
                                        <p style="font-size: 10px;margin: 0 0 3px;">{{ $note->information }}</p>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border-bottom:2px solid black;">{{trans('admin.Status')}}: {{ $employee->active ? trans('admin.Aktiv') : trans('admin.Inaktiv') }}</td>
                            <td colspan="2" style="border-bottom:2px solid black;">{{trans('admin.Eintritt')}}: {{ $employee->entry_date }}</td>
                            <td colspan="2" style="border-bottom:2px solid black;">{{trans('admin.Austritt')}}: {{ $employee->exit_date or '-' }}</td>
                            <td colspan="3" style="border-bottom:2px solid black;">{{trans('admin.Lohn')}}: {{ $employee->wages()->validAt($date)->exists() ? money($employee->wages()->validAt($date)->first()->amount) : '-' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if ($loop->remaining)
                    <div class="page-break"></div>
                @endif
            @endforeach

            @if ($loop->remaining)
                <div class="page-break"></div>
            @endif

        @endforeach

@endsection

@section('footer')
    <p class="page">{{trans('admin.Seite')}}: <span class="pagenum"></span></p>
@endsection

