@extends('layouts.auth')

@section('content')
    <p style="font-size:24px;font-weight:300; margin:25px 0 15px;">{{trans('auth.Willkommen beim')}} <span style="color:#605ca8">{{trans('auth.DispoM@ster')}}</span></p>

    <div class="row" style="text-align: left;">
        <div class="col-md-12">
            <div class="panel" style="background: #e8e8e8;">
                <div class="panel-body">
                    <form class="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">

                            <label for="email" class="control-label">{{trans('auth.E-Mail')}}</label>

                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            <i class="fa fa-envelope-o form-control-feedback"></i>

                            @if ($errors->has('email'))
                                <div class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
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

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    {{trans('auth.Angemeldet bleiben')}}
                                </label>
                            </div>
                        </div>

                        <div style="text-align: center;">
                            <div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block" style="background:#605ca8">
                                    {{trans('auth.Anmelden')}}
                                </button>
                            </div>
                            <div>
                                <a class="btn btn-link" href="{{ url('/password/reset') }}" style="color:#605ca8">
                                    {{trans('auth.Passwort vergessen?')}}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
