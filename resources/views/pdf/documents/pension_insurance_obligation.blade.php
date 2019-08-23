@extends('pdf.documents.layouts.default')

@section('header')
    <table style="margin-top: 30px;">
        <tr>
            <td style="vertical-align: bottom;">
                <strong>{{ $textblocks['signature.company_name'] }}</strong>, {{ $textblocks['signature.street'] }}
                , {{ $textblocks['signature.postal_code'] }} {{ $textblocks['signature.city'] }}
            </td>
            <td style="text-align: right;">
                <img src="{{ asset('assets/img/logo_big.jpg') }}" alt="" style="height:100px; width:auto; display:block; margin-bottom: 10px">
            </td>
        </tr>
    </table>

    <hr>
@stop

@section('content')
    <h3>Befreiung von der Rentenversicherungspflicht</h3>

    <p>Antrag auf Befreiung von der Rentenversicherungspflicht bei einer geringfügig entlohnten Beschäftigung nach §6 Absatz 1b Sozialgesetzbuch - Sechstes Buch - (SGB VI)</p>

    <p><strong>Arbeitnehmber</strong></p>
    <p>Name: {{ $employee->last_name }}</p>
    <p>Vorname: {{ $employee->first_name }}</p>
    <p>Rentenversicherungsnr.: {{ $employee->social_security_number }}</p>

    <p>
        Hiermit beantrage ich die Befreiung von der Versicherungspflicht in der Rentenversicherung im Rahmen meiner geringfügig ent -
        lohnten Beschäftigung und verzichte damit auf den Erwerb von Pflichtbeitragszeiten. Ich habe die Hinweise auf dem „Merkblatt
        über die möglichen Folgen einer Befreiung von der Rentenversicherungspflicht“ zur Kenntnis genommen.
        Mir ist bekannt, dass der Befreiungsantrag für alle von mir zeitgleich ausgeübten geringfügig entlohnten Beschäftigungen gilt und
        für die Dauer der Beschäftigungen bindend ist; eine Rücknahme ist nicht möglich. Ich verpflichte mich, alle weiteren Arbeitgeber,
        bei denen ich eine geringfügig entlohnte Beschäftigung ausübe, über diesen Befreiungsantrag zu informieren.
    </p>

    <table style="width:500px;">
        <tr>
            <td height="40px;vertical-align:bottom;">{{ $place .  ', ' . $date }}</td>
            <td>
                @if($employee->signature)
                    <img src="{{ asset('/uploads/images/signature/' . $employee->signature) }}" style="height: auto;width: 200px;">
                @endif
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top;">(Ort, Datum)</td>
            <td style="vertical-align: top;">(Unterschrift des Arbeitnehmers bzw. bei Minderjährigen Unterschrift des gesetzlichen Vertreters)</td>
        </tr>
    </table>

    <p><strong>Arbeitnehmber</strong></p>
    <p>Name: {{ $name }}</p>
    <p>Betriebsnummer: {{ $operation_number or '-' }}</p>
    <p>Der Befreiungsbetrag ist am {{ $date_of_receipt }} bei mir eingegangen.</p>
    <p>Die Befreiung wirkt ab dem {{ $date_of_taking_effect }}.</p>

    <table style="width: 340px;background: url('/assets/img/stamp.png') no-repeat right bottom;">
        <tr>
            <td height="100px;vertical-align:bottom;">{{ $place .  ', ' . $date }}</td>
            <td>
                <img src="{{ asset('assets/img/stamp.png') }}" alt="" style="height:100px; width:auto; display:block; margin-bottom: 10px">
            </td>
        </tr>
        <tr>
            <td>(Ort, Datum)</td>
            <td>(Unterschrift des Arbeitgebers)</td>
        </tr>
    </table>
@endsection

