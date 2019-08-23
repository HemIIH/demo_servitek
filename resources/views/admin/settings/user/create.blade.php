@extends('layouts.admin')

@section('content')
    <div class="nav-tabs-custom">
        <div class="tab-content">
            <div class="tab-pane active">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>{{trans('admin.Neuer Nutzer')}}</h3>
                            </div>
                            <div class="panel-body">
                                <form action="{{ url('admin/settings/user/store') }}" method="POST">
                                    {!! csrf_field() !!}
                                    <div class="row">
                                        <div class="col-md-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label>{{trans('admin.Name')}}</label>
                                            <input class="form-control input-sm" name="name" value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                            <label>{{trans('admin.E-Mail')}}</label>
                                            <input class="form-control input-sm" name="email" value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                                <span class="help-block">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-5 col-md-offset-1 form-group {{ $errors->has('cc_email') ? 'has-error' : '' }}">
                                            <label>{{trans('admin.E-Mail (CC)')}}</label>
                                            <input class="form-control input-sm" name="cc_email" value="{{ old('cc_email') }}">
                                            @if ($errors->has('email'))
                                                <span class="help-block">{{ $errors->first('cc_email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 form-group {{ $errors->has('role') ? 'has-error' : '' }}">
                                            <label>{{trans('admin.Rolle')}}</label>
                                            <select name="role" class="form-control input-sm">
                                                <option value="">{{trans('admin.Auswählen')}}</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">{{ trans('admin.'.$role->display_name)}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('role'))
                                                <span class="help-block">{{ $errors->first('role') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-md-6 col-md-offset-1">
                                            <label>{{trans('admin.Standort')}}</label>
                                            @foreach(config('settings.locations') as $location)
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="locations[]" value="{{ $location }}">{{ trans('admin.'.$location) }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <input type="submit" value="{{trans('admin.Anlegen')}}" class="btn btn-success btn-sm pull-right">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection