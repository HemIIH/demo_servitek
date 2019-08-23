@extends('layouts.client')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="box box-primary" style="height: 480px;">
                <div class="box-header with-border">
                    <h3 class="pull-right box-title"><a href="{{ '/c/calendar' }}">Übersicht</a></h3>
                </div>
                <div class="box-body">
                    <dashboard-calendar></dashboard-calendar>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <order-graph group-by="week"></order-graph>
        </div>
        <div class="col-md-4">
            <div class="box box-primary" style="height: 400px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><a href="{{ '/c/invoices' }}">Letzte Rechnungen</a></h3>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Rechnungsdatum</th>
                            <th>Betrag</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($invoices))
                            @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ Date::format($invoice->invoice_date) }}</td>
                                <td>{{ money($invoice->sum) }}</td>
                                <td>
                                    @if($invoice->pay_date)
                                        <span class="label label-success">Bezahlt</span>
                                    @else
                                        <span class="label label-danger">Offen</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td rowspan="3">Keine Rechnungen vorhanden</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
