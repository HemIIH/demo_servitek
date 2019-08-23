@extends('pdf.layouts.master')

@section('styles')
    <style>
        @page {
            margin: 350px 50px 125px;
        }

        #footer {
            bottom: -125px;
            height: 125px;
        }

        table > tfoot > tr > td {
            border-top: 3px solid black;
        }
    </style>
@endsection

@section('header')
    <div style="text-align: center;margin-top: 30px;">
        <img src="{{ asset('assets/img/logo_big.jpg') }}" alt="" style="height:80px; width:auto; display:block; margin-bottom: 10px">
    </div>
    <hr>
    <h2>{{trans('admin.Stundennachweis')}}</h2>

    <table>
        <tr>
            <td width="100px"><strong>{{trans('admin.Mitarbeiter')}}:</strong></td>
            <td>{{ $employee->last_name . ', ' . $employee->first_name }}</td>
            <td width="120px"></td>
            <td width="100px"><strong>{{trans('admin.Geburtsdatum')}}:</strong></td>
            <td>{{ $employee->date_of_birth }}</td>
        </tr>
        <tr>
            <td></td>
            <td>{{ $employee->street }}</td>
            <td></td>
            <td><strong>{{trans('admin.Steuer-ID')}}:</strong></td>
            <td>{{ $employee->tax_id }}</td>
        </tr>
        <tr>
            <td></td>
            <td>{{ $employee->postal_code . ' ' . $employee->city }}</td>
            <td></td>
            <td><strong>{{trans('admin.SV-Nr')}}.</strong></td>
            <td>{{ $employee->social_security_number }}</td>
        </tr>
    </table>

    <br>

    <p><strong>{{trans('admin.Zeitraum')}}:</strong> {{ Date::monthYear($date->format('d.m.Y')) }}</p>

@endsection

@section('content')

    <div id="content">

        @if($timetrackings->count())
            <h3>{{trans('admin.Aufträge')}}</h3>
            <table class="table print-friendly">
                <thead>
                <tr>
                    <th>{{trans('admin.Auftrag')}}</th>
                    <th>{{trans('admin.Kunde')}}</th>
                    <th>{{trans('admin.Datum')}}</th>
                    <th width="70px">{{trans('admin.Start')}}</th>
                    <th width="70px">{{trans('admin.Ende')}}</th>
                    <th width="60px">{{trans('admin.Pause')}}</th>
                    <th width="60px">{{trans('admin.Gesamt')}}</th>
                    <th>{{trans('admin.Stundenlohn')}}</th>
                    <th width="70px">{{trans('admin.Lohn')}}</th>
                </tr>
                </thead>
                <tbody>

                @php
                    $sum = 0;
                    $totalMin = 0;
                @endphp

                @foreach($timetrackings as $timetracking)

                    @php
                        $wage= $employee->wages()->validAt($timetracking->date)->first()->amount;
                        $cost = calculateCost($timetracking->total_min, $wage);
                    @endphp

                    <tr>
                        <td>{{ $timetracking->order->id }}</td>
                        <td>{{ $timetracking->order->client->name }}</td>
                        <td>{{ Date::format($timetracking->date) }}</td>
                        <td>{{ Date::format($timetracking->start_time, 'time') }} {{trans('admin.Uhr')}}</td>
                        <td>{{ Date::format($timetracking->end_time, 'time') }} {{trans('admin.Uhr')}}</td>
                        <td>{{ $timetracking->break }} Min.</td>
                        <td>{{ Time::output($timetracking->total_min, false) }}</td>
                        <td class="text-right">{{ money($wage) }}</td>
                        <td class="text-right">
                            {{ $timetracking->total_min != null ? money($cost) : '-' }}
                        </td>
                    </tr>

                    @php
                        $sum += $cost;
                        $totalMin += $timetracking->total_min;
                    @endphp
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6"></td>
                    <td>{{ Time::output($totalMin, false) }}</td>
                    <td></td>
                    <td class="text-right">{{ money($sum) }}</td>
                </tr>
                </tfoot>
            </table>
        @else
            <p>{{trans('admin.Keine zeiterfassten Aufträge in diesem Monat')}}</p>
        @endif

        <br>

        @if(count($payroll_modifications))
            <h3>{{trans('admin.Lohn- und Gehaltsabrechnung')}}</h3>
            <table class="table">
                <thead>
                <tr>
                    <th>{{trans('admin.Art')}}</th>
                    <th>{{trans('admin.Kosten')}}</th>
                    <th>{{trans('admin.Informationen')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payroll_modifications as $entry)
                    <tr>
                        <td>{{ config('settings.payroll_relevant_factors')[$entry->type]['name'] }}</td>
                        <td class="text-right">{{ money($entry->amount) }}</td>
                        <td>{{ $entry->information }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td><strong>{{trans('admin.Summe')}}</strong></td>
                    <td class="text-right"><strong>{{ money($payroll_modifications->sum('amount'))  }}</strong></td>
                    <td></td>
                </tr>
                </tfoot>
            </table>

            <br>
        @endif


        @if(count($extra_business))
            <h3>{{trans('admin.Zusätzliche Tätigkeiten')}}</h3>
            <table class="table print-friendly">
                <thead>
                <tr>
                    <th>{{trans('admin.Typ')}}</th>
                    <th>{{trans('admin.Stundenzahl')}}</th>
                    <th>{{trans('admin.Information')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($extra_business as $entry)
                    <tr>
                        <td>{{ config('settings.extra_business')[$entry->type]['business'] }}</td>
                        <td>{{ Time::output($entry->total_min) }}</td>
                        <td>{{ $entry->information }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <br>
        @endif

        @if(count($timeoff))
            <h3>{{trans('admin.Fehltage')}}</h3>
            <table class="table">
                <thead>
                <tr>
                    <th>{{trans('admin.Datum')}}</th>
                    <th>{{trans('admin.Typ')}}</th>
                    <th>{{trans('admin.Information')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($timeoff as $entry)
                    <tr>
                        <td>{{ Date::timespan($entry['start'], $entry['end']) }}</td>
                        <td>{{ $entry['type'] }}</td>
                        <td>{{ $entry['information'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

@endsection