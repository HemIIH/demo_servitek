@extends('admin.settings.misc.salaries.partials.layout')

@section('panel')
    <div class="panel-heading">
        <h3>{{trans('admin.§2 Entgelte')}}</h3>
    </div>
    <div class="panel-body">
        <salary-table :regions="{{ $regions }}" :dates="{{ $dates }}"></salary-table>
    </div>
@endsection