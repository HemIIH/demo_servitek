@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>{{trans('admin.Mitarbeiter Kalender')}}</h2>
        </div>
        <div class="panel-body">
            <form class="form-inline" action="{{ url('admin/calendar/employees/') }}" method="GET">
                <date-selection start="{{ $start->format('d.m.Y') }}" end="{{ $end->format('d.m.Y') }}" week="{{ request('week') }}"></date-selection>
            </form>

            <br>

            <form action="{{ url('admin/operation-plan/send') }}" method="POST">
                {{ csrf_field() }}

                <input type="hidden" name="start" value="{{ $start->format('Y-m-d') }}">
                <input type="hidden" name="end" value="{{ $end->format('Y-m-d') }}">
                <input type="hidden" name="week" value="{{ request('week') ? carbon(request('week'))->format('W') : null }}">

                <table class="table scrollable">
                    <thead>
                    <tr>
                        <th>
                            <input id="activateAll" type="checkbox">
                        </th>
                        <th style="width: 150px;">{{trans('admin.Name')}}</th>
                        @foreach($dates as $date => $weekday)
                            <th colspan="12">
                                {{ trans('admin.'.$weekday) . ', ' . Date::format($date, 'date') }}
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $employee)
                        <tr height="70px">

                            <td>
                                <input type="checkbox" name="employees[]" value="{{ $employee->id }}">
                            </td>
                            <td>
                                <a href="{{ url('admin/employee/' . $employee->id . '/show') }}">{{ $employee->last_name . ', ' . $employee->first_name }}</a>
                            </td>

                            @foreach($dates as $date => $weekday)

                                @php
                                    $orders = $employee->orders->sortBy('start_date')->where('start_date', '<=', $date)->where('end_date', '>=', $date);
                                    $count = count($orders)
                                @endphp

                                @if ($count > 4)
                                    <td colspan="12" style="width:70px">
                                        <div class="text-center">
                                            <i title="{{trans('admin.Mitarbeiter ist in mehr als 4 Aufträgen eingeplant')}}" class="fa fa-exclamation-triangle fa-lg text-danger"></i>
                                        </div>
                                    </td>
                                @elseif ($count >= 1)
                                    @for($i = 1; $i <= $count; $i++)
                                        @php
                                            $order = $orders->shift();
                                        @endphp

                                        <td colspan="{{ 12/$count }}" class="{{ getOrderStatus($order) }}" title="{{ $order->title }}" style="position:relative;width:70px;">
                                            @include('admin.calendar.partials.order')
                                        </td>
                                    @endfor
                                @else
                                    <td colspan="12" style="width:70px">
                                        <div></div>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <input type="submit" value="{{trans('admin.Einsatzpläne senden')}}" class="btn btn-primary btn-md pull-right">
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(() => {
            $('#activateAll').on('change', function() {
                $('input:checkbox').prop('checked', this.checked)
            });
        });
    </script>
@endsection
