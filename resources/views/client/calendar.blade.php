@extends('layouts.client')

@section('content')

    <div class="row">
        <div class="col-md-10">
            <client-calendar
                    :client="{{ $client }}"
            >
            </client-calendar>
        </div>
    </div>

@endsection


