@extends('admin.settings.textblocks.elements.partials.layout')

@section('panel')
    <div class="panel-heading">
        <h2>{{trans('admin.Textbausteine - Einsatzplan')}}</h2>
    </div>
    <div class="panel-body">
        <textblocks-operation-plan :data="{{ $textblocks }}"></textblocks-operation-plan>
    </div>
@endsection
