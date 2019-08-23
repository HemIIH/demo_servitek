@extends('pdf.layouts.master')

@section('styles')
    <style>
        @page {
            margin: 310px 50px 120px;
        }

        #header {
            top: -310px;
        }

        .table th, .table td {
            border: none;
        }

        #watermark {
            position: fixed;
            top: 50px;
            text-align: center;
            z-index: -100;
        }

        #watermark img {
            opacity: 0.05;
            width: 80%;
        }
    </style>
@endsection

@section('header')
    <div style="text-align:right;margin-top: 15px;">
        <img src="{{ asset('assets/img/logo_big.jpg') }}" alt="" style="height:100px; width:auto; display:block; margin-bottom: 10px">
    </div>
    <div>
        <strong>{{ $textblocks['signature.company_name'] }}</strong>, {{ $textblocks['signature.street'] }}
        , {{ $textblocks['signature.postal_code'] }} {{ $textblocks['signature.city'] }}
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
                    @if ($invoice->address_addition)
                        {{ $invoice->address_addition }}<br>
                    @endif
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
                        <td>{{ $client->id }}</td>
                    </tr>
                    <tr>
                        <td><strong>{{trans('admin.Rechnungsdatum')}}:</strong></td>
                        <td>{{ Date::format($invoice->invoice_date, 'date') }}</td>
                    </tr>
                    <tr>
                        <td><strong>{{trans('admin.Steuer-ID')}}:</strong></td>
                        <td>{{ $client->vat }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection

@section('content')

    <div id="watermark">
        <img src="{{ asset('assets/img/logo_big.png') }}">
    </div>

    <p>{!! $invoice->intro  !!}</p>

    @php
        $items = $invoice->items->sortBy('start_date');
    @endphp

    @if(count($items))

        @php
            count($items) > 10 ? $limit = 9 : $limit = 8;
            $sum = 0;
            $discounted = [0  => 0, 7  => 0, 19 => 0 ];
            $discount = [];
        @endphp

        @foreach($items->chunk($limit) as $chunk)
            <table class="table">
                <thead style="border-bottom: 1px solid black">
                <tr>
                    <th style="text-align: center;">{{trans('admin.Pos')}}.</th>
                    <th>{{trans('admin.Leistung')}}</th>
                    <th>{{trans('admin.USt')}}.</th>
                    <th>{{trans('admin.Menge')}}</th>
                    <th style="text-align: right;">{{trans('admin.Einzel')}}</th>
                    <th style="text-align: right;">{{trans('admin.Gesamt')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($chunk as $item)

                    <tr>
                        <td style="text-align: center;">{{ $loop->iteration + ($loop->parent->index * $limit) }}</td>
                        <td><strong>{{ $item->service }}</strong><br>
                            {{ Date::timespan($item->start_date, $item->end_date) }}
                        </td>
                        <td>{{ $item->tax_rate }} %</td>

                        @php
                            $total = $item->quantity * $item->price;
                        @endphp

                        <td>{{ str_replace('.', ',', $item->quantity) . ' ' . $item->unit }}</td>
                        <td style="text-align: right;">{{ money($item->price) }}</td>
                        <td style="text-align: right;">{{ money($total) }}</td>
                    </tr>

                    @php
                        $sum += $total;
                        $discounted[$item->tax_rate] += $total  * (1 - $item->discount/100);

                        if ($item->discount && isset($discount[$item->discount])) {
                            $discount[$item->discount] += $total * ($item->discount/100);
                        } else {
                            $discount[$item->discount] = $total * ($item->discount/100);
                        }
                    @endphp

                @endforeach

                @if ($loop->remaining)
                    <tr>
                        <td colspan="5"><strong>{{trans('admin.Zwischensumme')}}</strong></td>
                        <td style="text-align: right;">{{ money($sum) }}</td>
                    </tr>
                @endif

                </tbody>

            </table>

            @if ($loop->remaining)
                <div class="page-break"></div>
            @endif

        @endforeach

        <table>
            <tfoot>
            <tr>
                <td colspan="5" style="border-top: 2px solid black">{{trans('admin.Zwischensumme (netto)')}}</td>
                <td style="text-align: right;border-top: 2px solid black">{{ money($sum) }}</td>
            </tr>

            @foreach($discount as $percentage => $value)

                @continue($value == 0)

                <tr>
                    <td colspan="5">
                        Rabatt {{ $percentage . ' %' }} {{ '(auf ' . money($value/($percentage/100)) . ')' }}</td>
                    <td style="text-align: right;">{{ money($value) }}</td>
                </tr>
            @endforeach

            @if (array_sum($discount))
                <tr>
                    <td colspan="5" style="border-top: 1px solid black">{{trans('admin.Zwischensumme (netto)')}}</td>
                    <td style="text-align: right;border-top: 1px solid black">{{ money($sum - array_sum($discount)) }}</td>
                </tr>
            @endif

            @php
                $taxes = 0;
            @endphp

            @foreach($discounted as $tax => $value)

                @continue($value == 0)

                <tr>
                    <td colspan="5">
                        {{trans('admin.Umsatzsteuer')}} {{ $tax . ' %' }} {{ count(array_filter($discounted)) > 1 ? '(auf ' . money($value) . ')' : '' }}</td>
                    <td style="text-align: right;">{{ money($value * $tax/100) }}</td>
                </tr>

                @php
                    $taxes += $value * $tax/100;
                @endphp
            @endforeach

            <tr>
                <td colspan="5" style="border-top: 1px solid black"><strong>{{trans('admin.Gesamtbetrag')}}</strong></td>
                <td style="text-align: right;border-top: 1px solid black"><strong>{{ money(array_sum($discounted) + $taxes) }}</strong></td>
            </tr>
            </tfoot>
        </table>
    @endif

    <br>

    <p>{!! $invoice->outro  !!}</p>

    <table>
        <tr>
            <td>
                <p>{{trans('admin.Mit freundlichen Grüßen')}}</p>

                <p><strong>{{ $textblocks['signature.company_name'] }}</strong></p>
            </td>
            <td>
                <img src="{{ asset('assets/img/stamp.png') }}" alt="" style="height:150px; width:auto; display:block; margin-bottom: 10px">
            </td>
        </tr>
    </table>

@endsection

