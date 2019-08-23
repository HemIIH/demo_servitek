@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <timetracking-table
                source="timetracking"
                :clients="{{ $clients }}"
                can-update="true"
                can-delete="true"
        >
        </timetracking-table>
    </div>
@endsection