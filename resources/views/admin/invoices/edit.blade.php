@extends('layouts.admin')

@section('content')
    <div class="nav-tabs-custom">
                <div class="tab-content">

                    <div class="tab-pane active">
                        <div class="row">
                            <div class="col-md-10">
                                <form action="{{ url('admin/invoice/' . $invoice->id . '/update') }}" method="POST">
                                    {!! csrf_field() !!}

                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4>{{trans('admin.Kunde')}}: <a href="{{ url('admin/client/' . $client->id . '/show') }}">{{ $client->name }}</a></h4>
                                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                                    <input class="form-control input-sm" name="name" value="{{ old('name', $invoice->name) }}">
                                                </div>
                                                <div class="form-group {{ $errors->has('street') ? 'has-error' : '' }}">
                                                    <input class="form-control input-sm" name="street" value="{{ old('street', $invoice->street) }}" placeholder="{{trans('admin.Strasse')}}">
                                                </div>
                                                <div class="form-group {{ $errors->has('address_addition') ? 'has-error' : '' }}">
                                                    <input class="form-control input-sm" name="address_addition" value="{{ old('address_addition', $invoice->address_addition) }}" placeholder="{{trans('admin.Adresszusatz')}}">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group {{ $errors->has('postal_code') ? 'has-error' : '' }}">
                                                            <input class="form-control input-sm" name="postal_code" value="{{ old('postal_code', $invoice->postal_code) }}" placeholder="{{trans('admin.Postleitzahl')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                                            <input class="form-control input-sm" name="city" value="{{ old('city', $invoice->city) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                                                    <input class="form-control input-sm" name="country" value="{{ old('country', $invoice->country) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                @if (count($contacts))
                                                    <label for="contacts">{{trans('admin.Ansprechpartner')}}</label>
                                                    @foreach($contacts as $contact)
                                                        @continue(! $contact->accounting)
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="contacts[]" value="{{ $contact->id }}" {{ $invoice->contacts->contains($contact->id) ? 'checked="checked"' : '' }} > {{ $contact->last_name . ', ' . $contact->first_name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                <table class="table">
                                                    <tr>
                                                        <td><strong>{{trans('admin.Rechnungsnr')}}: </strong></td>
                                                        <td>RE{{ $invoice->id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>{{trans('admin.Kundennummer')}}: </strong></td>
                                                        <td>{{ $client->id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>{{trans('admin.Rechnungsdatum')}}: </strong></td>
                                                        <td>{{ Date::format($invoice->invoice_date) }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group {{ $errors->has('intro') ? 'has-error' : '' }}">
                                            <label for="intro">{{trans('admin.Einleitungstext')}}</label>
                                            <html-editor name="intro" model="{{ old('intro', $invoice->intro) }}" height="120"></html-editor>
                                        </div>
                                        <div class="col-md-6 form-group {{ $errors->has('outro') ? 'has-error' : '' }}">
                                            <label for="outro">{{trans('admin.Schlusstext')}}</label>
                                            <html-editor name="outro" model="{{ old('outro', $invoice->outro) }}" height="120"></html-editor>
                                        </div>
                                    </div>

                                    @php
                                        $items = $invoice->items->sortBy('start_date');
                                    @endphp

                                    @if($items)
                                        @php
                                            count($items) > 8 ? $limit = 7 : $limit = 5;

                                            $sum = 0;
                                            $discounted = [0  => 0, 7  => 0, 19 => 0];
                                            $discount = [];
                                        @endphp

                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="text-center">{{trans('admin.Pos')}}.</th>
                                                <th>{{trans('admin.Leistung')}}</th>
                                                <th>{{trans('admin.USt')}}.</th>
                                                <th>{{trans('admin.Rabatt')}}</th>
                                                <th>{{trans('admin.Menge')}}</th>
                                                <th class="text-right">{{trans('admin.Einzel')}}</th>
                                                <th class="text-right">{{trans('admin.Gesamt')}}</th>
                                                <th class="text-right"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($items as $item)

                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>
                                                        @if ($item->type == 'order')
                                                            <strong>{{ $item->service }}</strong><br>
                                                            {{ Date::timespan($item->start_date, $item->end_date) }}
                                                        @else
                                                            <div class="form-group {{ $errors->has('service.' . $item->id) ? 'has-error' : '' }}">
                                                                <input class="form-control input-sm" name="service[{{ $item->id }}]" value="{{ old('service.' . $item->id, $item->service) }}">
                                                            </div>

                                                            <div class="form-group {{ $errors->has('start_date.' . $item->id) ? 'has-error' : '' }}">
                                                                <datepicker name="{{ 'start_date[' . $item->id . ']'}}" value="{{ old('start_date.' . $item->id, Date::format($item->start_date)) }}"></datepicker>
                                                            </div>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control input-sm {{ $errors->has('tax_rate.' . $item->id) ? 'has-error' : '' }}" name="tax_rate[{{ $item->id }}]">
                                                                @foreach([19, 7, 0] as $rate)
                                                                    <option value="{{ $rate }}" {{ $item->tax_rate == $rate ? 'selected="selected"' : '' }}> {{ $rate }} %</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group {{ $errors->has('discount.' . $item->id) ? 'has-error' : '' }}">
                                                            <input class="form-control input-sm input-width-sm" name="discount[{{ $item->id }}]" value="{{ old('discount.' . $item->id, $item->discount) }}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if ($item->type == 'order')
                                                            {{ number_format($item->quantity, 2, ',', '.') }} {{trans("admin.Stunden")}}
                                                        @else
                                                        <div class="form-inline">
                                                            <div class="form-group {{ $errors->has('quantity.' . $item->id) ? 'has-error' : '' }}">
                                                                <input class="form-control input-sm input-width-sm" name="quantity[{{ $item->id }}]" value="{{ old('quantity.' . $item->id, str_replace('.', ',', $item->quantity)) }}">
                                                            </div>
                                                            <div class="form-group {{ $errors->has('unit.' . $item->id) ? 'has-error' : '' }}">
                                                                <input class="form-control input-sm" name="unit[{{ $item->id }}]" value="{{ old('unit.' . $item->id, $item->unit) }}">
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="form-group {{ $errors->has('price.' . $item->id) ? 'has-error' : '' }}">
                                                            <input class="form-control input-sm input-width-sm" name="price[{{ $item->id }}]" value="{{ old('price.' . $item->id, money($item->price, false)) }}">
                                                        </div>
                                                    </td>
                                                    <td class="text-right">{{ money($item->price * $item->quantity) }}</td>
                                                    <td class="text-right deleteLine">
                                                        <i class="fa fa-times pointer" data-id="{{ $item->id }}"></i>
                                                    </td>
                                                </tr>

                                                @php
                                                    $total = $item->price * $item->quantity;
                                                    $sum += $total;
                                                    $discounted[$item->tax_rate] += $total * (1 - $item->discount/100);

                                                    if ($item->discount && isset($discount[$item->discount])) {
                                                        $discount[$item->discount] += $total * ($item->discount/100);
                                                    } else {
                                                        $discount[$item->discount] = $total * ($item->discount/100);
                                                    }
                                                @endphp

                                            @endforeach
                                            </tbody>

                                            <tfoot>
                                            <tr>
                                                <td colspan="6" class="text-left" style="border-top: 2px solid black">
                                                    {{trans('admin.Zwischensumme (netto)')}}
                                                </td>
                                                <td class="text-right" style="border-top: 2px solid black">{{ money($sum) }}</td>
                                                <td style="border-top: 2px solid black"></td>
                                            </tr>
                                            @foreach($discount as $percentage => $value)
                                                @continue($value == 0)
                                                <tr>
                                                    <td colspan="6" class="text-left">
                                                        {{trans('admin.Rabatt')}} {{ $percentage . ' % auf ' . money($value/($percentage/100)) . ')' }}
                                                    </td>
                                                    <td class="text-right">{{ money($value) }}</td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                            @if (array_sum($discount))
                                                <tr>
                                                    <td colspan="6" class="text-left;" style="border-top: 1px solid black">
                                                        {{trans('admin.Zwischensumme (netto)')}}
                                                    </td>
                                                    <td class="text-right" style="border-top: 1px solid black">{{ money($sum - array_sum($discount)) }}</td>
                                                    <td style="border-top: 1px solid black"></td>
                                                </tr>
                                            @endif

                                            @php
                                                $taxes = 0
                                            @endphp

                                            @foreach($discounted as $tax => $value)
                                                @continue($value == 0)
                                                <tr>
                                                    <td colspan="6" class="text-left;">
                                                        {{trans('admin.Umsatzsteuer')}} {{ $tax . ' %' }} {{ count(array_filter($discounted)) > 1 ? '(auf ' . money($value) . ')' : '' }}</td>
                                                    <td class="text-right">{{ money($value * $tax/100) }}</td>
                                                    <td></td>
                                                </tr>

                                                @php
                                                    $taxes += $value * $tax/100;
                                                @endphp
                                            @endforeach
                                            <tr>
                                                <td colspan="6" class="text-left;" style="border-top: 1px solid black">
                                                    <strong>{{trans('admin.Gesamtbetrag')}}</strong></td>
                                                <td class="text-right" style="border-top: 1px solid black">
                                                    <strong>{{ money(array_sum($discounted) + $taxes) }}</strong>
                                                </td>
                                                <td style="border-top: 1px solid black"></td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    @endif
                                    <div>
                                        <a href="{{ url('admin/invoice/' . $invoice->id . '/new-item') }}" class="btn btn-success btn-sm pull-left">
                                            <i class="fa fa-plus"></i> {{trans('admin.Neu')}}
                                        </a>
                                        <input type="submit" value="{{trans('admin.Speichern')}}" class="btn btn-success btn-md pull-right">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@section('scripts')

    <script>
        $('.deleteLine i').click(function () {

            var element = $(this).data('id');

            swal({
                title: trans("admin.Rechnungsposten löschen?"),
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: trans("admin.Abbrechen!"),
                confirmButtonText: trans("admin.Löschen!")
            }).then(function () {
                axios.post('/api/invoice/' + {{ $invoice->id }} +'/item/' + element + '/delete').then(function (response) {
                    swal(trans('admin.Änderung gespeichert!'), '', 'success');

                    if (response.data == 'invoice_deleted') {
                        window.location = '{{ config('app.url')  }}' + '/invoice';
                    } else {
                        location.reload();
                    }

                });
            });
        });
    </script>

@endsection



