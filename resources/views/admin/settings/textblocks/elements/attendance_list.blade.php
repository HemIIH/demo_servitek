@extends('admin.settings.textblocks.elements.partials.layout')

@section('panel')
    <div class="panel-heading">
        <h2>{{trans('admin.Textbausteine - Stundenzettel')}}</h2>
    </div>
    <div class="panel-body">
        <textblocks-attendance-list :data="{{ $textblocks }}"></textblocks-attendance-list>
    </div>
@endsection
