@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>
                    {{trans('admin.Nutzerliste')}}

                    @if(Auth::user()->can('create', \App\Models\User\User::class))
                        <a class="btn btn-primary pull-right" href="{{ url('admin/settings/user/create') }}">{{trans('admin.Neuer Nutzer')}}</a>
                    @endif
                </h2>
            </div>
            <div class="panel-body">
                <user-table
                        source="user"
                        can-update="{{ Auth::user()->can('update', \App\Models\User\User::class) }}"
                        can-delete="{{ Auth::user()->can('delete', \App\Models\User\User::class) }}"
                >
                </user-table>
            </div>
        </div>
    </div>
@endsection