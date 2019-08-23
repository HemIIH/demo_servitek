@extends('layouts.client')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{ url('client/settings/account/credentials') }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-md-5 form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label>E-Mail</label>
                                <input class="form-control input-sm" name="email" value="{{ old('email', $user->email) }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label>Neues Passwort</label>
                                <input class="form-control input-sm" name="password" type="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="col-md-5 col-md-offset-1 form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                <label>Passwort bestätigen</label>
                                <input class="form-control input-sm" name="password_confirmation" type="password">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 form-group {{ $errors->has('current_password') ? 'has-error' : '' }}">
                                <label>Aktuelles Passwort</label>
                                <input class="form-control input-sm" name="current_password" type="password">
                                @if ($errors->has('current_password'))
                                    <span class="help-block">{{ $errors->first('current_password') }}</span>
                                @endif
                            </div>
                        </div>

                        <input type="submit" value="{{trans('admin.Speichern')}}" class="btn btn-success pull-right">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
