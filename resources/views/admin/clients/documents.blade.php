@extends('admin.clients.partials.layout')

@section('tab')

    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">{{trans('admin.Dokumente')}}</h4>
                </div>
                <div class="panel-body">
                    <document-list type="client" :model="{{ $client }}"></document-list>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <upload-document url="{{ '/api/client/' . $client->id . '/document/upload' }}"></upload-document>
        </div>
    </div>

@endsection
