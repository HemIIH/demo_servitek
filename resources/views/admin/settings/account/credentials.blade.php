@extends('admin.settings.account.partials.account_layout')

@section('panel')
    <form action="{{ url('admin/settings/account/credentials') }}" method="POST">
        {!! csrf_field() !!}
        <div class="row">
            <div class="col-md-5 form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label>{{trans('admin.E-Mail')}}</label>
                <input class="form-control input-sm" name="email" value="{{ old('email', $user->email) }}">
                @if ($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
            </div>
            @if($user->hasRole('master_admin'))
                <div class="col-md-5 col-md-offset-1 form-group {{ $errors->has('cc_email') ? 'has-error' : '' }}">
                    <label>{{trans('admin.E-Mail (Back-up)')}}</label>
                    <input class="form-control input-sm" name="cc_email" value="{{ $user->cc_email }}">
                    @if ($errors->has('cc_email'))
                        <span class="help-block">{{ $errors->first('cc_email') }}</span>
                    @endif
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-5 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label>{{trans('admin.Benutzername')}}</label>
                <input class="form-control input-sm" name="name" value="{{ $user->name }}">
                @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label>{{trans('admin.Neues Passwort')}}</label>
                <input class="form-control input-sm" name="password" type="password">
                @if ($errors->has('password'))
                    <span class="help-block">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="col-md-5 col-md-offset-1 form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                <label>{{trans('admin.Passwort bestätigen')}}</label>
                <input class="form-control input-sm" name="password_confirmation" type="password">
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 form-group {{ $errors->has('current_password') ? 'has-error' : '' }}">
                <label>{{trans('admin.Aktuelles Passwort')}}</label>
                <input class="form-control input-sm" name="current_password" type="password">
                @if ($errors->has('current_password'))
                    <span class="help-block">{{ $errors->first('current_password') }}</span>
                @endif
            </div>
        </div>

        @if (auth()->user()->hasRole('dispomanager') || auth()->user()->hasRole('local_manager'))
            <div class="row">
                <div class="col-md-5 form-group {{ $errors->has('old_password ') ? 'has-error' : '' }}">
                    <label>{{trans('admin.Zugewiesene Standorte')}}</label>
                    <input class="form-control input-sm" name="locations" disabled="disabled" value="{{ implode(', ', $user->locations) }}">
                </div>
            </div>
        @endif
        <input type="submit" value="{{trans('admin.Speichern')}}" class="btn btn-success pull-right">
    </form>
@endsection