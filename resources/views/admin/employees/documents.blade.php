@extends('admin.employees.partials.layout')

@section('tab_content')

    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">{{trans('admin.Dokumente')}}</h4>
                </div>
                <div class="panel-body">
                    <document-list type="employee" :model="{{ $employee }}"></document-list>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <new-document-panel :employee="{{ $employee }}"></new-document-panel>

            <upload-document url="{{ '/api/employee/' . $employee->id . '/document/upload' }}"></upload-document>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
@endsection