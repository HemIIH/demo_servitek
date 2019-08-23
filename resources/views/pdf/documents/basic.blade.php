@extends('pdf.documents.layouts.default')

@section('content')
    <h3>{{ $template->title }}</h3>

    @include('pdf.documents.partials.salutation')

    {!! $text !!}

    @include('pdf.documents.partials.signature')

@endsection