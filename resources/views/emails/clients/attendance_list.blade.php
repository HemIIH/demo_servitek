@extends('emails.partials.layout')

@section('content')

    <h2>{{trans('admin.Stundenzettel')}}</h2>

    <p>{!! $body !!}</p>

@endsection