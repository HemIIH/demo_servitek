@extends('pdf.documents.layouts.default')

@section('content')
    {!! $text !!}

    <table>
        <tr>
            <td>
                {{ request('place') }}, {{ request('date') }}
            </td>
            <td>
                <img src="{{ asset('assets/img/stamp.png') }}" alt="" style="height:100px; width:auto; display:block; margin-bottom: 10px">
            </td>
            <td>
                {{ request('place') }}, {{ request('date') }}
            </td>
            <td>
                @if($employee->signature)
                    <img src="{{ asset('/uploads/images/signature/' . $employee->signature) }}" style="height: auto;width: 170px;">
                @endif
            </td>
        </tr>
        <tr style="font-style: italic;vertical-align: bottom;">
            <td style="height:60px;">{{trans('admin.Ort')}}, {{trans('admin.Datum')}}</td>
            <td>{{trans('admin.Unterschrift Arbeitgeber')}}</td>
            <td style="height:60px;">{{trans('admin.Ort')}}, {{trans('admin.Datum')}}</td>
            <td>{{trans('admin.Unterschrift Mitarbeiter')}}</td>
        </tr>
    </table>
@endsection