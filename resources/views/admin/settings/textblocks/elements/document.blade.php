@extends('admin.settings.textblocks.elements.partials.layout')

@section('panel')
    <div class="panel-heading">
        <h2>{{trans('admin.Textbausteine - Dokument')}}</h2>
    </div>
    <div class="panel-body">
        <textblocks-document :data="{{ $textblocks }}"></textblocks-document>
    </div>
@endsection