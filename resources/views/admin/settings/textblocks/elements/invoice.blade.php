@extends('admin.settings.textblocks.elements.partials.layout')

@section('panel')
    <div class="panel-heading">
        <h2>{{trans('admin.Textbausteine - Rechnung')}}</h2>
    </div>
    <div class="panel-body">
        <textblocks-invoice :data="{{ $textblocks }}"></textblocks-invoice>
    </div>
@endsection

