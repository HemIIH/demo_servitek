@extends('admin.settings.account.partials.account_layout')

@section('panel')
    <form action="{{ url('admin/settings/account/address') }}" method="POST">
        {!! csrf_field() !!}
        <div class="row">
            <div class="col-md-6 form-group {{ $errors->has('street') ? 'has-error' : '' }}">
                <label>{{trans('admin.Strasse')}}</label>
                <input class="form-control input-sm" name="street" value="{{ $user->street ? $user->street : $address['street'] }}" required>
                @if ($errors->has('street'))
                    <span class="help-block">{{ $errors->first('street') }}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 form-group {{ $errors->has('postal_code') ? 'has-error' : '' }}">
                <label>{{trans('admin.Postleitzahl')}}</label>
                <input class="form-control input-sm" name="postal_code" value="{{ $user->postal_code ? $user->postal_code : $address['postal_code'] }}" required>
                @if ($errors->has('postal_code'))
                    <span class="help-block">{{ $errors->first('postal_code') }}</span>
                @endif
            </div>
            <div class="col-md-4 form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                <label>{{trans('admin.Stadt')}}</label>
                <input class="form-control input-sm" name="city" value="{{ $user->city ? $user->city : $address['city'] }}" required>
                @if ($errors->has('city'))
                    <span class="help-block">{{ $errors->first('city') }}</span>
                @endif
            </div>
        </div>

        <input type="submit" value="{{trans('admin.Speichern')}}" class="btn btn-success btn-sm pull-right">
    </form>
@endsection