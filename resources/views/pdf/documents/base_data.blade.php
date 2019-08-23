@extends('pdf.documents.layouts.default')

@section('styles')
    <style>
        @page {
            margin: 150px 50px 225px;
        }

        #footer {
            bottom: -225px;
            height: 225px;
        }

    </style>
@endsection

@section('content')
    <h2>{{trans('admin.Stammdaten')}}</h2>

    <table>
        <tr>
            <td colspan="3">
                {{ $employee->first_name . ' ' . $employee->last_name }}<br>
                * {{ $employee->date_of_birth }} in {{ $employee->place_of_birth }}<br><br>
                {{ $employee->street }}<br>
                {{ $employee->postal_code . ' ' . $employee->city }}<br>
                {{ $employee->country }}<br>
            </td>

            <td colspan="1">
                @if($employee->photo)
                    <img style="height: 150px; width: auto;" src="{{ asset('/uploads/images/photos/employees/' . $employee->photo ) }}" alt="">
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="4" height="25px"></td>
        </tr>
        <tr>
            <td class="emphasize">{{trans('admin.Staatsangehörigkeit')}}:</td>
            <td>{{ $employee->nationality }}</td>
            <td class="emphasize">{{trans('admin.Schulbildung')}}:</td>
            <td>{{ $employee->education }}</td>
        </tr>
        <tr>
            <td class="emphasize">{{trans('admin.Geschlecht')}}:</td>
            <td>{{ $employee->sex == 'm' ? trans('admin.männlich') : trans('admin.weiblich') }}</td>
            <td class="emphasize">{{trans('admin.Konfession')}}:</td>
            <td>{{ $employee->religion }}</td>
        </tr>
        <tr>
            <td class="emphasize">{{trans('admin.Familienstand')}}:</td>
            <td>{{ $employee->married ? trans('admin.verheiratet') : trans('admin.ledig') }}</td>
            <td class="emphasize">{{trans('admin.Kinder')}}:</td>
            <td>{{ $employee->children }}</td>
        </tr>
        <tr>
            <td class="emphasize">{{trans('admin.Behinderung')}}:</td>
            <td>{{ $employee->disability or 'Keine' }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="4" height="25px"></td>
        </tr>
        <tr>
            <td class="emphasize">{{trans('admin.Steuer-ID')}}:</td>
            <td>{{ $employee->tax_id }}</td>
            <td class="emphasize">{{trans('admin.Steuerklasse')}}:</td>
            <td>{{ $employee->tax_class }}</td>
        </tr>
        <tr>
            <td class="emphasize">{{trans('admin.Art der Krankenversicherung')}}:</td>
            <td>{{ $employee->type_of_health_insurance == 'statutory' ? trans('admin.Gesetzlich') : trans('admin.Privat') }}</td>
            <td class="emphasize">{{trans('admin.Krankenkasse')}}:</td>
            <td>{{ $employee->health_insurance }}</td>
        </tr>
        <tr>
            <td class="emphasize">{{trans('admin.Sozialversicherungsnr')}}:</td>
            <td>{{ $employee->social_security_number }}</td>
            <td class="emphasize">KV-Nr.:</td>
            <td></td>
        </tr>

        {{--<tr>--}}
        {{--<td colspan="4">--}}
        {{--<h3>Weitere Beschäftigung</h3>--}}
        {{--</td>--}}
        {{--</tr>--}}
        {{--@if($employee->furtherOccupation()->exists())--}}
        {{--<tr>--}}
        {{--<td class="emphasize">Monatl. Bruttolohn:</td>--}}
        {{--<td>{{ $employee->furtherOccupation->monthly_wage }}</td>--}}
        {{--<td class="emphasize">Beschäftigt seit:</td>--}}
        {{--<td>{{ $employee->furtherOccupation->employed_since }}</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
        {{--<td class="emphasize">Tätigkeit als:</td>--}}
        {{--<td>{{ $employee->furtherOccupation->occupation }}</td>--}}
        {{--<td class="emphasize">Arbeitgeber:</td>--}}
        {{--<td>{{ $employee->furtherOccupation->employer }}</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
        {{--<td class="emphasize">Monatl. Arbeitszeit:</td>--}}
        {{--<td>{{ $employee->furtherOccupation->monthly_working_time }}</td>--}}
        {{--<td></td>--}}
        {{--<td></td>--}}
        {{--</tr>--}}
        {{--@else--}}
        {{--<tr>--}}
        {{--<td colspan="4">Keine weitere Beschäftigung</td>--}}
        {{--</tr>--}}
        {{--@endif--}}
        <tr>
            <td colspan="4" height="25px"></td>
        </tr>
        <tr>
            <td colspan="4">
                <h3>{{trans('admin.Bankverbindung des Arbeitnehmers')}}</h3>
            </td>
        </tr>
        <tr>
            <td class="emphasize">{{trans('admin.Kontoinhaber')}}:</td>
            <td>{{ $employee->first_name . ' ' . $employee->last_name }}</td>
            <td class="emphasize">{{trans('admin.Institut')}}:</td>
            <td>{{ $employee->institute }}</td>
        </tr>
        <tr>
            <td class="emphasize">{{trans('admin.IBAN')}}:</td>
            <td>{{ $employee->iban }}</td>
            <td class="emphasize">{{trans('admin.BIC')}}:</td>
            <td>{{ $employee->bic }}</td>
        </tr>
    </table>

@endsection

@section('footer')
    <div style="font-size: 13px;">
        <table>
            <tr>
                <td width="400px">
                    <table>
                        <tr>
                            <td colspan="2"><h4>{{trans('admin.Bitte folgende Unterlagen beifügen')}}</h4></td>
                        </tr>
                        <tr>
                            <td>- {{trans('admin.ein Foto')}}</td>
                            <td>- {{trans('admin.Kopie der Arbeitserlaubnis')}}</td>
                        </tr>
                        <tr>
                            <td>-{{trans('admin. Kopie EC-Karte')}}</td>
                            <td>- {{trans('admin.Kopie Sozialversicherungsbescheid')}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">- {{trans('admin.Bescheinigung über die Mitgliedschaft in einer Krankenkasse')}}</td>
                        </tr>
                    </table>

                </td>
                <td class="emphasize">
                    {{trans('admin.Unterschrift')}}: <br>
                    @if ($employee->signature)
                        <img src="{{ asset('/uploads/images/signature/' . $employee->signature) }}" style="height: auto;width: 200px;">
                    @endif
                </td>
            </tr>
        </table>
    </div>

    @parent
@endsection