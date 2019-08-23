@extends('layouts.admin')

@section('content')
    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>{{trans('admin.Nutzer bearbeiten')}}</h2>
            </div>
            <div class="panel-body">
                <form-wrapper action="{{ url('admin/settings/user/' . $user->id . '/update') }}">
                    <template slot-scope="form">

                        <div class="row">
                            <div class="col-md-7 col-md-offset-5 small text-right">
                                <div>
                                    <label>{{trans('admin.Angelegt am')}}</label>
                                    {{ Date::format($user->created_at, 'date_time') . trans('admin.Uhr').' - ' . $user->user->name }}
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" :class="{'has-error': form.errors.name }">
                                    <label>{{trans('admin.Name')}}</label>
                                    <input class="form-control input-sm" name="name" value="{{ $user->name }}">
                                    <span v-if="form.errors.username" class="help-block">@{{ form.errors.name }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-md-offset-1">
                                <label>{{trans('admin.Status')}}</label>
                                <br>
                                <label class="radio-inline">
                                    <input type="radio" name="active" value="1" {{ $user->active ? 'checked' : ''}}> {{trans('admin.Aktiv')}}
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="active" value="0" {{ ! $user->active ? 'checked' : ''}}> {{trans('admin.Inaktiv')}}
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" :class="{'has-error': form.errors.email }">
                                    <label>{{trans('admin.E-Mail Adresse')}}</label>
                                    <input class="form-control input-sm" name="email" value="{{ $user->email }}">
                                    <span v-if="form.errors.email" class="help-block">@{{ form.errors.email }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-md-offset-1">
                                <div class="form-group" :class="{'has-error': form.errors.cc_email }">
                                    <label>{{trans('admin.E-Mail Adresse (Back-Up)')}}</label>
                                    <input class="form-control input-sm" name="cc_email" value="{{ $user->cc_email }}">
                                    <span v-if="form.errors.cc_email" class="help-block">@{{ form.errors.cc_email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" :class="{'has-error': form.errors.user_role }">
                                    <label>{{trans('admin.Rolle')}}</label>
                                    <select name="role" class="form-control input-sm">
                                        <option value="">{{trans('admin.Auswählen')}}</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected="selected"' : '' }}>{{ trans('admin.'.$role->display_name)}}</option>
                                        @endforeach
                                    </select>
                                    <span v-if="form.errors.user_role" class="help-block">@{{ form.errors.user_role }}</span>
                                </div>
                            </div>

                        </div>

                        <label>{{trans('admin.Standort')}}</label>
                        @foreach(config('settings.locations') as $location)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="locations[]" value="{{ $location }}" {{ in_array($location, $user->locations) ? 'checked' : '' }}>
                                    {{ trans('admin.'.$location) }}
                                </label>
                            </div>
                        @endforeach
                        <input type="submit" value="{{trans('admin.Speichern')}}" class="btn btn-success btn-sm pull-right">
                    </template>
                </form-wrapper>
            </div>
        </div>
    </div>
@endsection