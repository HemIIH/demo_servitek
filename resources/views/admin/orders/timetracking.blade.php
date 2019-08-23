@extends('admin.orders.partials.order_layout')

@section('tab')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>{{trans('admin.Zeiterfasssung')}}</h2>
            <table class="table">
                <tbody>
                <tr>
                    <td>{{trans('admin.Auftragsnr')}}</td>
                    <td>{{trans('admin.Kunde')}}</td>
                    <td>{{trans('admin.Beginn')}}</td>
                    <td>{{trans('admin.Ende')}}</td>
                    <td>{{trans('admin.Gesamt')}}</td>
                    <td>{{trans('admin.Lohn')}}</td>
                    <td>{{trans('admin.Kosten')}}</td>
                </tr>
                <tr>
                    <td><a href="{{ url('admin/order/' . $order->id . '/show') }}">{{ $order->id }}</a></td>
                    <td><a href="{{ url('admin/client/' . $order->client->id . '/show') }}">{{ $order->client->name }}</a></td>
                    <td>{{ Date::format($order->start_date) }}</td>
                    <td>{{ Date::format($order->end_date) }}</td>
                    <td>{{ Time::output($order->total_min, false) }}</td>
                    <td>{{ money($order->total_wage) }}</td>
                    <td>{{ money($order->total_cost) }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="panel-body">
            <form action="{{ url('admin/order/' . $order->id . '/timetracking') }}" method="POST">
                {!! csrf_field() !!}
                <table class="table">
                    <thead>
                    <tr>
                        <th>{{trans('admin.Datum')}}</th>
                        <th>{{trans('admin.Mitarbeiter')}}</th>
                        <th>{{trans('admin.Startzeit')}}</th>
                        <th>{{trans('admin.Endzeit')}}</th>
                        <th>{{trans('admin.Pause')}}</th>
                        <th class="text-right">{{trans('admin.Gesamtzeit')}}</th>
                        <th class="text-right">{{trans('admin.Lohn')}}</th>
                        <th class="text-right">{{trans('admin.Kosten')}}</th>
                    </tr>
                    </thead>

                    <tbody>

                    @if (count($timetrackings))

                        @foreach ($timetrackings as $tracking)
                            @php
                                $wage = $tracking->employee->wages()->validAt($tracking->date)->first();
                            @endphp

                            <tr>
                                <td>
                                    {{ Date::format($tracking->date) }}
                                </td>
                                <td>
                                    <a href="{{ url('admin/employee/' . $tracking->employee->id . '/show') }}">{{ $tracking->employee->last_name . ', ' . $tracking->employee->first_name }}</a>
                                </td>
                                <td>
                                    <div class="form-group {{ $errors->has('start_time.' . $tracking->date .'.'. $tracking->employee->id) ? 'has-error' : '' }}">
                                        <input class="form-control" name="start_time[{{ $tracking->date }}][{{ $tracking->employee->id }}]" style="width:90%; display:inline;"
                                               value="{{ old('start_time.' . $tracking->date .'.'. $tracking->employee->id, Date::format($tracking->start_time, 'time')) }}" placeholder="00:00">

                                        @if ($loop->first)
                                            <i class="fa fa-arrow-circle-down pointer margin-l-5" id="start_time"></i>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group {{ $errors->has('end_time.' . $tracking->date .'.'. $tracking->employee->id) ? 'has-error' : '' }}">
                                        <input class="form-control" name="end_time[{{ $tracking->date }}][{{ $tracking->employee->id }}]" style="width:90%; display:inline;"
                                               value="{{ old('end_time.' . $tracking->date .'.'. $tracking->employee->id, Date::format($tracking->end_time, 'time')) }}" placeholder="00:00">

                                        @if ($loop->first)
                                            <i class="fa fa-arrow-circle-down pointer margin-l-5" id="end_time"></i>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group {{ $errors->has('break.' . $tracking->date .'.'. $tracking->employee->id) ? 'has-error' : '' }}">
                                        <input class="form-control" name="break[{{ $tracking->date }}][{{ $tracking->employee->id }}]" style="width:90%; display:inline;"
                                               value="{{ old('break.' . $tracking->date .'.'. $tracking->employee->id, $tracking->break) }}" :placeholder="trans('admin.In Minuten')">

                                        @if ($loop->first)
                                            <i class="fa fa-arrow-circle-down pointer margin-l-5" id="break"></i>
                                        @endif
                                    </div>
                                </td>
                                <td width="120px" class="text-right">{{ Time::output($tracking->total_min, false) }}</td>
                                @if($wage)
                                    <td class="text-right" title="{{trans('admin.Stundenlohn')}}: {{ money($wage->amount) }}">{{ money(calculateCost($tracking->total_min, $wage->amount)) }}</td>
                                    <td class="text-right">{{ money(calculateCost($tracking->total_min, $wage->amount) * config('settings.staff_cost_factor')[$tracking->employee->occupation_type]) }}</td>
                                @else
                                    <td class="text-right"><i class="fa fa-warning text-danger" title="{{trans('admin.Bitte legen Sie einen Stundenlohn fest')}}"></i></td>
                                    <td class="text-right"><i class="fa fa-warning text-danger" title="{{trans('admin.Bitte legen Sie einen Stundenlohn fest')}}"></i></td>
                                @endif
                            </tr>
                        @endforeach
                        <tr class="text-right">
                            <td colspan="4"></td>
                            <td class="text-left"><strong>{{trans('admin.Gesamt')}}</strong></td>
                            <td>{{ Time::output($order->total_min, false) }}</td>
                            <td>{{ money($order->total_wage) }}
                            <td>{{ money($order->total_cost) }}
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="8">-</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

                @if($order->status == 'canceled')
                    <input type="submit" :value="{{trans('admin.Speichern')}}" class="btn btn-success pull-right" disabled :title="trans('admin.Auftrag ist storniert')">
                @elseif($order->end_date > now()->format('Y-m-d'))
                    <input type="submit" :value="{{trans('admin.Speichern')}}" class="btn btn-success pull-right" disabled :title="trans('admin.Auftrag liegt in der Zukunft')">
                @else
                    <input type="submit" :value="{{trans('admin.Speichern')}}" class="btn btn-success pull-right">
                @endif
            </form>
        </div>
        @if (count($orders = $order->children) || count($orders = $order->parent()->get()))
            <div class="panel-footer">
                <table class="table">
                    <tbody>

                    <tr>
                        <td colspan="7">
                            <h4>{{ count($order->children) ? trans('admin.Zugehörige Unteraufträge') : trans('admin.Hauptauftrag') }}</h4>
                        </td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td>{{trans('admin.Auftragsnr')}}</td>
                        <td></td>
                        <td>{{trans('admin.Beginn')}}</td>
                        <td>{{trans('admin.Ende')}}</td>
                        <td>{{trans('admin.Gesamt')}}</td>
                        <td>{{trans('admin.Lohn')}}</td>
                        <td>{{trans('admin.Kosten')}}</td>
                    </tr>
                    @foreach($orders as $order)
                        <tr>
                            <td>
                                <a href="{{ url('admin/order/' . $order->id . '/timetracking') }}">{{ $order->id }}</a>
                                @if($order->status == 'canceled')
                                    <span class="label label-warning margin-l-10">{{trans('admin.Storniert')}}</span>
                                @endif
                            </td>
                            <td></td>
                            <td>{{ Date::format($order->start_date) }}</td>
                            <td>{{ \Date::format($order->end_date) }}</td>
                            <td>{{ Time::output($order->total_min, false) }}</td>
                            <td>{{ money($order->total_cost) }}</td>
                            <td>{{ money($order->total_wage) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection



@section('scripts')
    <script>
        $(document).ready(() => {
            $('#start_time, #end_time, #break').on('click', function() {
                let name = ($(this).attr('id'));

                $("input[name*='" + name + "']").val($(this).siblings()[0].value);
            });
        });
    </script>
@endsection