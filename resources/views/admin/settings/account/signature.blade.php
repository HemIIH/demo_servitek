@extends('admin.settings.account.partials.account_layout')

@section('panel')
    <form action="{{ url('admin/settings/account/signature') }}" method="POST">
        {!! csrf_field() !!}
        <div class="row">
            <div class="col-md-10 form-group {{ $errors->has('signature') ? 'has-error' : '' }}">
                <label>{{trans('admin.Signatur')}}</label>
                <html-editor name="signature" model="{{ old('signature', $user->signature ?? $signature->value) }}" height="400"></html-editor>
                @if ($errors->has('signature'))
                    <span class="help-block">{{ $errors->first('signature') }}</span>
                @endif
            </div>
        </div>
        <input type="submit" value="{{trans('admin.Speichern')}}" class="btn btn-success btn-sm pull-right">
    </form>
@endsection