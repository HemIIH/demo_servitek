@extends('layouts.auth')

@section('content')
    <div class="row" style="text-align: left;">
        <div class="col-md-12">
            <div class="panel" style="background: #e8e8e8;">
                <div class="panel-heading" style="background: #e8e8e8;"><h3>{{trans('auth.Passwort zurücksetzen')}}</h3></div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">

                                <label for="email" class="control-label">{{trans('auth.E-Mail')}}</label>

                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                <i class="fa fa-envelope-o form-control-feedback"></i>

                                @if ($errors->has('email'))
                                    <div class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">{{trans('auth.Passwort')}}</label>

                            <input id="password" type="password" class="form-control" name="password" required>
                            <i class="fa fa-lock form-control-feedback"></i>

                            @if ($errors->has('password'))
                                <div class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">{{trans('auth.Passwort bestätigen')}}</label>

                            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" name="password" required>
                            <i class="fa fa-lock form-control-feedback"></i>

                            @if ($errors->has('password'))
                                <div class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" style="background:#605ca8">
                                {{trans('auth.Zurücksetzen')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
