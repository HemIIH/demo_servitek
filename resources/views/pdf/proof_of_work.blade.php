@extends('pdf.layouts.master')

@section('styles')
    <style>
        @page {
            margin: 310px 50px 160px;
        }

        #header {
            position: fixed;
            left: 0;
            top: -310px;
            right: 0;
            height: 150px;
        }

        thead {
            border-bottom: 1px solid black;
        }

        tfoot {
            border-top: 1px solid black;
        }

        th, td {
            border: none;
            text-align: left;
        }

        .table th, .table tr td {
            border: none;
            vertical-align: top;
            padding: 6px 4px;
        }

        .table tfoot td {
            padding: 4px;
        }
    </style>
@endsection

@section('header')
    <div style="text-align:right;margin-top: 15px;">
        <img src="{{ asset('assets/img/logo_big.jpg') }}" alt="" style="height:100px; width:auto; display:block; margin-bottom: 10px">
    </div>
    <div>
        <strong>{{ $textblocks['signature.company_name'] }}</strong>, {{ $textblocks['signature.street'] }},
        {{ $textblocks['signature.postal_code'] }} {{ $textblocks['signature.city'] }}
    </div>
    <hr>
    <table>
        <tr>
            <td><h2>{{trans('admin.Rechnung')}}</h2></td>
            <td style="width: 240px;">&nbsp;</td>
        </tr>
        <tr>
            <td>
                <p>
                    {{ $invoice->name }}<br>
                    {{ $invoice->street }}<br>
                    {{ $invoice->postal_code . ' ' . $invoice->city }}
                </p>
            </td>
            <td>
                <table>
                    <tr>
                        <td><strong>{{trans('admin.Rechnungsnr')}}:</strong></td>
                        <td>RE{{ $invoice->id }}</td>
                    </tr>
                    <tr>
                        <td><strong>{{trans('admin.Kundennummer')}}:</strong></td>
                        <td>{{ $invoice->client_id }}</td>
                    </tr>
                    <tr>
                        <td><strong>{{trans('admin.Rechnungsdatum')}}:</strong></td>
                        <td>{{ Date::format($invoice->invoice_date) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection

@section('content')

    @foreach($timetrackings as $timetracking)

        <h3>{{ $timetracking->first()->order->title . ' am ' . Date::format($timetracking->first()->order->start_date) }}</h3>

        <table class="table">
            <thead>
            <tr>
                <th>{{trans('admin.Datum')}}</th>
                <th>{{trans('admin.Name')}}</th>
                <th>{{trans('admin.Start')}}</th>
                <th>{{trans('admin.Ende')}}</th>
                <th>{{trans('admin.Pause')}}</th>
                <th style="text-align: right;padding-right: 35px;">{{trans('admin.Gesamt')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($timetracking as $entry)
                <tr>
                    <td>{{ Date::format($entry->date, 'date') }}</td>
                    <td>{{ $entry->employee->last_name . ', ' . $entry->employee->first_name }}</td>
                    <td>{{ Date::format($entry->start_time, 'time') }} {{trans('admin.Uhr')}}</td>
                    <td>{{ Date::format($entry->end_time, 'time') }} {{trans('admin.Uhr')}}</td>
                    <td>{{ $entry->break }} Min</td>
                    <td style="text-align: right;padding-right: 35px;">{{ Time::output($entry->total_min, false) }}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="5"></td>
                <td style="text-align: right;padding-right: 35px;">{{ Time::output($timetracking->first()->order->total_min, false) }}</td>
            </tr>
            </tfoot>
        </table>

        @if ($loop->remaining)
            <div class="page-break"></div>
        @endif

    @endforeach

@endsection

