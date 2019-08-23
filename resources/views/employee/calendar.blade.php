@extends('layouts.employee')

@section('content')

    <div class="row">
        <div class="col-md-10">
            <calendar-by-month
                    :employee="{{ $employee }}"
            >
            </calendar-by-month>
        </div>
    </div>

@endsection


