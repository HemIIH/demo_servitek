@extends('emails.partials.layout')

@section('content')
<div style="margin: 10px auto; width: 600px; font-size: 16px;">

    <p>{{ $employee->sex == 'm' ? 'Lieber' : 'Liebe'}} {{ $employee->first_name }},</p>

    <p>hier deine aktuelle Einsatzplanung.</p>

    <p>Änderungen vorbehalten!</p>

    <p>
        <u>Teilzeiter:</u> bitte bestätige den Erhalt!<br>
        <u>Aushilfe:</u> bitte unbedingt annehmen oder absagen!
    </p>

    <p>Wird ein bereits bestätigter Auftrag innerhalb von 4 Tagen vor Beginn des Einsatzes durch den Mitarbeiter
        abgesagt, kann Schadenersatz/Vertragsstrafe fällig werden!</p>

    <p><strong>Bitte noch bestätigen!</strong></p>

    @foreach($orders as $order)

        <table>
            @if ($order->status == 'canceled')
                <tr>
                    <td height="30px" colspan="2">{{ \Date::weekday($order->start_date) . ', '. \Date::timespan($order->start_date, $order->end_date) }}
                        - <span style='color:red;font-weight: bold;'>Auftrag storniert</span></td>
                </tr>
                <tr>
                    <td width="150px"><strong>{{trans('employee.Firma')}}:</strong></td>
                    <td>{{ $order->client->name }}</td>
                </tr>
                <tr>
                    <td><strong>{{trans('employee.Einsatzort')}}:</strong></td>
                    <td>{{ $order->work_location }}</td>
                </tr>
                <tr>
                    <td><strong>{{trans('employee.Einsatzbeginn')}}:</strong></td>
                    <td>{{ Date::format($order->start_time, 'time') }} Uhr</td>
                </tr>
            @else
                <tr>
                    <td height="30px" colspan="2">{{ \Date::weekday($order->start_date) . ', '.  \Date::timespan($order->start_date, $order->end_date) }}
                        -
                        @if($order->pivot->approved_by_employee)
                            <span style="color:green;">Angenommen</span>
                        @elseif($order->pivot->rejected_by_employee)
                            <span style="color:red;">Abgesagt/Abgelehnt</span>
                        @else
                            <span style="color:blue;">Noch nicht angenommen</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td width="150px"><strong>{{trans('employee.Firma')}}:</strong></td>
                    <td>{{ $order->client->name }}</td>
                </tr>
                <tr>
                    <td><strong>Einsatzort:</strong></td>
                    <td {{ str_contains($order->important_change, 'work_location') ? 'style=color:red;' : '' }}>{{ $order->work_location }}</td>
                </tr>
                <tr>
                    <td><strong>Einsatzbeginn:</strong></td>
                    <td {{ str_contains($order->important_change, 'start_time') ? 'style=color:red;' : '' }}>{{ Date::format($order->start_time, 'time') }}
                        Uhr
                    </td>
                </tr>
                <tr>
                    <td><strong>Einsatzinfos:</strong></td>
                    <td {{ str_contains($order->important_change, 'requirements') ? 'style=color:red;' : '' }}>{{ $order->requirements }}</td>
                </tr>
                <tr>
                    <td><strong>Treffpunkt:</strong></td>
                    <td {{ str_contains($order->important_change, 'meeting') ? 'style=color:red;' : '' }}>{{ Date::format($order->pivot->meeting_time, 'time') }}
                        Uhr, {{ $order->pivot->meeting_point}}</td>
                </tr>
            @endif
        </table>

        @continue($loop->last)

        <hr>
    @endforeach

    {!! $textblocks['operation_plan.disclaimer'] !!}

</div>
@stop