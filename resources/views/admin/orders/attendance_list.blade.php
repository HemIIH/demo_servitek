@extends('admin.orders.partials.order_layout')

@section('tab')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5>{{ $order->title }}</h5>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <p>
                                <strong>{{trans('admin.Auftragsnr')}}:</strong> {{ $order->id }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p>
                                <strong>{{trans('admin.Kunde')}}:</strong> <a href="{{ url('admin/client/' . $order->client->id . '/show') }}">{{ $order->client->short_name }}</a>
                            </p>
                        </div>
                        <div class="col-md-5">
                            <p>
                                <strong>{{trans('admin.Benötigte Mitarbeiter')}}:</strong> {{ $order->staff_planned . ' von ' . $order->staff_required }}
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <p>
                                <strong>{{trans('admin.Datum')}}:</strong> {{ Date::timespan($order->start_date, $order->end_date) }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p>
                                <strong>{{trans('admin.Startzeit')}}:</strong> {{ Date::format($order->start_time, 'time') }} {{trans('admin.Uhr')}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel-title">
                                {{trans('admin.Stundenzettel')}}
                            </div>
                        </div>
                        <div class="col-md-6 text-left">
                            <a class="btn btn-primary pull-right" href="{{ url('admin/order/' . $order->id . '/attendance-list/pdf') }}" target="_blank">{{trans('admin.Vorschau')}}</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if ($mails->count())
                                <p>{{trans('admin.Stundenzettel bereits versendet')}}</p>
                                <ul>
                                    @foreach($mails as $mail)
                                        <li>
                                            am {{ Date::format($mail->created_at, 'date_time') }} {{trans('admin.Uhr')}} <br>
                                            {{trans('admin.durch')}} {{ $mail->user->name }}
                                            <br>
                                            {{ $mail->information or '' }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>{{trans('admin.Stundenzettel wurde noch nicht versendet')}}</p>
                            @endif
                        </div>

                        <div class="col-md-8">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#attendance-list" data-toggle="tab">{{trans('admin.Stundenzettel')}}</a></li>
                                <li><a href="#reminder" data-toggle="tab">{{trans('admin.Erinnerung')}}</a></li>
                            </ul>

                            <br>

                            <div class="tab-content">
                                <div class="tab-pane active" id="attendance-list">
                                    <form action="{{ url('admin/order/' . $order->id . '/attendance-list/send') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="type" value="Anwesenheitsliste">

                                            <p>{{trans('admin.Wird versendet an')}}</p>

                                        <div class="form-group {{ $errors->has('contacts') ? 'has-error' : '' }}">
                                            @foreach($contacts as $contact)
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="contacts[]" value="{{ $contact->email }}" checked="checked"> {{ $contact->last_name . ', ' . $contact->first_name }}
                                                    </label> (<i>{{ $contact->email  }}</i>)
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
                                            <label>{{trans('admin.Betreff')}}</label>
                                            <input class="form-control input-sm" name="subject" value="{{ 'Servite GmbH - Stundenzettel für den ' . $order->start }}">
                                            @if ($errors->has('subject'))
                                                <span class="help-block">{{ $errors->first('subject') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                                            <label>{{trans('admin.E-Mail - Nachricht')}}</label>
                                            <html-editor name="body" model="{{ $textblocks->value }}"></html-editor>
                                            @if ($errors->has('body'))
                                                <span class="help-block">{{ $errors->first('body') }}</span>
                                            @endif
                                        </div>

                                        <input type="submit" value="{{trans('admin.Senden')}}" class="btn btn-default pull-right">
                                    </form>
                                </div>
                                <div class="tab-pane" id="reminder">
                                    <form action="{{ url('admin/order/' . $order->id . '/attendance-list/send') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="type" value="Erinnerung">

                                            <p>{{trans('admin.Wird versendet an')}}</p>

                                        <div class="form-group {{ $errors->has('contacts') ? 'has-error' : '' }}">
                                            @foreach($contacts as $contact)
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="contacts[]" value="{{ $contact->email }}" checked="checked"> {{ $contact->last_name . ', ' . $contact->first_name }}
                                                    </label> (<i>{{ $contact->email  }}</i>)
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
                                            <label>{{trans('admin.Betreff')}}</label>
                                            <input class="form-control input-sm" name="subject" value="{{ 'Servite GmbH - Erinnerung - Zeiterfassung abschliessen' }}">
                                            @if ($errors->has('subject'))
                                                <span class="help-block">{{ $errors->first('subject') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                                            <label>{{trans('admin.E-Mail - Nachricht')}}</label>
                                            <html-editor name="body" model="{{ $textblocks->value }}"></html-editor>
                                            @if ($errors->has('body'))
                                                <span class="help-block">{{ $errors->first('body') }}</span>
                                            @endif
                                        </div>

                                        <input type="submit" value="{{trans('admin.Senden')}}" class="btn btn-default pull-right">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection