@extends('admin.settings.textblocks.elements.partials.layout')

@section('panel')
    <div class="panel-heading">
        <h2>{{trans('admin.Textbausteine - Allgemein')}}</h2>
    </div>
    <div class="panel-body">
        <textblocks-signature :data="{{ $textblocks }}"></textblocks-signature>
    </div>
@endsection