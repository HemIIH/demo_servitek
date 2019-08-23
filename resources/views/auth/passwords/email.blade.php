@extends('layouts.auth')

@section('content')
    <p style="font-size:24px;font-weight:300; margin:25px 0 15px;">{{trans('auth.Passwort vergessen')}}</p>

    <div class="row" style="text-align: left;">
        <div class="col-md-12">
            <div class="panel" style="background: #e8e8e8;">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form" method="POST" action="{{ route('password.email') }}">
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

                        <div style="text-align: center;">
                            <div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block" style="background:#605ca8">
                                    {{trans('auth.E-Mail anfordern')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
